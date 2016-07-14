<?php

/**
 * Created by IntelliJ IDEA.
 * User: phamtrong
 * Date: 14/06/16
 * Time: 16:56
 */
class User extends Manager_base {

    function __construct() {
        parent::__construct();
        $this->is_in_group(['admin', 'corporation'], TRUE);
    }

    /**
     * Hàm cài đặt biến $name cho controller (xem trong 1 controller bất kỳ để biết chi tiết)
     */
    function setting_class() {
        $this->name = Array(
            "class"  => "admin/user",
            "view"   => "admin/user",
            "model"  => "m_user",
            "object" => "tài khoản",
        );
    }

    protected function custom_render_password($form_item, $form_id) {
        $data = [
            'form_item' => $form_item,
            'form_id'   => $form_id,
        ];
        return $this->load->view($this->path_theme_view . "/user/password", $data, TRUE);
    }

    public function add_link($origin_column_value, $column_name, &$record, $column_data, $caller) {
        return "<a href='#'>$origin_column_value</a>";
    }

    public function profile() {
        $id = $this->session->userdata("user_id");
        $data = [
            "save_link" => site_url($this->name["class"] . "/profile_save"),
        ];
        unset($this->model->schema['role_id']);
        unset($this->model->schema['active']);
        $this->model->include_my_profile();
        $this->edit($id, $data);
    }

    public function profile_save() {
        $id = $this->session->userdata("user_id");
        unset($this->model->schema['role_id']);
        unset($this->model->schema['active']);
        $this->model->include_my_profile();
        $this->edit_save($id);
    }
}