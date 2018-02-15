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
    }

    public function index()
    {
        // 簡易入力フォーム
        $this->data['items'] = $this->options_model->simplicities();

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

        $this->data['title'] = 'トップページ';
        $this->load->view('simulation/simplicityform.php', $this->data);
    }
}