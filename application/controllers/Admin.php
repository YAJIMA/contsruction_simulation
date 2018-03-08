<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Admin
 * @property Users_model $users_model
 * @property Reports_model $reports_model
 */
class Admin extends CI_Controller {

    public $data = array();

    public function index()
    {
        // ここで古いレコードを削除する
        $this->load->model('reports_model');
        $this->reports_model->clearolds();

        $this->login();
    }

    /**
     * ログイン
     */
	public function login()
    {
        $this->data['title'] = 'ログイン';

        // フォームバリデーションライブラリ
        $this->load->library('form_validation');

        // 検証ルール
        $this->form_validation->set_rules('inputUserName', 'ユーザーID', 'required|callback_validate_credentials');
        $this->form_validation->set_rules('inputPassword', 'パスワード', 'required',
            array('required' => '%s は必須です。')
        );

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('_head_signin', $this->data);
            $this->load->view('admin_login', $this->data);
            $this->load->view('_foot', $this->data);
        }
        else
        {
            $data = array(
                "username" => $this->input->post("inputUserName"),
                "is_logged_in" => 1
            );
            $this->session->set_userdata($data);

            redirect('admin/home');
        }
    }

    //Email情報がPOSTされたときに呼び出されるコールバック機能
    public function validate_credentials()
    {
        $this->load->model('users_model');

        if($this->users_model->admin_login())
        {
            //ユーザーがログインできたあとに実行する処理
            return true;
        }
        else
        {
            //ユーザーがログインできなかったときに実行する処理
            $this->form_validation->set_message("validate_credentials", "ユーザー名かパスワードが異なります。");
            return false;
        }
    }

    /**
     * 管理トップ
     */
    public function home()
    {
        if ($this->session->userdata("is_logged_in"))
        {
            $this->data['title'] = '管理トップ';
            $this->load->view('_head', $this->data);
            $this->load->view('_header_admin', $this->data);
            $this->load->view('admin_home', $this->data);
            $this->load->view('_foot', $this->data);
        }
        else
        {
            redirect('admin/login');
        }
    }

    /**
     * ログアウト
     */
    public function logout()
    {
        $this->session->sess_destroy();		//セッションデータの削除
        redirect ("admin/login");		//ログインページにリダイレクトする
    }
}