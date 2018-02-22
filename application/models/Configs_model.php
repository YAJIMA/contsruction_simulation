<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-2月-18
 * Time: 2:42
 */

class Configs_model extends CI_Model
{
    public function load()
    {
        $result = array();

        $this->db->select("keyname,strvalue,intvalue");
        $query = $this->db->get("configs");

        //$result = $query->result_array();
        foreach ($query->result_array() as $row)
        {
            $result[$row['keyname']] = $row;
        }

        return $result;
    }

    public function update()
    {
        if ($this->input->post("strvalue"))
        {
            $data = array("strvalue" => $this->input->post("strvalue"));
        }
        elseif ($this->input->post("intvalue"))
        {
            $data = array("intvalue" => $this->input->post("intvalue"));
        }
        $this->db->set($data);
        $this->db->where("keyname", $this->input->post("keyname"));
        $this->db->update("configs");
        return TRUE;
    }

    public function updateall()
    {
        foreach ($this->input->post(NULL, TRUE) as $key => $item)
        {
            $data = array("strvalue" => $item);
            $this->db->set($data);
            $this->db->where("keyname", $key);
            $this->db->update("configs");
        }
        return TRUE;
    }
}