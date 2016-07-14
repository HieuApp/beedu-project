<?php
/**
 * Created by PhpStorm.
 * User: CaoLong
 * Date: 7/5/2016
 * Time: 10:34 AM
 */

class M_size extends Crud_manager {
    protected $_table = 'sizes';
    protected $soft_delete = FALSE;
    public $schema = [
        'name'        => [
            'field'    => 'name',
            'db_field' => 'name',
            'label'    => 'Tên kích cỡ',
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
                'label' => 'Tên kích cỡ',
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
                'class' => "hidden-480",
                'attr'  => 'data-check=\'true\'',
            ],
        ],
    ];

    public function __construct() {
        parent::__construct();
    }

}