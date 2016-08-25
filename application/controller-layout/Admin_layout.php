<?php
/**
 * Created by IntelliJ IDEA.
 * User: phamtrong
 * Date: 3/17/16
 * Time: 11:16
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Admin_layout
 */
abstract class Admin_layout extends Base_layout {

    protected $role_allow = 'admin';

    function __construct() {
        parent::__construct();
        $this->load->model('M_notification', 'm_notification');
        $this->_set_side_bar_left();
        $this->_set_top_bar();
        $this->check_login();
    }

    private function _set_side_bar_left() {
        $menu[] = Array(
            "text" => "Dashboard",
            "icon" => "fa-tachometer",
            "url"  => site_url('admin/user'),
        );
        $menu[] = Array(
            "text"  => "Quản lý tài khoản",
            "icon"  => "fa-users",
            "url"   => site_url('admin/user'),
            "child" => Array(
                '0' => Array(
                    "text" => "Thêm",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('admin/user/add'),
                ),
                '1' => Array(
                    "text" => "Quản lý tài khoản",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('admin/user'),
                ),
            ),
        );
        $menu[] = Array(
            "text"  => "Quản lý chuyên mục",
            "icon"  => "fa-th-list",
            "url"   => site_url('admin/categories'),
            "child" => Array(
                '0' => Array(
                    "text" => "Thêm",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('admin/categories/add'),
                ),
                '1' => Array(
                    "text" => "Quản lý chuyên mục",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('admin/categories'),
                ),
            ),
        );
        $menu[] = Array(
            "text"  => "Quản lý tài liệu",
            "icon"  => "fa-file-text-o",
            "url"   => site_url('admin/documents'),
            "child" => Array(
                '0' => Array(
                    "text" => "Thêm",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('admin/documents/add'),
                ),
                '1' => Array(
                    "text" => "Quản lý tài liệu",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('admin/documents'),
                ),
            ),
        );
        $menu[] = Array(
            "text" => "Phương pháp học",
            "icon" => "fa-dropbox",
            "url"  => site_url('admin/learning_method'),
        );
        $menu[] = Array(
            "text" => "Quản lý hình ảnh",
            "icon" => "fa-file-image-o",
            "url"  => site_url('admin/image_home'),
        );
        $menu[] = Array(
            "text" => "Quản lý lớp học",
            "icon" => "fa-university",
            "url"  => site_url('admin/classes'),
        );
        $menu[] = Array(
            "text" => "Quản lý phản hồi",
            "icon" => "fa-inbox",
            "url"  => site_url('admin/feedback_manage'),
        );
        $menu[] = Array(
            "text" => "Quản lý hỏi đáp",
            "icon" => "fa-question-circle-o",
            "url"  => site_url('admin/questions'),
        );
        $menu[] = Array(
            "text" => "System config",
            "icon" => "fa-cogs",
            "url"  => site_url('admin/system_config'),
        );
        $data = Array(
            'view_file' => "admin/base_layout/side_bar_left",
            'menu_data' => $menu,
        );
        $this->set_data_part('side_bar_left', $data, TRUE);
    }

    private function _set_top_bar() {
        $group = $this->session->userdata("user_groups");
        $user_id = $this->session->userdata()["user_id"];
        $where = [
            "m.user_receive_id" => $user_id,
        ];
        $notify_data = $this->m_notification->get_list_filter($where, [], []);
        $this->load_more_js("assets/js/page/notify/notify.js", TRUE);
        $notify_data_not_checked = Array();
        foreach ($notify_data as $item) {
            if ($item->status == -1 || $item->status == 0) {
                array_push($notify_data_not_checked, $item);
            }
        }
        $data = Array(
            'view_file'   => "admin/base_layout/top_bar",
            'is_admin'    => isset($group['admin']),
            'notify_data' => $notify_data_not_checked,
        );
        $this->set_data_part('top_bar', $data, TRUE);
    }

    protected function set_session_group() {
        $group_db = $this->ion_auth->get_users_groups();
        $group = [];
        foreach ($group_db->result() as $item) {
            $group[$item->name] = $item;
        }
        $this->session->set_userdata("user_groups", $group);
    }

    protected function check_login() {
        if (!$this->ion_auth->logged_in()) {
            $this->redirect_to_login();
        }
    }

    protected function redirect_to_login() {
        $login_link = site_url("admin/login");
        $this->session->set_userdata('redirect_login', current_url());
        $this->session->set_flashdata("msg", "<div class='alert alert-warning'>Required login!</div>");
        redirect($login_link);
    }

}
