<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-2月-14
 * Time: 12:50
 */

class Reports_model extends CI_Model
{
    public function init_session()
    {
        if ( ! isset($_SESSION['sess']))
        {
            $sess = md5(session_id());

            $this->db->where("uniquekey", $sess);
            $query = $this->db->get("reports");
            if ($query->num_rows() == 0)
            {   //ユーザーが存在しなかった場合の処理
                $data = array(
                    "uniquekey" => $sess,
                );
                $this->db->insert("reports", $data);
                $_SESSION['sess'] = $sess;
            }
            else
            {   //ユーザーが存在した場合の処理
                $_SESSION['sess'] = $sess;
            }
        }
    }

    public function update()
    {
        if (isset($_SESSION["sess"]))
        {
            $sess = $_SESSION["sess"];

            // reports 検索
            $reports = $this->getreports($sess);
            $report_id = $reports["id"];

            // options_reports を初期化
            $this->clear_options_reports($report_id);

            // options_reports を更新
            $simplicity_form_exec = $detail_form_exec = 0;
            foreach ($_SESSION as $key => $val)
            {
                switch ($key)
                {
                    case "前回の塗装からの経過年数":
                    case "築年数":
                    case "建物の階数":
                        $simplicity_form_exec = 1;
                        $data = array(
                            "report_id" => $report_id,
                            "level" => $val,
                        );
                        $this->db->insert("options_reports", $data);
                        break;
                    case "外装材の種類":
                    case "屋根材の種類":
                    case "お住いの地域":
                    case "地域の気候の特徴":
                        $detail_form_exec = 1;
                        $data = array(
                            "report_id" => $report_id,
                            "level" => $val,
                        );
                        $this->db->insert("options_reports", $data);
                        break;
                    default:
                        break;
                }
            }

            // reports 更新
            $data = array();
            if (isset($_SESSION["email"]))
            {
                $data["email"] = $_SESSION["email"];
            }
            if (isset($_SESSION["延床面積"]))
            {
                $data["floorarea"] = $_SESSION["延床面積"];
            }
            if ($simplicity_form_exec)
            {
                $data["simplicity_form_exec"] = $simplicity_form_exec;
            }
            if ($detail_form_exec)
            {
                $data["detail_form_exec"] = $detail_form_exec;
            }
            if (isset($_SESSION["emailsend"]))
            {
                $data["email_exec"] = 1;
            }

            $this->db->set($data);
            $this->db->where("id", $report_id);
            $this->db->update("reports");
        }
        else
        {
            return FALSE;
        }
    }

    private function getreports($sess)
    {
        $this->db->where("uniquekey", $sess);
        $query = $this->db->get("reports");
        return $query->row_array();
    }

    private function clear_options_reports($report_id)
    {
        $this->db->where("report_id", $report_id);
        $this->db->delete("options_reports");
    }
}