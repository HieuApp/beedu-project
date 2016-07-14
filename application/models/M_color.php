<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 05-Jul-16
 * Time: 9:36 AM
 */
class M_color extends Crud_manager {
    protected $_table = 'colors';
    protected $soft_delete = FALSE;
    public $schema = [
        'name'        => [
            'field'    => 'name',
            'db_field' => 'name',
            'label'    => 'Tên màu',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="name"',
            ],
            'filter'   => [
                'search_type' => 'like',
                'attr'        => 'data-test="filter"',
            ],
            'table'    => [
                'label' => 'Tên màu',
            ],
        ],
        'color_code'  => [
            'field'    => 'color_code',
            'db_field' => 'color_code',
            'label'    => 'Mã màu',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="color_code"',
            ],
            'filter'   => [
                'search_type' => 'like',
                'attr'        => 'data-test="filter"',
            ],
            'table'    => [
                'label' => 'Mã màu',
            ],
        ],
        'description' => [
            'field'    => 'description',
            'db_field' => 'description',
            'label'    => 'Mô tả',
            'rules'    => '',
            'table'    => [
                'label' => 'Mô tả',
            ],
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="description"',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
        ],
        'created_on'  => [
            'field' => 'created_on',
            'label' => 'Ngày tạo',
            'rules' => '',
            'table' => [
//                'callback_render_data' => "timestamp_to_date",
                'class' => "hidden-480",
                'attr'  => 'data-check=\'true\'',
            ],
        ],
    ];

    public function __construct() {
        parent::__construct();
    }
}