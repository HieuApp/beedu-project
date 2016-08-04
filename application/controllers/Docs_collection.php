<?php

/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 04/08/2016
 * Time: 19:31
 */
class Docs_collection extends Guest_layout
{
    function __construct(){
        parent::__construct();
        $this->load->model('M_system_config', 'm_system_config');
    }

    public function index(){
        $content = $this->load->view("guest/home/docs_collection",null, TRUE);
        $this->show_page($content);
    }
}