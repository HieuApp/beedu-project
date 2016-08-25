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
//        echo "<pre>";
//        var_dump($result);
        $image = $this->m_image_homes->get_all();
        $data["image"] = $image[8]->file;
        $data["title"] = $result[22]->value;
        $data["par1"] = $result[23]->value;
        $data["par2"] = $result[24]->value;
        $content = $this->load->view("guest/home/beedu_detail", $data, TRUE);
        $this->show_page($content);
    }
}