<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 06-Jul-16
 * Time: 10:18 AM
 */
class M_warehouse_activity_manage extends Crud_manager {
    protected $_table = 'warehouse_activity_items';
    protected $soft_delete = FALSE;
    public $schema = [
        'order_id'                  => [
            'field'    => 'order_id',
            'db_field' => 'mb.order_id',
            'label'    => 'Order id',
            'rules'    => 'required',
            'filter'   => [
                'label'           => 'MO',
                'type'            => 'multiple_select',
                'target_model'    => 'M_order',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
        ],
        'order_name'                => [
            'field'    => 'order_name',
            'db_field' => 'o.name',
            'label'    => 'Order Name',
            'rules'    => '',
            'table'    => [
                'class' => 'col-xs-1',
            ],
        ],
        'material_balance_id'       => [
            'field'    => 'material_balance_id',
            'db_field' => 'material_balance_id',
            'label'    => 'Mã item cân đối',
        ],
        'material_id'               => [
            'field'    => 'material_id',
            'db_field' => 'mb.material_id',
            'label'    => 'Mã nguyên liệu',
            'filter'   => [
                'label'           => 'Tên nguyên liệu',
                'type'            => 'multiple_select',
                'target_model'    => 'M_materials',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
        ],
        'material_name'             => [
            'field'    => 'material_name',
            'db_field' => 'mt.name',
            'label'    => 'Tên nguyên liệu',
            'rules'    => '',
            'table'    => [
                'label' => 'Tên nguyên liệu',
            ],
        ],
        'material_unit'             => [
            'field'    => 'material_unit',
            'db_field' => 'mt.unit',
            'label'    => 'Đơn vị',
            'table'    => [
                'label'                => 'Đơn vị',
                'callback_render_data' => "get_unit_text",
            ],
        ],
        'color_id'                  => [
            'field'    => 'color_id',
            'db_field' => 'mb.color_id',
            'label'    => 'Màu',
            'filter'   => [
                'type'            => 'multiple_select',
                'target_model'    => 'M_color',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
        ],
        'color_name'                => [
            'field'    => 'color_name',
            'db_field' => 'c.name',
            'label'    => 'Màu',
            'table'    => [
                'label' => 'Màu',
            ],
        ],
        'size_id'                   => [
            'field'    => 'size_id',
            'db_field' => 'mb.size_id',
            'label'    => 'Cỡ',
            'filter'   => [
                'type'            => 'multiple_select',
                'target_model'    => 'M_size',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
        ],
        'size_name'                 => [
            'field'    => 'size_name',
            'db_field' => 's.name',
            'label'    => 'Cỡ',
            'table'    => [
                'label' => 'Cỡ',
            ],
        ],
        'material_balance_quantity' => [
            'field'    => 'material_balance_quantity',
            'db_field' => 'mb.quantity',
            'label'    => 'Cần',
            'rules'    => 'greater_than[0]',
            'table'    => TRUE,
        ],
        'quantity_issued'           => [
            'field'    => 'quantity_issued',
            'db_field' => 'mb.quantity_issued',
            'label'    => 'Số lượng cấp',
            'rules'    => 'greater_than[0]',
            'table'    => FALSE,
        ],
        'quantity_factual'          => [
            'field'    => 'quantity_factual',
            'db_field' => 'mb.quantity_factual',
            'label'    => 'Thực nhập',
            'rules'    => 'greater_than[0]',
            'table'    => TRUE,
        ],
        'activity_id'               => [
            'field'    => 'activity_id',
            'db_field' => 'activity_id',
            'label'    => 'Mã hoạt động',
        ],
        'activity_date'             => [
            'field'    => 'activity_date',
            'db_field' => 'ac.date',
            'label'    => 'Ngày nhập/xuất kho',
            'table'    => TRUE,
        ],
        'quantity'                  => [
            'field'    => 'quantity',
            'db_field' => 'quantity',
            'label'    => 'Số lượng',
            'rules'    => 'greater_than[0]',
            'table'    => TRUE,
        ],
        'balance'                   => [
            'field' => 'balance',
            'label' => 'Tồn kho',
            'rules' => '',
            'table' => [
                'callback_render_data' => "get_balance",
            ],
        ],
        'activity_type'             => [
            'field'    => 'activity_type',
            'db_field' => 'ac.type',
            'label'    => 'Loại',
            'table'    => [
                'label'                => 'Loại',
                'callback_render_data' => "get_type_text",
            ],
            'filter'   => [
                'type'            => 'multiple_select',
                'target_model'    => 'this',
                'target_function' => 'get_type',
            ],
        ],
        'note'                      => [
            'field' => 'note',
            'label' => 'Ghi chú',
            'rules' => '',
            'table' => TRUE,
        ],
        'created_on'                => [
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
        $this->before_get['join_all'] = "join_material_state_table";
    }

//    public function set_view($action){
//        $action = "qlxn";
//        if ($action == "add_wh_ei") {
//            unset($this->schema[""]);
//        } else {
//            unset($this->schema[""]);
//        }
//    }

    public function join_material_state_table() {
        $this->db->select($this->_table_alias . ".*, 
         o.name as order_name,
         s.name as size_name,
         c.name as color_name,
         ac.type as activity_type,
         ac.date as activity_date,
         mt.name as material_name,
         mt.unit as material_unit,
         mb.order_id as order_id,
         mb.color_id as color_id,
         mb.size_id as size_id,
         mb.material_id as material_id,
         mb.quantity as material_balance_quantity,
         mb.quantity_issued as quantity_issued,
         mb.quantity_factual as quantity_factual,
         mb.quantity_factual as balance,
        ");
        $this->db->join("material_balances as mb", $this->_table_alias . ".material_balance_id=mb.id");
        $this->db->join("warehouse_activities as ac", $this->_table_alias . ".activity_id=ac.id");
        $this->db->join("orders as o", "mb.order_id=o.id");
        $this->db->join("sizes as s", "mb.size_id=s.id");
        $this->db->join("colors as c", "mb.color_id=c.id");
        $this->db->join("materials as mt", "mb.material_id=mt.id");
    }

    public function get_unit() {
        return [
            '1' => 'Yds',
            '0' => 'Pcs',
        ];
    }

    public function get_unit_text($id) {
        $unit = $this->get_unit();
        if (isset($unit[$id])) {
            return $unit[$id];
        } else {
            return $id;
        }
    }

    public function get_type() {
        return [
            '1'  => 'Nhập kho',
            '-1' => 'Xuất kho',
            '0'  => 'Kế hoạch về kho',
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

    public function get_balance($origin_column_value, $column_name, &$record, $column_data, $caller) {
        $factual = $record->quantity_factual;
        $quantity = $record->quantity;
        $result = $factual - $quantity;
        return $result;
    }

    public function insert($data, $skip_validation = FALSE) {
        if ($skip_validation === FALSE) {
            $data = $this->validate($data);
        }
        if ($data !== FALSE) {
            $data = $this->trigger('before_create', $data);
            $insert_id = $this->ion_auth->register($data['quantity'], $data['note'], $data['material_balance_id'], [$data['activity_id']], [$data['material_id']], [$data['order_id']]);
            $this->trigger('after_create', $insert_id);
            return $insert_id;
        } else {
            return FALSE;
        }
    }
}
