<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 04-Jul-16
 * Time: 3:10 PM
 */
class M_order_producing_plans extends Crud_manager {
    protected $_table = 'order_producing_plans';
    protected $soft_delete = FALSE;
    public $schema = [
        'order_id'          => [
            'field'    => 'order_id',
            'db_field' => 'o.id',
            'label'    => 'ID đơn hàng',
            'rules'    => '',
        ],
        'line_id'           => [
            'field'    => 'line_id',
            'db_field' => 'l.id',
            'label'    => 'ID tổ',
            'rules'    => '',
            'table'    => [
                'label' => 'ID tổ',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
        ],
        'step_id'           => [
            'field' => 'step_id',
            'label' => 'Tên công đoạn',
            'rules' => '',
            'table' => TRUE,
        ],
        'date_ns_etd'       => [
            'field' => 'date_ns_etd',
            'label' => 'Ngày hết hạn',
            'rules' => '',
        ],
        'date_start'        => [
            'field' => 'date_start',
            'label' => 'Ngày bắt đầu',
            'rules' => '',
            'table' => TRUE,
        ],
        'date_end'          => [
            'field' => 'date_end',
            'label' => 'Ngày kết thúc',
            'rules' => '',
            'table' => TRUE,
        ],
        'count_saturday'    => [
            'field' => 'count_saturday',
            'label' => 'Có làm thứ 7',
            'rules' => '',
            'table' => TRUE,
        ],
        'count_sunday'      => [
            'field' => 'count_sunday',
            'label' => 'Có làm CN',
            'rules' => '',
            'table' => TRUE,
        ],
        'quantity_for_line' => [
            'field' => 'quantity_for_line',
            'label' => 'Số lượng',
            'rules' => '',
            'table' => TRUE,
        ],
        'output_per_day'    => [
            'field' => 'output_per_day',
            'label' => 'Năng suất',
            'rules' => '',
            'table' => TRUE,
        ],
        'note'              => [
            'field' => 'note',
            'label' => 'Ghi chú',
            'rules' => '',
            'table' => TRUE,
        ],
        'created_on'        => [
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
        l.name as line_name, 
        o.name as order_name,
        ");
        $this->db->join("lines as l", $this->_table_alias . ".line_id=l.id");
        $this->db->join("orders as o", $this->_table_alias . ".order_id=o.id");
    }
}