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
class M_classes extends Crud_manager {
    protected $_table = 'classes';
    protected $soft_delete = FALSE;
    public $schema = [
        'name'        => [
            'field'    => 'name',
            'db_field' => 'name',
            'label'    => 'Tên lớp',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="name"',
            ],
            'table'    => TRUE,
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
        ],
        'description' => [
            'field'    => 'description',
            'db_field' => 'description',
            'label'    => 'Mô tả ngắn',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
            'table'    => TRUE,
        ],
        'detail'      => [
            'field'    => 'detail',
            'db_field' => 'detail',
            'label'    => 'Mô tả chi tiết',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
            'table'    => TRUE,
        ],
        'price'       => [
            'field'    => 'price',
            'db_field' => 'price',
            'label'    => 'Học phí',
            'rules'    => 'required',
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