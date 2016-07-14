<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 06-Jul-16
 * Time: 10:18 AM
 */
class M_warehouses extends Crud_manager {
    protected $_table = 'warehouses';
    protected $soft_delete = FALSE;
    public $schema = [
        'name'       => [
            'field'    => 'name',
            'db_field' => 'name',
            'label'    => 'Tên kho',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="name"',
            ],
            'filter'   => [
                'type'            => 'multiple_select',
                'target_model'    => 'this',
                'target_function' => 'dropdown',
                'target_arg'      => ['name', 'name'],
            ],
            'table'    => [
                'label' => 'Tên kho',
            ],
        ],
        'note'       => [
            'field'    => 'note',
            'db_field' => 'note',
            'label'    => 'Ghi chú',
            'rules'    => '',
            'table'    => [
                'label' => 'Ghi chú',
            ],
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="note"',
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