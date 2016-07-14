<?php

/**
 * Created by IntelliJ IDEA.
 * User: phong
 * Date: 29-Jun-16
 * Time: 9:10 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Line
 * This class declare the controller managing lines' (which called "tổ sản xuất") activities, such as update progress
 */
class Daily_productivity extends Manager_base {
    public function __construct() {
        parent::__construct();
        $this->load->model("m_order", "order");
        $this->load->model("m_line", "line");
    }

    /**
     * Hàm cài đặt biến $name cho controller (xem trong 1 controller bất kỳ để biết chi tiết)
     */
    function setting_class() {
        $this->name = Array(
            "class"  => "daily_productivity",
            "view"   => "daily_productivity",
            "model"  => "m_daily_productivity",
            "object" => "cập nhật tiến độ",
        );
    }

    public function render_date_input($form_item, $form_id, $value) {
        $data = [
            'form_item' => $form_item,
            'form_id'   => $form_id,
            'value'     => $value,
        ];
        return $this->load->view($this->path_theme_view . "/daily_productivity/date", $data, TRUE);
    }

    public function test_form() {
        $save_url = site_url('daily_productivity/test_save');
        $user_add = site_url('admin/user/add');
        $content = "
            <form action='$save_url' class='e_ajax_submit'>
                <input name='name'/>
                <button>Save</button>
            </form>
            <script>
            function js_callback_test(data, form, button){
                   alert('xxxx');
            }
            </script>
        ";
        echo json_encode(Array(
            'html'  => $content,
            'state' => 1,
        ));
//        $this->show_page($content);
    }

    public function test() {
        $user_add = site_url('daily_productivity/test_form');
        $content = "
            <a href='$user_add' class='e_ajax_link'>Click to add user</a>
        ";
        $this->show_page($content);
    }

    public function test_save() {
        $data = $this->input->post();
        $data['callback'] = 'js_callback_test';
        echo json_encode($data);
    }


}