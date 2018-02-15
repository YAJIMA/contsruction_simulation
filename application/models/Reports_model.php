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


}