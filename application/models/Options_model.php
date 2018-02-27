<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-2月-13
 * Time: 17:41
 */

class Options_model extends CI_Model
{
    public function load()
    {
        $result = array();

        $this->db->order_by("level", "ASC");
        $query = $this->db->get("options");

        $result = $query->result_array();

        return $result;
    }

    public function add()
    {
        $data = array(
            "level" => $this->input->post("level"),
            "title" => $this->input->post("title"),
            "helptext" => $this->input->post("helptext"),
            "strvalue" => $this->input->post("strvalue"),
            "imageurl" => $this->input->post("imageurl"),
            "unitprice" => $this->input->post("unitprice"),
            "perprice" => $this->input->post("perprice"),
        );
        $this->db->insert("options", $data);

        return TRUE;
    }

    public function update()
    {
        $data = array(
            "level" => $this->input->post("level"),
            "title" => $this->input->post("title"),
            "helptext" => $this->input->post("helptext"),
            "strvalue" => $this->input->post("strvalue"),
            "imageurl" => $this->input->post("imageurl"),
            "unitprice" => $this->input->post("unitprice"),
            "perprice" => $this->input->post("perprice"),
        );
        $this->db->set($data);
        $this->db->where("id", $this->input->post("option_id"));
        $this->db->update("options");
        return TRUE;
    }

    public function simplicities()
    {
        $result = array();

        $this->db->where('level <', 1000);
        $this->db->order_by('level', 'ASC');
        $query = $this->db->get('options');

        foreach ($query->result_array() as $row) {
            $result[$row['title']][] = $row;
        }
        unset($row);

        return $result;
    }

    public function details()
    {
        $result = array();

        $this->db->where('level >', 1000);
        $this->db->order_by('level', 'ASC');
        $query = $this->db->get('options');

        foreach ($query->result_array() as $row) {
            $result[$row['title']][] = $row;
        }
        unset($row);

        return $result;
    }

    public function postset()
    {
        foreach ($this->input->post(NULL, TRUE) as $key => $value) {
            if ($key)
            {
                $_SESSION[$key] = $value;
            }
        }
        unset($key,$value);
    }

    public function calc()
    {
        $result = $base_area = $base_price = 0;

        if (isset($_SESSION["延床面積"])) {
            $base_area = $_SESSION["延床面積"];
        }

        if (isset($_SESSION["希望する塗料の種類"])) {
            $val = $this->get_options_value($_SESSION["希望する塗料の種類"], 'unitprice');
            $base_price = $base_area * $val['unitprice'];
        }

        $result += $base_price;
        foreach ($_SESSION as $key => $val)
        {
            switch ($key)
            {
                case "前回の塗装からの経過年数":
                case "築年数":
                case "建物の階数":
                case "外装材の種類":
                case "屋根材の種類":
                case "お住いの地域":
                case "地域の気候の特徴":
                    $val = $this->get_options_value($val, 'perprice');
                    $result += $base_price * $val['perprice'];
                    break;
                default:
                    break;
            }
        }
        unset($key,$val);

        return $result;
    }

    public function listvalue()
    {
        $result = array();

        if (isset($_SESSION["延床面積"])) {
            $result["延床面積"] = $_SESSION["延床面積"];
        }

        if (isset($_SESSION["希望する塗料の種類"])) {
            $val = $this->get_options_value($_SESSION["希望する塗料の種類"], 'strvalue');
            $result["希望する塗料の種類"] = $val["strvalue"];
        }

        foreach ($_SESSION as $key => $val)
        {
            switch ($key)
            {
                case "前回の塗装からの経過年数":
                case "築年数":
                case "建物の階数":
                case "外装材の種類":
                case "屋根材の種類":
                case "お住いの地域":
                case "地域の気候の特徴":
                    $val = $this->get_options_value($_SESSION[$key], 'strvalue');
                    $result[$key] = $val["strvalue"];
                    break;
                default:
                    break;
            }
        }
        unset($key,$val);

        return $result;
    }

    private function get_options_value($lv, $col)
    {
        $this->db->select($col);
        $this->db->where("level",$lv);
        $query = $this->db->get("options");
        return $query->row_array();
    }
}
/*
 * Array
(
    [__ci_last_regenerate] => 1518791715
    [sess] => 7ea89a7005c0d21cb078c9624190b912
    [希望する塗料の種類] => 101
    [延床面積] => 55.1
    [前回の塗装からの経過年数] => 303
    [築年数] => 404
    [建物の階数] => 503
)*/