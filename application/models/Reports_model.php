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
    /**
     * init_session
     */
    public function init_session()
    {
        if (!isset($_SESSION['sess'])) {
            $sess = md5(session_id());

            $this->db->where("uniquekey", $sess);
            $query = $this->db->get("reports");
            if ($query->num_rows() == 0) {   //ユーザーが存在しなかった場合の処理
                $data = array(
                    "uniquekey" => $sess,
                );
                $this->db->insert("reports", $data);
                $_SESSION['sess'] = $sess;
            } else {   //ユーザーが存在した場合の処理
                $_SESSION['sess'] = $sess;
            }
        }
    }

    public function period_set()
    {
        $_SESSION['startdate'] = $this->input->post("startdate");
        $_SESSION['enddate'] = $this->input->post("enddate");
        return TRUE;
    }

    public function aggregate_calc($col = "finish")
    {
        $result = array();

        $start = $_SESSION["startdate"];
        $end = $_SESSION["enddate"];

        $this->db->where($col . " >=", $start);
        $this->db->where($col . " <=", $end);
        $query = $this->db->get("reports");

        foreach ($query->result_array() as $row) {
            $sql = "SELECT `options_reports`.*, `options`.`title`, `options`.`strvalue`, `options`.`unitprice`, `options`.`perprice`
            FROM `options_reports` 
            LEFT JOIN `options` ON `options`.`level` = `options_reports`.`level`
            WHERE `options_reports`.`report_id` = ? ";
            $subquery = $this->db->query($sql, array($row["id"]));

            $row["options"] = $subquery->result_array();

            $result[] = $row;
        }
        unset($row);

        return $result;
    }

    /**
     * load
     * @return array
     */
    public function load()
    {
        $result = array();

        if (isset($_SESSION["sess"])) {
            $sess = $_SESSION["sess"];

            // reports 検索
            $reports = $this->getreports($sess);
            $report_id = $reports["id"];
            $result = $reports;
            $_SESSION["延床面積"] = $reports["floorarea"];
            $_SESSION["email"] = $reports["email"];

            // options_reports 検索
            $options_reports = $this->get_options_reports($report_id);

            foreach ($options_reports as $row) {
                $values = $this->get_options_value($row["level"], "title,strvalue,level");
                $_SESSION[$values["title"]] = $values["level"];
            }

            $result["options"] = $options_reports;

        }

        return $result;
    }

    /**
     * update
     * @return bool
     */
    public function update()
    {
        if (isset($_SESSION["sess"])) {
            $sess = $_SESSION["sess"];

            // reports 検索
            $reports = $this->getreports($sess);
            $report_id = $reports["id"];

            // options_reports を初期化
            $this->clear_options_reports($report_id);

            // options_reports を更新
            $simplicity_form_exec = $detail_form_exec = 0;
            foreach ($_SESSION as $key => $val) {
                switch ($key) {
                    case "希望する塗料の種類":
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
            // メールアドレス
            if (isset($_SESSION["email"])) {
                $data["email"] = $_SESSION["email"];
            }
            // 延床面積
            if (isset($_SESSION["延床面積"])) {
                $data["floorarea"] = $_SESSION["延床面積"];
            }
            // 簡易見積もりした
            if ($simplicity_form_exec) {
                $data["simplicity_form_exec"] = $simplicity_form_exec;
            }
            // 詳細見積もりした
            if ($detail_form_exec) {
                $data["detail_form_exec"] = $detail_form_exec;
            }
            // メール送信した
            if (isset($_SESSION["emailsend"])) {
                $data["email_exec"] = 1;
                $data["email_send"] = $_SESSION["emailsend"];
            }
            // メールのリンクを踏んだ
            if (isset($_SESSION["email_access"])) {
                $data["email_access"] = $_SESSION["email_access"];
            }
            // 詳細見積もりした
            if (isset($_SESSION["finish"])) {
                $data["detail_form_exec"] = 1;
                $data["finish"] = $_SESSION["finish"];
            }
            $this->db->set($data);
            $this->db->where("id", $report_id);
            $this->db->update("reports");
        } else {
            return FALSE;
        }
    }

    public function delete($report_id = NULL)
    {
        if (is_array($report_id)) {
            foreach ($report_id as $rid) {
                $report_ids[] = $rid;
            }
        } elseif ( ! empty($report_id)) {
            $report_ids[] = $report_id;
        }

        $this->db->where_in("id", $report_ids);
        $this->db->delete("reports");

        $this->db->where_in("report_id", $report_ids);
        $this->db->delete("options_reports");

        return TRUE;
    }

    /**
     * 古いレコードを削除
     */
    public function clearolds()
    {
        $olddatetime = date("Y-m-d H:i:s", strtotime("-1 day"));
        $this->db->where("email", "");
        $this->db->where("modified <", $olddatetime);
        $query = $this->db->get("reports");

        $report_ids = array();
        foreach ($query->result_array() as $row)
        {
            $this->delete($row["id"]);
            $_SESSION['delete_reports_ids'][] = $row["id"];
        }

        return TRUE;
    }

    private function getreports($sess)
    {
        $this->db->where("uniquekey", $sess);
        $query = $this->db->get("reports");
        return $query->row_array();
    }

    private function get_options_reports($report_id)
    {
        $this->db->where("report_id", $report_id);
        $query = $this->db->get("options_reports");
        return $query->result_array();
    }

    private function get_options_value($lv, $col)
    {
        $this->db->select($col);
        $this->db->where("level",$lv);
        $query = $this->db->get("options");
        return $query->row_array();
    }

    private function clear_options_reports($report_id)
    {
        $this->db->where("report_id", $report_id);
        $this->db->delete("options_reports");
    }

}