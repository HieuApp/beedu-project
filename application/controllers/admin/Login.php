<?php

/**
 * Created by IntelliJ IDEA.
 * User: phamtrong
 * Date: 3/17/16
 * Time: 13:01
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Login
 */
class Login extends Admin_login_layout {

    function __construct() {
        parent::__construct();
    }

    /**
     * check user are logged in before jump into Master admin
     */
    public function index() {
        if ($this->ion_auth->logged_in()) {
            $url = $this->session->userdata('redirect_login');
            $url = $url ? $url : site_url();
            $this->session->unset_userdata('redirect_login');
            redirect($url);
        }
        $this->load_more_js("assets/js/page/login.js", TRUE);
        $data = Array();
        $data["login_url"] = site_url("admin/login/check");
        $data["recover_url"] = site_url("admin/login/reset_password");
        $content = $this->load->view("admin/login/content", $data, TRUE);
        $this->show_page($content);
    }

    public function check() {
        if ($this->input->is_ajax_request() && $this->input->post()) {
            $dataReturn = Array();
            $dataReturn["callback"] = "login_response";
            $email = $this->input->post("username");
            $pass = $this->input->post("password");
            $login = $this->ion_auth->login($email, $pass);
            if ($login) {
                $this->set_more_session();
                $dataReturn["state"] = 1;
                $dataReturn["msg"] = "Đăng nhập thành công";
                $url = $this->session->userdata('redirect_login');
                $url = $url ? $url : site_url();
                $this->session->unset_userdata('redirect_login');
                $dataReturn["redirect"] = $url;
            } else {
                $dataReturn["state"] = 0;
                $dataReturn["msg"] = "Tên đăng nhập hoặc mật khẩu không chính xác";
            }
            echo json_encode($dataReturn);
        } else {
            redirect(site_url());
        }
    }

    private function set_more_session() {
        $group_db = $this->ion_auth->get_users_groups();
        $group = [];
        foreach ($group_db->result() as $item) {
            $group[$item->name] = $item;
        }
        $this->session->set_userdata("user_groups", $group);

        $user = $this->ion_auth->user()->row();
        $this->session->set_userdata("user_name", $user->name);
    }

    public function logout() {
        $this->ion_auth->logout();
        redirect(site_url("admin/login"));
    }

}