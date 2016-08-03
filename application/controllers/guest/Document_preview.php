<?php

/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 02/08/2016
 * Time: 23:19
 */
class Document_preview extends Guest_layout
{
    function __construct(){
        parent::__construct();
        $this->load->model('M_system_config', 'm_system_config');
    }

    public function index(){
        $content = $this->load->view("guest/home/document-preview",null, TRUE);
        $this->show_page($content);
    }
}