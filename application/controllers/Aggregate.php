<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Aggregate
 * @property Users_model $users_model
 * @property Options_model $options_model
 * @property Configs_model $configs_model
 * @property Reports_model $reports_model
 */
class Aggregate extends CI_Controller {

    public $data = array();

    /**
     * Aggregate constructor.
     */
    public function __construct()
    {
        parent::__construct();
        // ログインしてなかったら、ログイン画面に戻る
        if ( ! $this->session->userdata("is_logged_in"))
        {
            redirect('admin/login');
        }

        $this->load->model('users_model');
        $this->load->model('options_model');
        $this->load->model('configs_model');
        $this->load->model('reports_model');

    }

    public function index()
    {
        $this->data['title'] = '集計';
        $this->load->view('_head', $this->data);
        $this->load->view('_header_admin', $this->data);
        $this->load->view('aggregate', $this->data);
        $this->load->view('_foot', $this->data);
    }

    /**
     * 期間集計
     */
	public function period()
    {
        // フォームバリデーションライブラリ
        $this->load->library('form_validation');

        // 検証ルール
        $this->form_validation->set_rules('startdate', '日付（自）', 'required',
            array('required' => '%s は必須です。')
        );
        $this->form_validation->set_rules('enddate', '日付（至）', 'required',
            array('required' => '%s は必須です。')
        );

        if ($this->form_validation->run() == FALSE)
        {
            $this->data['startdate'] = date("Y-m-d", strtotime("-1 week"));
            $this->data['enddate'] = date("Y-m-d", strtotime("+1 day"));
        }
        else
        {
            // $this->reports_model->period_set();
            $_SESSION['startdate'] = $this->input->post("startdate");
            $_SESSION['enddate'] = $this->input->post("enddate");

            $this->data['startdate'] = $_SESSION['startdate'];
            $this->data['enddate'] = $_SESSION['enddate'];

            $_SESSION['results'] = $this->reports_model->aggregate_calc();
            $this->data['results'] = $_SESSION['results'];
        }

        $this->data['title'] = '期間集計';
        $this->load->view('_head', $this->data);
        $this->load->view('_header_admin', $this->data);
        $this->load->view('aggregate_period', $this->data);
        $this->load->view('_foot', $this->data);
    }

    public function validate_aggregate()
    {
        $this->reports_model->period_set();
        return TRUE;
    }

    /**
     * CSVダウンロード
     */
    public function csvdownload()
    {
        if (isset($_SESSION["results"]))
        {
            $this->load->helper('download');
            $this->load->helper('file');

            //header("Content-Type: application/octet-stream");
            $filename = 'result-'.date("YmdHis").'.csv';
            // $fp = fopen($filename, 'w');
            // テンプファイルを作成
            $fp = tmpfile();

            $fields = array(
                "メールアドレス",
                "メール送信",
                "メールからのアクセス",
                "詳細フォーム完了",
                "延床面積 ( ㎡ )"
            );
            foreach ($_SESSION["results"][0]["options"] as $o)
            {
                $fields[] = $o["title"];
            }
            mb_convert_variables("SJIS-WIN", "UTF-8", $fields);
            fputcsv($fp, $fields, ",", "\"", "\\");

            foreach ($_SESSION["results"] as $row)
            {
                $fields = array(
                    $row["email"],
                    $row["email_send"],
                    $row["email_access"],
                    $row["finish"],
                    $row["floorarea"]
                );
                foreach ($row["options"] as $o)
                {
                    $fields[] = $o["strvalue"];
                }
                mb_convert_variables("SJIS-WIN", "UTF-8", $fields);
                fputcsv($fp, $fields, ",", "\"", "\\");
            }

            // ファイルコンテンツの作成
            $contents = '';
            rewind($fp);

            while ( ! feof($fp))
            {
                $contents .= fread($fp, 8192);
            }

            // ファイルのダウンロード
            force_download($filename, $contents, 'application/octet-stream');

            // ファイルを閉じる（テンプファイルは削除）
            fclose($fp);

            exit;
            //redirect('aggregate/period');
        }

        redirect('admin/home');
    }

    /**
     * 行削除
     */
    public function rowdelete()
    {
        if (! empty($this->input->post("rep_id")))
        {
            $this->reports_model->delete($this->input->post("rep_id"));
        }
        redirect('aggregate/period');
    }
}