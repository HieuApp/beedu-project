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
    }

    public function setting_class() {
        $this->name = Array(
            "class"  => "admin/notification_manage",
            "view"   => "admin/notification_manage",
            "model"  => "m_notification",
            "object" => "thông báo",
        );
    }

    public function get_column_data($columns = Array()) {
        $columns = parent::get_column_data();
        unset($columns['custom_check']);
        return $columns;
    }

    public function add_link($origin_column_value, $column_name, &$record, $column_data, $caller) {
        return "<a href='.$origin_column_value.'>$origin_column_value</a>";
    }

    /**
     * @param $id
     */
    public function read_notify($id) {
        $notify_data = $this->m_notification->get($id);
        if ($this->session->userdata()["user_id"] == $notify_data->user_receive_id) {
            $this->update_notify_status($id);
            redirect($notify_data->link_to_warning);
        } else {
            show_error("You don't have permission to read this notify!");
        }
    }

    /**
     * @param $id
     */
    public function check_seen_notify($id) {
        $result = $this->update_notify_status($id);
        echo json_encode([
            'callback' => 'seen_notify_callback',
            'state'    => $result,
        ]);
    }

    /**
     * to change status of notify from -1 to 1
     * @param $id
     */
    public function update_notify_status($id) {
        $data = Array(
            'status' => 1,
        );
        $update = $this->m_notification->update($id, $data, $skip_validate = TRUE);
        return $update;
    }

    public function add_action_button($origin_column_value, $column_name, &$record, $column_data, $caller) {
        $this->load_more_js("assets/js/page/notify/notify.js", TRUE);
        $primary_key = $this->model->get_primary_key();
        $is_seen = $record->status === 'Đã xem';
        $custom_action = " <a type='radio' 
                            class='btn_check_seen tooltip-success btn ";
        if ($is_seen) $custom_action .= "btn-success";
        $custom_action .= " btn-sm e_ajax_link' data-rel='tooltip' data-placement='right' title='Đánh dấu đã xem'
                            href='" . site_url('notification_manage/check_seen_notify') . '/' . $record->$primary_key . "'>";
        $custom_action .= $is_seen ? "<i class='fa fa-check-square-o' aria-hidden='true'></i> Đã xem" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nhận&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $custom_action .= "</a>";
        return $custom_action;
    }
}