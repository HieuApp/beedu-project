<?php

/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 02/08/2016
 * Time: 09:57
 */
class Register_trial extends Guest_layout{
    function __construct(){
        parent::__construct();
        $this->load->model('M_system_config', 'm_system_config');
    }

    public function index(){
        $content = $this->load->view("guest/home/register_form",null, TRUE);
        $this->show_page($content);
    }
}