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
class M_notification extends Crud_manager {
    protected $_table = 'notifications';
    protected $soft_delete = FALSE;
    public $schema = [
        'link_to_warning' => [
            'field' => 'link_to_warning',
            'label' => 'Đường dẫn tới mục cảnh báo',
            'rules' => '',
            'form'  => [
                'type' => 'text',
                'attr' => 'data-test="link_to_warning"',
            ],
            'table' => [
                'label'                => 'Link',
                'callback_render_data' => "add_link",
            ],
        ],
        'content'         => [
            'field' => 'content',
            'label' => 'Nội dung',
            'rules' => '',
            'form'  => [
                'type' => 'text',
                'attr' => 'data-test="content"',
            ],
            'table' => [
                'label' => 'Nội dung',
            ],
        ],
        'status'          => [
            'field'    => 'status',
            'db_field' => 'status',
            'label'    => 'Trạng thái',
            'rules'    => '',
            'form'     => [
                'type'            => 'select',
                'target_model'    => 'this',
                'target_function' => 'get_status',
                'class'           => '',
            ],
            'filter'   => [
                'type' => 'multiple_select',
            ],
            'table'    => [
                'callback_render_data' => "get_status_text",
                'class'                => "hidden-480",
            ],
        ],
        'created_on'      => [
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

    public function get_status() {
        return [
            '1'  => 'Đã xem',
            '0'  => 'Chưa xem',
            '-1' => 'Chưa nhận',
        ];
    }

    public function get_status_text($id) {
        $status = $this->get_status();
        if (isset($status[$id])) {
            return $status[$id];
        } else {
            return $id;
        }
    }
}