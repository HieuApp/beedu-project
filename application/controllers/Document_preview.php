<?php

/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 02/08/2016
 * Time: 23:19
 * @property M_documents  m_documents
 * @property M_categories m_categories
 */
class Document_preview extends Guest_layout {
    function __construct() {
        parent::__construct();
        $this->load->model('M_documents', 'm_documents');
        $this->load->model('M_categories', 'm_categories');
    }

    public function index() {
        $content = $this->load->view("guest/home/document-preview", NULL, TRUE);
        $this->show_page($content);
    }

    public function view_detail($id) {
        $document = $this->m_documents->get_list_filter(['m.' . 'id' => $id], [], [])[0];
        $data["document"] = $document;
        $category_id = $document->category_id;
        $where = [
            'ct.id' => $category_id,
        ];
        $list_document_in_category = $this->m_documents->get_list_filter($where, [], [], 5);
        $data["document_by_category"] = $list_document_in_category;
        $content = $this->load->view("guest/home/document-preview", $data, TRUE);
        $this->show_page($content);
    }
}