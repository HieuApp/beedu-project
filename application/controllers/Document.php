<?php

/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 02/08/2016
 * Time: 19:31
 * @property M_documents  m_documents
 * @property M_categories m_categories
 */
class Document extends Guest_layout {
    function __construct() {
        parent::__construct();
        $this->load->model('M_documents', 'm_documents');
        $this->load->model('M_categories', 'm_categories');
    }


    public function index() {
        $content = $this->load->view("guest/home/document", null, TRUE);
        $this->show_page($content);
    }

    public function view_category($id) {
        $category = $this->m_categories->get_list_filter(['id' => $id], [], [])[0];
        $where = [
            'ct.id' => $category->id,
        ];
        $list_document_in_category = $this->m_documents->get_list_filter($where, [], []);
        $data["category"] = $category;
        $data["document_by_category"] = $list_document_in_category;
        $content = $this->load->view("guest/home/document", $data, TRUE);
        $this->show_page($content);
    }
}