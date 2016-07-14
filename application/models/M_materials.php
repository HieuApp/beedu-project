<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 04-Jul-16
 * Time: 3:56 PM
 */
class M_materials extends Crud_manager {
    protected $_table = 'materials';
    protected $soft_delete = FALSE;
    public $schema = [
        'name'        => [
            'field'  => 'name',
            'label'  => 'Tên nguyên liệu',
            'rules'  => '',
            'form'   => [
                'type' => 'text',
                'attr' => 'data-test="name"',
            ],
            'filter' => [
                'search_type' => 'like',
                'attr'        => 'data-test="filter"',
            ],
            'table'  => [
                'label' => 'Tên nguyên liệu',
            ],
        ],
        'unit'        => [
            'field'    => 'unit',
            'db_field' => 'unit',
            'label'    => 'Đơn vị',
            'table'    => [
                'label'                => 'Đơn vị',
                'callback_render_data' => "get_unit_text",
            ],
            'form'     => [
                'type'            => 'select',
                'target_model'    => 'M_materials',
                'target_function' => 'get_unit',
            ],
        ],
        'description' => [
            'field' => 'description',
            'label' => 'Mô tả',
            'rules' => '',
            'table' => TRUE,
            'form'  => [
                'type' => 'text',
            ],
        ],
        'note'        => [
            'field' => 'note',
            'label' => 'Ghi chú',
            'rules' => '',
            'table' => TRUE,
            'form'  => [
                'type' => 'text',
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


    public function get_unit() {
        return [
            '1' => 'Yds',
            '0' => 'Pcs',
        ];
    }

    public function get_unit_text($id) {
        $unit = $this->get_unit();
        if (isset($unit[$id])) {
            return $unit[$id];
        } else {
            return $id;
        }
    }
}