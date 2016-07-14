<?php

/**
 * Created by PhpStorm.
 * User: CaoLong
 * Date: 7/5/2016
 * Time: 5:09 PM
 */
class M_warehouse_order_plans extends Crud_manager {
    protected $_table = 'warehouse_order_plans';
    protected $soft_delete = FALSE;
    public $schema = [
        'user_name'    => [
            'field'    => 'user_name',
            'db_field' => 'u.name',
            'label'    => 'Người tạo',
            'rules'    => '',
            'table'    => [
                'label' => 'Người tạo',
            ],
        ],
        'user_id'      => [
            'field'    => 'user_id',
            'db_field' => 'user_id',
            'label'    => 'Người tạo',
            'rules'    => '',
            'form'     => [
                'type'            => 'select',
                'target_model'    => 'M_user',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
//                'callback_render_html' => "render_user_info",
            ],
        ],
        'order_id'     => [
            'field'    => 'order_id',
            'db_field' => 'order_id',
            'label'    => 'Mã đơn hàng',
            'filter'   => [
                'type'            => 'multiple_select',
                'target_model'    => 'M_order',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
            'form'     => [
                'type'            => 'select',
                'target_model'    => 'M_order',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
        ],
        'order_name'   => [
            'field'    => 'order_name',
            'db_field' => 'o.name',
            'label'    => 'Mã đơn hàng',
            'rules'    => '',
            'table'    => [
                'label' => 'Mã đơn hàng',
            ],
        ],
        'time_receive' => [
            'field'    => 'time_receive',
            'db_field' => 'time_receive',
            'label'    => 'Ngày về dự kiến',
            'rules'    => '',
            'table'    => [
                'label' => 'Ngày về dự kiến',
            ],
            'form'     => [
                'type' => 'date',
            ],
        ],
        'created_on'   => [
            'field' => 'created_on',
            'label' => 'Ngày tạo',
            'rules' => '',
            'table' => [
                'class' => "hidden-480",
                'attr'  => 'data-check=\'true\'',
            ],
        ],
        'note'         => [
            'field'    => 'note',
            'db_field' => 'note',
            'label'    => 'Trạng thái',
            'rules'    => '',
            'table'    => [
                'label' => 'Trạng thái',
            ],
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="note"',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
        ],
    ];

    public function __construct() {
        parent::__construct();
        $this->before_get['join_all'] = "join_role_table";
    }

//    protected function set_schema_user_by_role() {
//        if ($this->is_allow_manager()) {
//
//        } else {
//            unset($this->schema['user_id']['form']);
//        }
//    }
//
//    public function is_allow_manager() {
//        if ($this->is_in_group("admin") || $this->is_in_group("corporation") || $this->is_in_group("ppc")) {
//            return TRUE;
//        } else {
//            return FALSE;
//        }
//    }

    public function join_role_table() {
        $this->db->select($this->_table_alias . ".*,
         o.name as order_name, u.name as user_name");
        $this->db->join("orders as o", $this->_table_alias . ".order_id = o.id");
        $this->db->join("users as u", $this->_table_alias . ".user_id = u.id");
    }

//    public function get_user_name_from_database() {
//        $this->db->select('name');
//        $this->db->from("users");
//        $this->db->join('ion_users_groups', 'ion_users_groups.user_id = users.id');
//        $this->db->where('group_id <', 4);
//        $query = $this->db->get();
//        return $query->result_array();
//    }
}
