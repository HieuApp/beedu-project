<?php

/**
 * Created by PhpStorm.
 * User: ha
 * Date: 07/11/2016
 * Time: 8:50 AM
 */
class M_prepacks_colors extends Crud_manager {
    protected $_table = 'prepacks_colors';
    protected $soft_delete = FALSE;
    public $schema = [
        'prepack_id' => [
            'field'    => 'prepack_id',
            'db_field' => 'p.id',
            'label'    => 'Mã gói hàng',
            'rules'    => '',
            'table'    => TRUE,
        ],
        'color_id'   => [
            'field'    => 'color_id',
            'db_field' => 'c.id',
            'label'    => 'Mã màu sắc',
            'rules'    => '',
            'table'    => TRUE,
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="color"',
            ],
        ],
        'color_name' => [
            'field'    => 'color_name',
            'db_field' => 'c.name',
            'label'    => 'Tên màu',
            'rules'    => '',
            'table'    => TRUE,
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="color"',
            ],
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
        $this->before_get['join_all'] = "join_color_table";
    }

    public function join_color_table() {
        $this->db->select($this->_table_alias . ".*,
       c.name as color_name");
        $this->db->join("colors as c", $this->_table_alias . ".color_id = c.id");
    }
    
    public function get_by_prepack_id($prepack_id = 0) {
        if ($prepack_id == 0) return NULL;
        if ($prepack_id) $this->_database->where($this->_table_alias . '.prepack_id', $prepack_id);
        return $this->get_all();
    }
}