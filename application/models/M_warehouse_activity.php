<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 06-Jul-16
 * Time: 10:18 AM
 */
class M_warehouse_activity extends Crud_manager {
    protected $_table = 'warehouse_activities';
    protected $soft_delete = FALSE;
    public $schema = [
        'id'             => [
            'field'    => 'id',
            'db_field' => 'id',
            'label'    => 'Mã',
            'rule'     => '',
        ],
        'type'           => [
            'field'    => 'type',
            'db_field' => 'type',
            'label'    => 'Loại',
            'rule'     => '',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="type"',
            ],
            'table'    => [
                'label'                => 'Loại',
                'callback_render_data' => "get_type_text",
            ],
            'filter'   => [
                'type'            => 'select',
                'target_model'    => 'this',
                'target_function' => 'get_type',
            ],
        ],
        'warehouse_id'   => [
            'field'    => 'warehouse_id',
            'db_field' => 'warehouse_id',
            'label'    => 'Kho',
            'rule'     => '',
            'filter'   => [
                'label'           => 'Tên kho',
                'type'            => 'multiple_select',
                'target_model'    => 'M_warehouses',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
        ],
        'warehouse_name' => [
            'field'    => 'warehouse_name',
            'db_field' => 'wh.name',
            'label'    => 'Kho',
            'rules'    => '',
            'table'    => [
                'label' => 'Kho',
            ],
        ],
        'user_id'        => [
            'field'    => 'user_id',
            'db_field' => 'user_id',
            'label'    => 'Mã người tạo',
            'rule'     => '',
            'filter'   => [
                'label'           => 'Người tạo',
                'type'            => 'multiple_select',
                'target_model'    => 'M_user',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
        ],
        'user_name'      => [
            'field'    => 'user_name',
            'db_field' => 'u.name',
            'label'    => 'Người tạo',
            'rules'    => '',
            'table'    => [
                'label' => 'Người tạo',
            ],
        ],
        'time_receive'   => [
            'field'    => 'time_receive',
            'db_field' => 'time_receive',
            'label'    => 'Ngày về dự kiến',
            'rule'     => '',
            'table'    => TRUE,
        ],
        'date'           => [
            'field'    => 'date',
            'db_field' => 'date',
            'label'    => 'Ngày về thực tế',
            'rule'     => '',
            'form'     => [
                'type' => 'date',
                'attr' => 'data-test="date"',
            ],
            'table'    => TRUE,
        ],
        'material_pack'  => [
            'field'    => 'material_pack',
            'db_field' => 'material_pack',
            'label'    => 'Gói nguyên liệu',
            'rule'     => '',
            'table'    => TRUE,
        ],
        'note'           => [
            'field'    => 'note',
            'db_field' => 'note',
            'label'    => 'Ghi chú',
            'rule'     => '',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="note"',
            ],
            'table'    => TRUE,
        ],
        'warning'        => [
            'field' => 'warning',
            'label' => 'Cảnh báo',
            'rules' => '',
            'table' => [
                'callback_render_data' => "check_order_late",
            ],
        ],
    ];

    public function __construct() {
        parent::__construct();
        $this->before_get['join_all'] = "join_warehouses_table";
    }

    public function join_warehouses_table() {
        $this->db->select($this->_table_alias . ".*, 
         wh.name as warehouse_name,
         u.name as user_name,
        ");
        $this->db->join("warehouses as wh", $this->_table_alias . ".warehouse_id=wh.id");
        $this->db->join("users as u", $this->_table_alias . ".user_id=u.id");
    }

    public function get_type() {
        return [
            '0'  => 'Kế hoạch về kho',
            '1'  => 'Nhập kho',
            '-1' => 'Xuất kho',
        ];
    }

    public function get_type_text($id) {
        $type = $this->get_type();
        if (isset($type[$id])) {
            return $type[$id];
        } else {
            return $id;
        }
    }
}