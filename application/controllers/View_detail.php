<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 01-Aug-16
 * Time: 9:49 PM
 * @property M_documents m_documents
 */
class View_detail extends Base_guest_layout {
    function __construct() {
        parent::__construct();
        $this->load->model('M_documents', 'm_documents');
    }

//    public function index() {
//        $data["documents"] = $this->m_documents->get_all();
//        $content = $this->load->view("guest/category/view_detail", $data, TRUE);
//        $this->show_page($content);
//    }
}