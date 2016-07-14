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
            "url"  => site_url(),
        );
        $menu[] = Array(
            "text"  => "Quản lý công ty",
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
            "text"  => "Quản lý đơn hàng",
            "icon"  => "fa-bars",
            "url"   => site_url('company/order'),
            "child" => Array(
                '0' => Array(
                    "text" => "Thêm",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('company/order/entry'),
                ),
                '1' => Array(
                    "text" => "Quản lý đơn hàng",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('company/order'),
                ),
            ),
        );
        $menu[] = Array(
            "text"  => "Quản lý kho",
            "icon"  => "fa-cubes",
            "url"   => site_url('warehouse_activity_manage'),
            "child" => Array(
                '0' => Array(
                    "text" => "Thêm",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('warehouse/add'),
                ),
                '1' => Array(
                    "text" => "Quản lý kho",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('warehouse'),
                ),
                '2' => Array(
                    "text" => "Quản lý xuất/nhập kho",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('warehouse_activity_manage'),
                ),
                '3' => Array(
                    "text" => "Quản lý trạng thái NPL",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('material_state'),
                ),
            ),
        );
        $menu[] = Array(
            "text"  => "Quản lý sản xuất",
            "icon"  => "fa-random",
            "url"   => site_url('line'),
            "child" => Array(
                '0' => Array(
                    "text" => "Thêm tổ sản xuất",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('line/add'),
                ),
                '1' => Array(
                    "text" => "Quản lý tổ sản xuất",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('line'),
                ),
                '2' => Array(
                    "text" => "Quản lý quy trình",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('line'),
                ),
            ),
        );
        $menu[] = Array(
            "text"  => "Lịch đơn hàng về kho",
            "icon"  => "fa-calendar",
            "url"   => site_url('warehouse_order_plans'),
            "child" => Array(
                '0' => Array(
                    "text" => "Tạo đơn hàng",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('warehouse_order_plans/add_warehouse_order_plans'),
                ),
                '1' => Array(
                    "text" => "Quản lý đơn hàng",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('warehouse_order_plans'),
                ),
            ),
        );
        $menu[] = Array(
            "text"  => "Cập nhật tiến độ",
            "icon"  => "fa-line-chart",
            "url"   => site_url('daily_productivity'),
            "child" => Array(
                '0' => Array(
                    "text" => "Cập nhật mới",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('daily_productivity/add'),
                ),
                '1' => Array(
                    "text" => "Quản lý tiến độ",
                    "icon" => "fa-caret-right",
                    "url"  => site_url('daily_productivity'),
                ),
            ),
        );
        $menu[] = Array(
            "text" => "System config",
            "icon" => "fa-cogs",
            "url"  => site_url('system_config'),
        );
        $group = $this->session->userdata("user_groups");
        $is_admin = isset($group['admin']);
        $is_corporation = isset($group['corporation']);
        $is_ppc = isset($group['ppc']);
        $is_warehouse_manager = isset($group['warehouse_manager']);
        $is_quality = isset($group['quality_manager']);
        $is_producer = isset($group['producer']);
        /**
         * TODO: the code bellow to check piority of user
         */
        if ($is_admin) {
        } else {
            unset($menu["7"]);
            if ($is_corporation) {
            } else {
                unset($menu["1"]);
                if ($is_ppc) {
                } else {
                    unset($menu["4"]);
                    unset($menu["2"]);
                    if ($is_warehouse_manager) {

                    } else {
                        unset($menu["3"]);
                        unset($menu["5"]);
                    }
                }
            }
        }
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
