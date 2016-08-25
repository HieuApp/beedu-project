<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 8/25/2016
 * Time: 10:15 PM
 * @property M_learning_method m_learning_method
 */
class Learning_method extends Guest_layout {
    function __construct() {
        parent::__construct();
        $this->load->model('M_system_config', 'm_system_config');
        $this->load->model('M_questions', 'm_questions');
        $this->load->model('M_feedback_manage', 'm_feedback_manage');
        $this->load->model('M_image_homes', 'm_image_homes');
        $this->load->model('M_documents', 'm_documents');
        $this->load->model('M_classes', 'm_classes');
        $this->load->model('M_learning_method', 'm_learning_method');
    }

    public function index() { }

    public function view_method_detail($id) {
        $where = [
            'm.id' => $id,
        ];
        $data = [];
        $result = $this->m_learning_method->get_list_filter($where, [], []);
        if (count($result) > 0) {
            $data["avatar"] = $result[0]->avatar;
            $data["desc"] = $result[0]->description;
        }
        $content = $this->load->view("guest/home/method_detail_1", $data, TRUE);
        $this->show_page($content);
    }
}