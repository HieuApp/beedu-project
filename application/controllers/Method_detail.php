<?php

/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 16/08/2016
 * Time: 23:33
 */
class Method_detail extends Guest_layout {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $content = $this->load->view("guest/home/method_detail", null, TRUE);
        $this->show_page($content);
    }
}