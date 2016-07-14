<?php

class M_warehouse_activity_items extends Crud_manager {
    protected $_table = 'warehouse_activity_items';
    protected $soft_delete = FALSE;
    public $schema = [
        'material_balance_id' => [
            'field'    => 'material_balance_id',
            'db_field' => 'material_balance_id',
            'label'    => 'Mã item cân đối',
        ],
        'quantity'            => [
            'field'    => 'quantity',
            'db_field' => 'mb.quantity',
            'label'    => 'Cần',
            'rules'    => 'greater_than[0]',
            'table'    => TRUE,
        ],
        'activity_id'         => [
            'field'    => 'activity_id',
            'db_field' => 'activity_id',
            'label'    => 'Mã hoạt động',
        ],
        'note'                => [
            'field' => 'note',
            'label' => 'Ghi chú',
            'rules' => '',
            'table' => TRUE,
        ],
        'created_on'          => [
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
        ");
    }
}