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
        $content = $this->load->view("guest/home/document", NULL, TRUE);
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

    public function search() {
        $key = $this->input->post("key");
        if (!$key) {
            redirect(base_url());
        }
        $like_name_Condition = [
            'm.name' => $key,
        ];
        $like_description_Condition = [
            'm.description' => $key,
        ];
        $data = [];
        $result_by_name = $this->m_documents->get_list_filter([], [], $like_name_Condition);
        $result_by_description = $this->m_documents->get_list_filter([], [], $like_description_Condition);
        if (count($result_by_name)) {
            foreach ($result_by_name as $item_name) {
                array_push($data, $item_name);
            }
        }
        if (count($result_by_description)) {
            foreach ($result_by_description as $item_des) {
                array_push($data, $item_des);
            }
        }
        $data_result["document_by_category"] = $data;
        $content = $this->load->view("guest/home/search_result", $data_result, TRUE);
        if(sizeof($data) == 0){
            $content = $this->load->view("guest/home/search_not_found", $data_result, TRUE);
        }
        $this->show_page($content);
    }

    public function download($id) {
        $where = [
            'm.id' => $id,
        ];
        $document = $this->m_documents->get_list_filter($where, [], [])[0];
        $file = $document->file;
        $count_downloaded = $document->count_downloaded;
        $count_downloaded += 1;
        $data_update_count = [
            'count_downloaded' => $count_downloaded,
        ];
        if (file_exists($file)) {
            $update_id = $this->m_documents->update($id, $data_update_count, TRUE);
            header('Content-Description: File Transger');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires:0');
            header('Pragma: public');
            header('Content-Length:' . filesize($file));
            readfile($file);
            redirect(base_url());
        }
    }
}