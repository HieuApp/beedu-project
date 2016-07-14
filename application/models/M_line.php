<?php

/**
 * Created by IntelliJ IDEA.
 * User: phong
 * Date: 29-Jun-16
 * Time: 9:29 AM
 */
class M_line extends Crud_manager {
    protected $_table = 'lines';
    protected $soft_delete = FALSE;
    public $schema = [
        'name'       => [
            'field'  => 'name',
            'label'  => 'Tên tổ sản xuất',
            'rules'  => '',
            'form'   => [
                'type' => 'text',
                'attr' => 'data-test="name"',
            ],
            'filter' => [
                'type'            => 'multiple_select',
                'target_model'    => 'this',
                'target_function' => 'dropdown',
                'target_arg'      => ['name', 'name'],
            ],
            'table'  => [
                'label' => 'Tên tổ sản xuất',
            ],
        ],
        'user_id'    => [
            'field'    => 'user_id',
            'db_field' => 'g.id',
            'label'    => 'Tên đội trưởng',
            'rules'    => '',
            'form'     => [
                'type'            => 'select',
                'target_model'    => 'M_user',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
            'filter'   => [
                'type' => 'multiple_select',
            ],
        ],
        'user_name'  => [
            'field'    => 'user_name',
            'db_field' => 'u.name',
            'label'    => 'Tên đội trưởng',
            'rules'    => '',
            'table'    => [
                'label' => 'Tên đội trưởng',
            ],
//            'filter'   => [
//                'search_type' => 'like',
//                'type'        => 'text',
//            ],
        ],
        'created_on' => [
            'field' => 'created_on',
            'label' => 'Ngày tạo',
            'rules' => '',
            'table' => [
//                'callback_render_data' => "timestamp_to_date",
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
        u.name as user_name, 
        ");
        $this->db->join("users as u", $this->_table_alias . ".user_id=u.id");
    }
}