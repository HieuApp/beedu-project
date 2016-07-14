<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 12-Jul-16
 * Time: 10:02 AM
 */
class Notification_manage extends Manager_base {
    public function __construct() {
        parent::__construct();
        $this->is_in_group(['admin', 'corporation', 'ppc'], TRUE);
        $this->load->model('M_warehouse_activity', 'm_warehouse_activity');
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "notification_manage",
            "view"   => "notification_manage",
            "model"  => "m_notification",
            "object" => "thông báo",
        );
    }

    public function add_link($origin_column_value, $column_name, &$record, $column_data, $caller) {

        return "<a href='.$origin_column_value.'>$origin_column_value</a>";

    }

    public function create_notify() {
        $this->check_order_late_warning();
    }

    /**
     * @return bool|int
     */
    public function check_order_late_warning() {
        $data = $this->m_warehouse_activity->get_all();
        $count = 0;
        foreach ($data as $item) {
            if ($item->type == 0) {
                if (strtotime($item->time_receive) > strtotime(date("Y-m-d"))) {
                    $count += 0;
                } else {
                    $count++;
                }
            }
        }
        if ($count > 0) {
            $warning_data = [
                'link_to_warning' => site_url('warehouse_order_plans'),
                'icon'            => 'fa-calendar',
                'content'         => 'Có ' . $count . ' đơn hàng về kho trễ',
                'count'           => $count,
                'user_receive_id' => '1',
                'status'          => '-1',
            ];
            if ($this->check_if_exist($warning_data)) {
                $notify_id = $this->model->insert($warning_data, TRUE);
                if (!$notify_id) {
                    $data_return["state"] = 0; /* state = 2 : Lỗi thêm bản ghi */
                    $data_return["msg"] = "Thêm bản ghi thất bại do lỗi server, vui lòng thử lại hoặc liên hệ quản lý hệ thống!";
                    echo json_encode($data_return);
                    return FALSE;
                } else return $count;
            }
        } else return $count;
    }

    /**
     * @param $warning_data
     * @return bool
     */
    public function check_if_exist($warning_data) {
        $notify_data = $this->model->get_all();
        $check = TRUE;
        foreach ($notify_data as $item) {
            if ($warning_data['link_to_warning'] == $item->link_to_warning && $item->status == -1) {
                if ($warning_data['count'] == $item->count) {
                    $check = FALSE;
                    break;
                }
            } else $check = TRUE;
        }
        return $check;
    }

    /**
     * to change status of notify from -1 to 1
     * @param $id
     */
    public function update_notify_status($id) {
        $data = Array(
            'status' => 1,
        );
        $update = $this->model->update($id, $data, $skip_validate = TRUE);
        redirect(site_url("notification_manage"));
    }
}