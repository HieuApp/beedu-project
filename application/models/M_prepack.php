<?php

/**
 * Created by IntelliJ IDEA.
 * User: phong
 * Date: 11-Jul-16
 * Time: 10:18 AM
 */
class M_prepack extends Crud_manager {
    protected $_table = 'prepacks';
    protected $soft_delete = FALSE;//TODO $soft_delete = TRUE
    public $schema = [
        'name'       => [
            'field'    => 'name',
            'db_field' => 'm.name',
            'label'    => 'Tên prepack',
            'rules'    => 'require',
            'table'    => TRUE,
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="color"',
            ],
        ],
        'order_id'   => [
            'field'    => 'order_id',
            'db_field' => 'o.id',
            'label'    => 'Mã order',
            'rules'    => '',
        ],
        'order_name' => [
            'field'    => 'order_name',
            'db_field' => 'o.name',
            'label'    => 'Mã đơn hàng',
            'table'    => [
                'label' => 'Mã đơn hàng',
            ],
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
        $this->before_get['join_all'] = "join_tables";
    }

    public function join_tables() {
        $this->db->select($this->_table_alias . ".*, o.name as order_name, ");
        $this->db->join("orders as o", $this->_table_alias . ".order_id=o.id");
    }

    public function get_by_order_id($order_id = 0) {
        if ($order_id == 0) return NULL;
        if ($order_id) $this->_database->where($this->_table_alias . '.order_id', $order_id);
        return $this->get_all();
    }
}