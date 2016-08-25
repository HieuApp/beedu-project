<?php

/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 16/08/2016
 * Time: 23:33
 */
class Method_detail_1 extends Guest_layout {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $content = $this->load->view("guest/home/method_detail_1", null, TRUE);
        $this->show_page($content);
    }
}