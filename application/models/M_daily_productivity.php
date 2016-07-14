<?php

/**
 * Created by IntelliJ IDEA.
 * User: phong
 * Date: 29-Jun-16
 * Time: 3:04 PM
 */
class M_daily_productivity extends Crud_manager {
    protected $_table = 'daily_productivities';
    protected $soft_delete = FALSE;
    public $schema = [
        'date'          => [
            'field' => 'date',
            'label' => 'Ngày',
            'rules' => '',
            'table' => [
                'label' => 'Ngày',
            ],
            'form'  => [
                'type'                 => 'date',
                'class'                => 'date-picker',
                'callback_render_html' => 'render_date_input',
            ],

        ],
        'order_id'      => [
            'field' => 'order_id',
            'label' => 'Order id',
            'rules' => 'required',
            'form'  => [
                'type'            => 'select',
                'target_model'    => 'M_order',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
        ],
        'order_name'    => [
            'field'    => 'order_name',
            'db_field' => 'o.name',
            'label'    => 'Order Name',
            'rules'    => '',
            'table'    => TRUE,
        ],
        'customer'      => [
            'field'    => 'customer',
            'db_field' => 'o.customer',
            'label'    => 'Order customer',
            'rules'    => '',
            'table'    => TRUE,
        ],
        'line_id'       => [
            'field'  => 'line_id',
            'label'  => 'Line id',
            'rules'  => 'required',
            'form'   => [
                'type'            => 'select',
                'target_model'    => 'M_line',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
            'filter' => [
                'label' => 'Line name',
                'type'  => 'multiple_select',
            ],
        ],
        'line_name'     => [
            'field'    => 'line_name',
            'label'    => 'Line name',
            'db_field' => 'l.name',
            'rules'    => '',
            'table'    => [],
        ],
        'step_id'       => [
            'field' => 'step_id',
            'label' => 'Step',
            'rules' => 'required',
            'table' => [
                'label'                => 'Step',
                'callback_render_data' => "get_step_text",
            ],
            'form'  => [
                'type'            => 'select',
                'target_model'    => 'M_order',
                'target_function' => 'get_step',
            ],
        ],
        'quantity'      => [
            'field' => 'quantity',
            'label' => 'quantity',
            'rules' => 'greater_than[0]',
            'form'  => [
                'type' => 'number',
            ],
            'table' => TRUE,
        ],
        'quality_state' => [
            'field' => 'quality_state',
            'label' => 'quality state',
            'rules' => '',
            'table' => TRUE,
            'form'  => [
                'type' => 'number',
            ],
        ],
        'quality_note'  => [
            'field' => 'quality_note',
            'label' => 'quality_note',
            'rules' => '',
            'table' => TRUE,
            'form'  => [
                'type' => 'text',
            ],
        ],
        'created_on'    => [
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
        $this->load->model("m_order", "order");
        $is_producer = $this->is_in_group('producer');
        $is_quality = $this->is_in_group('quality_manager');
        $is_company_or_ppc = $this->is_in_group('corporation') || $this->is_in_group('ppc');
        if ($is_producer) {
            unset($this->schema["quality_state"]["form"]);
            unset($this->schema["quality_note"]["form"]);
        } else if ($is_quality) {
            unset($this->schema["quantity"]["form"]);
        } else if ($is_company_or_ppc) {

        }
        parent::__construct();
        $this->before_get['join_all'] = "join_line_table";
    }

    public function join_line_table() {
        $this->db->select($this->_table_alias . ".*, 
        l.name as line_name, 
        o.name as order_name,
        o.customer
        ");
        $this->db->join("lines as l", $this->_table_alias . ".line_id=l.id");
        $this->db->join("orders as o", $this->_table_alias . ".order_id=o.id");
    }

    /**
     * @param      $data
     * @param bool $skip_validation
     * @return bool
     */
    public function insert($data, $skip_validation = FALSE) {
        ;
        if ($skip_validation === FALSE) {
            $data = $this->validate($data);
        }
        if ($data !== FALSE) {
            $isset = $this->get_list_filter(Array(
                'order_id' => $data['order_id'],
                'line_id'  => $data['line_id'],
                'step_id'  => $data['step_id'],
                'date'     => $data['date'],
            ), Array(), Array());
            if ($isset) {
                $is_producer = $this->is_in_group('producer');
                $is_quality = $this->is_in_group('quality_manager');
                $is_company_or_ppc = $this->is_in_group('company') || $this->is_in_group('ppc');
                if ($is_producer) {
                    $data_update = [
                        'quantity' => $data['quantity'],
                    ];
                } elseif ($is_quality) {
                    $data_update = [
                        'quality_state' => $data['quality_state'],
                        'quality_note'  => $data['quality_note'],
                    ];
                } elseif ($is_company_or_ppc) {
                    $data_update = [
                        'quantity'      => $data['quantity'],
                        'quality_state' => $data['quality_state'],
                        'quality_note'  => $data['quality_note'],
                    ];
                } else {
                    $data_update = [
                        'quantity'      => $data['quantity'],
                        'quality_state' => $data['quality_state'],
                        'quality_note'  => $data['quality_note'],
                    ];
                }

                return $this->update($da_co[0]->id, $data_update, TRUE);
            } else {
                return parent::insert($data, $skip_validation = FALSE);
            }
        } else {
            return FALSE;
        }
    }

    public function get_step_text($id) {
        $status = $this->order->get_step();
        if (isset($status[$id])) {
            return $status[$id];
        } else {
            return $id;
        }
    }
}