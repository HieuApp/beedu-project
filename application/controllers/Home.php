<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 25-Jul-16
 * Time: 10:27 PM
 * @property M_system_config   m_system_config
 * @property M_questions       m_questions
 * @property M_feedback_manage m_feedback_manage
 * @property M_image_homes     m_image_homes
 * @property M_documents       m_documents
 * @property M_classes         m_classes
 */
class Home extends Guest_layout {

    function __construct() {
        parent::__construct();
        $this->load->model('M_system_config', 'm_system_config');
        $this->load->model('M_questions', 'm_questions');
        $this->load->model('M_feedback_manage', 'm_feedback_manage');
        $this->load->model('M_image_homes', 'm_image_homes');
        $this->load->model('M_documents', 'm_documents');
        $this->load->model('M_classes', 'm_classes');
    }

    public function index() {
        $result = $this->m_system_config->get_all();
        $data["menu_1"] = $result[1]->value;
        $data["menu_2"] = $result[2]->value;
        $data["menu_3"] = $result[3]->value;
        $data["menu_4"] = $result[4]->value;
        $data["menu_5"] = $result[5]->value;
        $data["introduce_title"] = $result[6]->value;
        $data["learning_method_1"] = $result[7]->value;
        $data["learning_method_2"] = $result[8]->value;
        $data["learning_method_3"] = $result[9]->value;
        $data["learning_method_4"] = $result[10]->value;
        $data["learning_method_content_1"] = $result[11]->value;
        $data["learning_method_content_2"] = $result[12]->value;
        $data["learning_method_content_3"] = $result[13]->value;
        $data["learning_method_content_4"] = $result[14]->value;
        $data["link_youtube_intro"]=$result[25]->value;

        $data["save_link"] = base_url("home/send_feedback");

        $question = $this->m_questions->get_list_filter([], [], [], 5);
        $data["questions"] = $question;

        $list_image = $this->m_image_homes->get_all();
        $data["img_bg_intro"] = $list_image[0]->file;
        $data["student_class"] = $list_image[5]->file;
        $data["library"] = $list_image[6]->file;

        $list_document_newest = $this->m_documents->get_list_filter([], [], [], 3, '', 'created_on');// sap xep tu cu den moi
        $data["documents_newest"] = $list_document_newest;

        $list_document_downloaded = $this->m_documents->get_list_filter([], [], [], 3, '', 'count_downloaded');// sap xep tu cu den moi
        $data["documents_hotest"] = $list_document_downloaded;

        $list_document_special = $this->m_documents->get_list_filter([], [], [], 3, '', 'created_on');// sap xep tu cu den moi
        $data["documents_special"] = $list_document_special;

        $list_class = $this->m_classes->get_all();
        $data["classes"] = $list_class;

        $content = $this->load->view("guest/home/view", $data, TRUE);
        $this->show_page($content);
    }

    public function send_feedback() {
        if (!$_POST["email"]) {
            return;
        }
        $question = $_POST["question"];
        $email = $_POST["email"];
        $data = [
            'feedback_content' => $question,
            'email_reader'     => $email,
        ];
        $insert_id = $this->m_feedback_manage->insert($data, TRUE);
        if (!$insert_id == FALSE) {
            echo "success";
        } else {
            echo "error";
        }
    }
}