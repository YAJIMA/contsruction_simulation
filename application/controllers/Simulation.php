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
 * @property Configs_model $configs_model
 */
class Simulation extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();

        $this->load->model('options_model');
        $this->load->model('reports_model');
        $this->load->model('configs_model');

        // セッション初期化（必要なら）
        $this->reports_model->init_session();

        // 簡易入力フォーム
        $this->data['items'] = $this->options_model->simplicities();

        // 詳細入力フォーム
        $this->data['detail_items'] = $this->options_model->details();

        // 初期設定
        $this->data['configs'] = $this->configs_model->load();

        // 延床面積
        $this->data['floors'] = $this->options_model->floorareas(50,300,100);
    }

    public function index()
    {
        $this->data['title'] = '外壁塗装シミュレーション';
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

        // 延床面積
        $this->data['floors'] = $this->options_model->floorareas(50,300,100);

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
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|trim|valid_email');

        // 見積もり計算
        $this->data['estimateprice'] = $this->options_model->calc();

        if ($this->data['estimateprice'] == 0)
        {
            // 見積もり金額が0円（セッション切れ）
            redirect("simulation");
        }
        elseif ($this->form_validation->run())
        {	//バリデーションエラーがなかった場合の処理

            // 詳細リンク
            $gotourl = base_url("simulation/detailform/".$_SESSION["sess"]);

            // 宛先
            $_SESSION['email'] = $this->input->post("email");

            // メール件名
            $subject = $this->data['configs']['simplicity_sbj']['strvalue'];

            // メール本文
            $mailbody = $this->data['configs']['simplicity']['strvalue'];

            $mailbody = str_replace("#見積金額#", number_format($this->data['estimateprice']), $mailbody);

            $listvalues = $this->options_model->listvalue();
            foreach ($listvalues as $key => $val)
            {
                $mailbody = str_replace("#".$key."#", $val, $mailbody);
            }
            unset($key,$val);

            $mailbody = str_replace("#GOTOURL#", $gotourl, $mailbody);

            // メール送信
            $this->load->library('email');

            $this->email->from($this->data['configs']['email_from']['strvalue'], $this->data['configs']['email_from_name']['strvalue']);
            $this->email->to($_SESSION['email']);
            if ($this->data['configs']['email_reply']['strvalue'] !== "")
            {
                $this->email->reply_to($this->data['configs']['email_reply']['strvalue'], $this->data['configs']['email_from_name']['strvalue']);
            }
            if ($this->data['configs']['email_cc']['strvalue'] !== "")
            {
                $this->email->cc($this->data['configs']['email_cc']['strvalue']);
            }

            $this->email->subject($subject);
            $this->email->message($mailbody);

            $this->email->send();

            $_SESSION['emailsend'] = date("Y-m-d H:i:s");

            // レポート更新
            $this->reports_model->update();

            $this->data['title'] = '簡易入力フォームの入力受け付けました';
            $this->load->view('simulation/simplicityform_thanks.php', $this->data);
        }
        else
        {
            //バリデーションエラーがあった場合の処理
            $this->data['title'] = '簡易入力フォームの入力受付';
            $this->load->view('simulation/simplicityform.php', $this->data);
        }
    }

    public function mailsend_check()
    {

    }

    /**
     * detailform
     * 詳細見積もり
     * @param $_sess
     */
    public function detailform($_sess)
    {
        if (empty($_sess))
        {
            redirect("simulation");
        }

        // URLからセッションを上書き
        $_SESSION["sess"] = $_sess;
        $this->reports_model->load();

        // 延床面積
        $this->data['floors'] = $this->options_model->floorareas(50,300,100);

        // メールのリンクを踏んだ
        if ( ! isset($_SESSION["email_access"]))
        {
            $_SESSION["email_access"] = date("Y-m-d H:i:s");
            $this->reports_model->update();
        }

        // レポート
        $reports = $this->reports_model->load();

        // 見積もり計算
        $this->data['estimateprice'] = $this->options_model->calc();

        $this->data['title'] = '詳細見積もり';
        $this->load->view('simulation/detailform.php', $this->data);
    }

    /**
     * detailfinish
     * 詳細見積もり結果
     */
    public function detailfinish()
    {
        // 簡易入力フォーム受付
        $this->options_model->postset();

        // レポート更新
        $_SESSION["finish"] = date("Y-m-d H:i:s");
        $this->reports_model->update();

        // レポート
        $reports = $this->reports_model->load();

        // 見積もり計算
        $this->data['estimateprice'] = $this->options_model->calc();

        // 宛先
        // $_SESSION['email'] = $this->input->post("email");

        // メール件名
        $subject = $this->data['configs']['detail_sbj']['strvalue'];

        // メール本文
        $mailbody = $this->data['configs']['detail']['strvalue'];

        $mailbody = str_replace("#見積金額#", number_format($this->data['estimateprice']), $mailbody);

        $listvalues = $this->options_model->listvalue();
        foreach ($listvalues as $key => $val)
        {
            $mailbody = str_replace("#".$key."#", $val, $mailbody);
        }
        unset($key,$val);

        // メール送信
        $this->load->library('email');
        $this->email->from($this->data['configs']['email_from']['strvalue'], $this->data['configs']['email_from_name']['strvalue']);
        $this->email->to($_SESSION['email']);
        if ($this->data['configs']['email_reply']['strvalue'] !== "")
        {
            $this->email->reply_to($this->data['configs']['email_reply']['strvalue'], $this->data['configs']['email_from_name']['strvalue']);
        }
        if ($this->data['configs']['email_cc']['strvalue'] !== "")
        {
            $this->email->cc($this->data['configs']['email_cc']['strvalue']);
        }
        $this->email->subject($subject);
        $this->email->message($mailbody);
        $this->email->send();


        $this->data['title'] = '詳細見積もり結果';
        $this->load->view('simulation/detailfinish.php', $this->data);
    }

}