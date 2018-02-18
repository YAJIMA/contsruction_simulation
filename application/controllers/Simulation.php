<?
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-2月-14
 * Time: 1:06
 */

/**
 * Class Simulation
 * @property Options_model $options_model
 * @property Reports_model $reports_model
 */
class Simulation extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->model('options_model');
        $this->load->model('reports_model');

        // セッション初期化（必要なら）
        $this->reports_model->init_session();

        // 簡易入力フォーム
        $this->data['items'] = $this->options_model->simplicities();
    }

    public function index()
    {

        $this->data['title'] = 'トップページ';
        $this->load->view('simulation/welcome.php', $this->data);
    }

    /**
     * simplicityform
     * 簡易入力フォームの入力受付
     */
    public function simplicityform()
    {

        // 簡易入力フォーム受付
        $this->options_model->postset();

        // 見積もり計算
        $this->data['estimateprice'] = $this->options_model->calc();

        $this->data['title'] = '簡易入力フォームの入力受付';
        $this->load->view('simulation/simplicityform.php', $this->data);
    }

    /**
     * mailsend
     * メール送信
     */
    public function mailsend()
    {
        // フォームバリデーションライブラリ
        $this->load->library('form_validation');
        // 検証ルール
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|trim|xss_clean|valid_email');

        if($this->form_validation->run()){	//バリデーションエラーがなかった場合の処理
            // メール送信

        }else{
            //バリデーションエラーがあった場合の処理
            $this->data['title'] = '簡易入力フォームの入力受付';
            $this->load->view('simulation/simplicityform.php', $this->data);
        }
    }

}