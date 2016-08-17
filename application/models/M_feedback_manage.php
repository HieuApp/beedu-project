<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 03-Aug-16
 * Time: 10:33 PM
 */
class M_feedback_manage extends Crud_manager {
    protected $_table = 'feedback_manages';
    protected $soft_delete = FALSE;
    public $schema = [
        'email_reader'     => [
            'field'    => 'email_reader',
            'db_field' => 'email_reader',
            'label'    => 'Email độc giả',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="email_reader"',
            ],
            'table'    => [
                'label' => 'Email độc giả',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
        ],
        'feedback_content' => [
            'field'    => 'feedback_content',
            'db_field' => 'feedback_content',
            'label'    => 'Nội dung phản hồi',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="question"',
            ],
            'table'    => [
                'label' => 'Nội dung phản hồi',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
        ],
        'created_on'       => [
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