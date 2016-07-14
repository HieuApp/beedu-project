<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 04-Jul-16
 * Time: 3:25 PM
 */
class M_order_technical_attributes extends Crud_manager {
    protected $_table = 'order_technical_attributes';
    protected $soft_delete = FALSE;
    public $schema = [
        'order_id'   => [
            'field'    => 'order_id',
            'db_field' => 'o.id',
            'label'    => 'ID đơn hàng',
            'rules'    => '',
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
        $this->before_get['join_all'] = "join_user_table";
    }

    public function join_user_table() {
        $this->db->select($this->_table_alias . ".*, 
        o.name as order_name,
        ");
        $this->db->join("orders as o", $this->_table_alias . ".order_id=o.id");
    }
}