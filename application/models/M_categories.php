<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 19-Jul-16
 * Time: 11:21 PM
 */
class M_categories extends Crud_manager {
    protected $_table = 'categories';
    protected $soft_delete = FALSE;
    public $schema = [
        'name'        => [
            'field'    => 'name',
            'db_field' => 'name',
            'label'    => 'Thư mục',
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
                'label' => 'Tên thể loại',
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
        'note'        => [
            'field'    => 'note',
            'db_field' => 'note',
            'label'    => 'Ghi chú',
            'rules'    => '',
            'form'     => [
                'type' => 'text',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
            'table'    => TRUE,
        ],
        'created_on'  => [
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
