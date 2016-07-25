<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 25-Jul-16
 * Time: 10:27 PM
 */
class Home extends Guest_layout {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = [];
        $content = $this->load->view("guest/home/view", $data, TRUE);
        $this->show_page($content);
    }
}