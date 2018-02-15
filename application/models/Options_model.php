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

        foreach ($query->result_array() as $row)
        {
            $result[$row['title']][] = $row;
        }
        unset($row);

        return $result;
    }
}