<?php

/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 02/08/2016
 * Time: 12:17
 */
class Beedu_detail extends Guest_layout{

    function __construct(){
        parent::__construct();
        $this->load->model('M_system_config', 'm_system_config');

    }

    public function index(){
        $content = $this->load->view("guest/home/beedu_detail",null, TRUE);
        $this->show_page($content);
    }
}