<?php
/**
 * Created by PhpStorm.
 * User: CaoLong
 * Date: 7/5/2016
 * Time: 10:48 AM
 */

class M_system_config extends Crud_manager {
    protected $_table = 'system_configs';
    protected $soft_delete = FALSE;
    public $schema = [
        'name'        => [
            'field'    => 'name',
            'db_field' => 'name',
            'label'    => 'Tên thông số',
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
                'label' => 'Tên thông số',
            ],
        ],
        'value' => [
            'field'    => 'value',
            'db_field' => 'value',
            'label'    => 'Giá trị',
            'rules'    => '',
            'table'    => [
                'label' => 'Giá trị',
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