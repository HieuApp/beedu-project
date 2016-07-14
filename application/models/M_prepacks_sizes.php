<?php

/**
 * Created by PhpStorm.
 * User: ha
 * Date: 07/11/2016
 * Time: 9:00 AM
 */
class M_prepacks_sizes extends Crud_manager {
    protected $_table = 'prepacks_sizes';
    protected $soft_delete = FALSE;
    public $schema = [
        'prepack_id' => [
            'field'    => 'prepack_id',
            'db_field' => 'p.id',
            'label'    => 'Mã gói hàng',
            'rules'    => '',
            'table'    => TRUE,
        ],
        'size_id'    => [
            'field'    => 'size_id',
            'db_field' => 's.id',
            'label'    => 'Mã size',
            'rules'    => '',
            'table'    => TRUE,
        ],
        'size_name'  => [
            'field'    => 'size_name',
            'db_field' => 's.name',
            'label'    => 'Tên size',
            'rules'    => '',
            'table'    => TRUE,
        ],
        'quantity'   => [
            'field'    => 'quantity',
            'db_field' => 'quantity',
            'label'    => 'Số lượng',
            'rules'    => '',
            'table'    => TRUE,
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
        $this->before_get['join_all'] = "join_size_table";
    }

    public function join_size_table() {
        $this->db->select($this->_table_alias . ".*,
       s.name as size_name");
        $this->db->join("sizes as s", $this->_table_alias . ".size_id = s.id");
    }

    public function get_by_prepack_id($prepack_id = 0) {
        if ($prepack_id == 0) return NULL;
        if ($prepack_id) $this->_database->where($this->_table_alias . '.prepack_id', $prepack_id);
        return $this->get_all();
    }
}