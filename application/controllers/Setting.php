<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Setting
 * @property Users_model $users_model
 * @property Options_model $options_model
 * @property Configs_model $configs_model
 */
class Setting extends CI_Controller {

    public $data = array();

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

    }

    public function index()
    {
        redirect('admin/home');
    }

    /**
     * パスワード変更
     */
	public function changepass()
    {
        // ユーザー一覧
        $this->data['userlist'] = $this->users_model->load();

        $this->data['title'] = 'パスワード変更';
        $this->load->view('_head', $this->data);
        $this->load->view('_header_admin', $this->data);
        $this->load->view('setting_changepass', $this->data);
        $this->load->view('_foot', $this->data);
    }

    /**
     * ユーザー追加
     */
    public function insertuser()
    {
        // フォームバリデーションライブラリ
        $this->load->library('form_validation');

        // 検証ルール
        $this->form_validation->set_rules('inputUserName', 'ユーザーID', 'required|callback_validate_credentials');
        $this->form_validation->set_rules('inputPassword', 'パスワード', 'required',
            array('required' => '%s は必須です。')
        );

        if ($this->form_validation->run() == FALSE)
        {
            // ユーザー一覧
            $this->data['userlist'] = $this->users_model->load();

            $this->data['title'] = 'パスワード変更';
            $this->load->view('_head', $this->data);
            $this->load->view('_header_admin', $this->data);
            $this->load->view('setting_changepass', $this->data);
            $this->load->view('_foot', $this->data);
        }
        else
        {
            redirect('setting/changepass');
        }
    }

    //Email情報がPOSTされたときに呼び出されるコールバック機能
    public function validate_credentials()
    {

        if($this->users_model->user_add_validate())
        {
            //ユーザーがログインできたあとに実行する処理
            return TRUE;
        }
        else
        {
            //ユーザーがログインできなかったときに実行する処理
            $this->form_validation->set_message("validate_credentials", "そのユーザー名は使用できません。");
            return FALSE;
        }
    }

    /**
     * ユーザー更新
     */
    public function updateuser()
    {

        if ($this->users_model->user_update())
        {
            redirect('setting/changepass');
        }
        else
        {
            redirect('setting/changepass');
        }
    }

    /**
     * 項目設定
     */
    public function changeparam()
    {
        // 設定一覧
        $this->data['options'] = $this->options_model->load();

        $this->data['title'] = '項目設定';
        $this->load->view('_head', $this->data);
        $this->load->view('_header_admin', $this->data);
        $this->load->view('setting_changeparam');
        $this->load->view('_foot', $this->data);
    }

    /**
     * 項目追加
     */
    public function insertparam()
    {
        // フォームバリデーションライブラリ
        $this->load->library('form_validation');

        // 検証ルール
        $this->form_validation->set_rules('level', 'level', 'required|callback_validate_options');
        $this->form_validation->set_rules('title', 'title', 'required',
            array('required' => '%s は必須です。')
        );

        if ($this->form_validation->run() == FALSE)
        {
            $this->changeparam();
        }
        else
        {
            redirect('setting/changeparam');
        }
    }

    //Email情報がPOSTされたときに呼び出されるコールバック機能
    public function validate_options()
    {

        if($this->options_model->add())
        {
            //ユーザーがログインできたあとに実行する処理
            return TRUE;
        }
        else
        {
            //ユーザーがログインできなかったときに実行する処理
            $this->form_validation->set_message("validate_credentials", "そのユーザー名は使用できません。");
            return FALSE;
        }
    }

    /**
     * 項目更新
     */
    public function updateparam()
    {
        if ($this->options_model->update())
        {
            redirect('setting/changeparam');
        }
        else
        {
            redirect('setting/changeparam');
        }
    }

    /**
     * メール変更
     */
    public function changemail()
    {
        if ($this->input->method(TRUE) == "POST")
        {
            $this->configs_model->updateall();
        }

        // 設定一覧
        $this->data['configs'] = $this->configs_model->load();

        $this->data['title'] = '項目設定';
        $this->load->view('_head', $this->data);
        $this->load->view('_header_admin', $this->data);
        $this->load->view('setting_changemail');
        $this->load->view('_foot', $this->data);
    }
}