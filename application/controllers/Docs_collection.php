<?php

/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 04/08/2016
 * Time: 19:31
 * @property M_documents  m_documents
 * @property M_categories m_categories
 */
class Docs_collection extends Guest_layout {
    function __construct() {
        parent::__construct();
        $this->load->model('M_documents', 'm_documents');
        $this->load->model('M_categories', 'm_categories');
    }

    public function index() {
        $list_category = $this->m_categories->get_all();
        $document_by_category = [];
        foreach ($list_category as $category) {
            $where = [
                'ct.id' => $category->id,
            ];
            $list_document_in_category = $this->m_documents->get_list_filter($where, [], []);
            array_push($document_by_category, [
                'category'                  => $category,
                'list_document_in_category' => $list_document_in_category,
            ]);
        }
        $data["document_by_category"] = $document_by_category;
        $content = $this->load->view("guest/home/docs_collection", $data, TRUE);
        $this->show_page($content);
    }
}