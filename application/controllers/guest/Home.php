<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 25-Jul-16
 * Time: 10:27 PM
 * @property M_system_config m_system_config
 */
class Home extends Guest_layout {

    function __construct() {
        parent::__construct();
        $this->load->model('M_system_config', 'm_system_config');
    }

    public function index() {
        $result = $this->m_system_config->get_all();
        $data["menu_1"] = $result[1]->value;
        $data["menu_2"] = $result[2]->value;
        $data["menu_3"] = $result[3]->value;
        $data["menu_4"] = $result[4]->value;
        $data["menu_5"] = $result[5]->value;
        $data["introduce_title"] = $result[6]->value;
        $data["learning_method_1"] = $result[7]->value;
        $data["learning_method_2"] = $result[8]->value;
        $data["learning_method_3"] = $result[9]->value;
        $data["learning_method_4"] = $result[10]->value;
        $data["learning_method_content_1"] = $result[11]->value;
        $data["learning_method_content_2"] = $result[12]->value;
        $data["learning_method_content_3"] = $result[13]->value;
        $data["learning_method_content_4"] = $result[14]->value;
        $content = $this->load->view("guest/home/view", null, TRUE);
        $this->show_page($content);
    }
}