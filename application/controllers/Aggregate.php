<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aggregate extends CI_Controller {

    public function index()
    {
        $this->load->view('aggregate');
    }

    /**
     * 期間集計
     */
	public function period()
    {
        $this->load->view('aggregate_period');
    }

    /**
     * CSVダウンロード
     */
    public function csvdownload()
    {
        $this->load->view('aggregate_csvdownload');
    }
}