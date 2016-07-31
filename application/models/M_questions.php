<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 12-Jul-16
 * Time: 9:53 AM
 */

/**
 * Class M_notification
 */
class M_questions extends Crud_manager {
    protected $_table = 'questions';
    protected $soft_delete = FALSE;
    public $schema = [
        'question'   => [
            'field'    => 'question',
            'db_field' => 'question',
            'label'    => 'Nội dung câu hỏi',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="question"',
            ],
            'table'    => [
                'label' => 'Nội dung câu hỏi',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
        ],
        'answer'     => [
            'field'    => 'answer',
            'db_field' => 'answer',
            'label'    => 'Câu trả lời',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
            'table'    => [
//                'callback_render_data' => "get_status_text",
                'class'                => "hidden-480",
            ],
        ],
        'created_on' => [
            'field' => 'created_on',
            'label' => 'Ngày tạo',
            'rules' => '',
            'table' => [
                'class' => "hidden-480",
                'attr'  => 'data-check=\'true\'',
            ],
        ],
    ];

    public function __construct() {
        parent::__construct();
    }
}