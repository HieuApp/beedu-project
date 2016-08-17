<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 19-Jul-16
 * Time: 4:49 PM
 * @property M_warehouse_activity m_warehouse_activity
 * @property M_notification       m_notification
 * @property M_warehouses         m_warehouses
 * @property M_user               m_user
 */
class Cron_job extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('M_warehouse_activity', 'm_warehouse_activity');
        $this->load->model('M_notification', 'm_notification');
        $this->load->model('M_warehouses', 'm_warehouses');
        $this->load->model('M_user', 'm_user');
    }

    public function create_notify() {
        $this->check_order_late_warning();
    }

    /**
     * @return bool|int
     */
    public function check_order_late_warning() {
        $data = $this->m_warehouse_activity->get_list_filter(
            [
                "time_receive <" => date("Y-m-d"),
                "date <"         => '2010-01-01',
            ],
            ["m.type" => ["2", "-2"]],
            []
        );
        foreach ($data as $item) {
            $group_user_receive_id = $this->get_user_receive_notify_for_order_plan_late($item->warehouse_id);
            foreach ($group_user_receive_id as $user_receive_id) {
                $content = 'Đơn hàng <b>' . $item->material_pack . '</b> về kho trễ';
                $default_status = '-1';
                $link = site_url("warehouse_order_plans/view_detail/" . $item->id);
                $check_sum = md5($link . $user_receive_id . $content . $default_status);
                $warning_data = [
                    'link_to_warning' => $link,
                    'icon'            => 'fa-calendar',
                    'content'         => $content,
                    'check_sum'       => $check_sum,
                    'user_receive_id' => $user_receive_id,
                    'status'          => $default_status,
                ];
                if (!$this->notify_is_exist($check_sum)) {
                    $notify_id = $this->m_notification->insert($warning_data, TRUE);
                    if ($notify_id === FALSE) {
                        $data_return["state"] = 0; /* state = 2 : Lỗi thêm bản ghi */
                        $data_return["msg"] = "Thêm bản ghi thất bại do lỗi server, vui lòng thử lại hoặc liên hệ quản lý hệ thống!";
                        echo json_encode($data_return);
                        return FALSE;
                    }
                }
            }
        }
        $count = count($data);
        echo "Số đơn hàng về trễ hiện tại:" . $count;
        return $count;
    }

    private function get_user_receive_notify_for_warehouse_late($warehouse_id) {
        $company_id = $this->m_warehouses->get_company_id_of_warehouse_activity($warehouse_id);
        return $this->get_user_receive_notify($company_id, "warehouse_activity");
    }

    private function get_user_receive_notify_for_order_plan_late($warehouse_id) {
        $company_id = $this->m_warehouses->get_company_id_of_warehouse_activity($warehouse_id);
        return $this->get_user_receive_notify($company_id, "order_plan");
    }

    /**
     * get id user will receive notify by type of notify
     * @param $company_id
     * @param $notify_type
     * @return array|int
     */
    private function get_user_receive_notify($company_id, $notify_type) {
        $result = [];
        array_push($result, $company_id);
        if ($notify_type == "warehouse_activity") {
            $group_user_id = $this->m_user->get_group_user_in_company($company_id, ["ppc"]);
        }
        if ($notify_type == "order_plan") {
            $group_user_id = $this->m_user->get_group_user_in_company($company_id, ["ppc"]);
        }
        foreach ($group_user_id as $item) {
            array_push($result, $item->id);
        }
        return $result;
    }

    /**
     * @param $warning_data
     * @return bool
     */
    private function notify_is_exist($check_sum) {
        $where_in = [
            'm.check_sum' => $check_sum,
        ];
        $notify_data = $this->m_notification->get_list_filter([], $where_in, []);
        if (count($notify_data) != 0) {
            return TRUE;
        }
        return FALSE;
    }
}