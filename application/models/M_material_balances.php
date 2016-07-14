<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 04-Jul-16
 * Time: 3:44 PM
 */
class M_material_balances extends Crud_manager {
    protected $_table = 'material_balances';
    protected $soft_delete = FALSE;
    public $schema = [
        'order_id'      => [
            'field'    => 'order_id',
            'db_field' => 'o.id',
            'label'    => 'ID đơn hàng',
            'rules'    => '',
            'table'    => TRUE,
        ],
        'order_name'      => [
            'field'    => 'order_name',
            'db_field' => 'o.name',
            'label'    => 'Tên đơn hàng',
            'rules'    => '',
            'table'    => TRUE,
        ],
        'color_id'      => [
            'field'    => 'color_id',
            'db_field' => 'c.id',
            'label'    => 'ID màu',
            'rules'    => '',
        ],
        'size_id'       => [
            'field'    => 'size_id',
            'db_field' => 's.id',
            'label'    => 'ID size',
            'rules'    => '',
        ],
        'material_id'   => [
            'field'    => 'material_id',
            'db_field' => 'mt.id',
            'label'    => 'ID nguyên liệu',
            'rules'    => '',
            'table'    => TRUE,
        ],
        'material_name' => [
            'field'    => 'material_name',
            'db_field' => 'mt.name',
            'label'    => 'Tên nguyên liệu',
            'rules'    => '',
            'table'    => [
                'label' => 'Tên nguyên liệu',
            ],
        ],
        'material_unit' => [
            'field'    => 'material_unit',
            'db_field' => 'mt.unit',
            'label'    => 'Đơn vị',
            'table'    => TRUE,
        ],
        'note'          => [
            'field' => 'note',
            'label' => 'Ghi chú',
            'rules' => '',
            'table' => TRUE,
        ],
        'created_on'    => [
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
        $this->before_get['join_all'] = "join_order_table";
    }

    public function join_order_table() {
        $this->db->select($this->_table_alias . ".*, 
        mt.name as material_name, 
        mt.unit as material_unit, 
        o.name as order_name,
        s.name as size_name,
        ");
        $this->db->join("materials as mt", $this->_table_alias . ".material_id=mt.id");
        $this->db->join("orders as o", $this->_table_alias . ".order_id=o.id");
        $this->db->join("sizes as s", $this->_table_alias . ".size_id=s.id");
    }

    public function get_material_balance_list($order_id = 0, $material_id = NULL, $size_id = NULL) {
        if ($order_id == 0) return NULL;
        $this->_database->where('order_id', $order_id);
        if ($material_id) $this->_database->where('material_id', $material_id);
        if ($size_id) $this->_database->where('size_id', $size_id);
        return $this->get_all();
    }
}