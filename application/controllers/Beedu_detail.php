<?php

/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 02/08/2016
 * Time: 12:17
 * @property M_image_homes   m_image_homes
 * @property M_system_config m_system_config
 */
class Beedu_detail extends Guest_layout {

    function __construct() {
        parent::__construct();
        $this->load->model('M_system_config', 'm_system_config');
        $this->load->model('M_image_homes', 'm_image_homes');
    }

    public function index() {
        $result = $this->m_system_config->get_all();
        $image = $this->m_image_homes->get_all();
        $data["image"] = $image[7]->file;
        $data["hello_content"] = $result[22]->value;
        $data["para1"] = $result[23]->value;
        $data["para2"] = $result[24]->value;
        $data["para3"] = $result[25]->value;
        $data["para4"] = $result[26]->value;
        $data["para5"] = $result[27]->value;
        $data["para6"] = $result[28]->value;
        $data["para7"] = $result[29]->value;
        $data["para8"] = $result[30]->value;
        $data["para9"] = $result[31]->value;
        $data["para10"] = $result[32]->value;
        $data["para11"] = $result[33]->value;
        $data["para12"] = $result[34]->value;
        $data["author"] = $result[35]->value;
        $content = $this->load->view("guest/home/beedu_detail", $data, TRUE);
        $this->show_page($content);
    }
}