<?php

/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 25/08/2016
 * Time: 11:00
 */
class Method_detail_4 extends Guest_layout {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $content = $this->load->view("guest/home/method_detail_4", null, TRUE);
        $this->show_page($content);
    }
}