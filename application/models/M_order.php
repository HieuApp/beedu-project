<?php

/**
 * Created by IntelliJ IDEA.
 * User: phong
 * Date: 29-Jun-16
 * Time: 1:51 PM
 */
class M_order extends Crud_manager {
    protected $_table = 'orders';
    protected $soft_delete = FALSE;
    public $schema = [
        'name'         => [
            'field'    => 'name',
            'db_field' => 'name',
            'label'    => 'Tên order',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="name"',
            ],
            'filter'   => [
                'type'            => 'multiple_select',
                'target_model'    => 'this',
                'target_function' => 'dropdown',
                'target_arg'      => ['name', 'name'],
            ],
            'table'    => [
                'label' => 'Tên',
            ],
        ],
        'customer'     => [
            'field'    => 'customer',
            'db_field' => 'customer',
            'label'    => 'Customer',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
            ],
            'filter'   => [
                'type'            => 'multiple_select',
                'target_model'    => 'this',
                'target_function' => 'dropdown',
                'target_arg'      => ['customer', 'customer'],
            ],
            'table'    => [
                'label' => 'Customer',
            ],
        ],
        'brand_name'   => [
            'field'    => 'brand_name',
            'db_field' => 'brand_name',
            'label'    => 'Tên thương hiệu',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
            ],
            'table'    => [
                'label' => 'Tên thương hiệu',
            ],
        ],
        'date_export'  => [
            'field'    => 'date_export',
            'db_field' => 'date_export',
            'label'    => 'Ngày xuất xưởng',
            'rules'    => '',
            'form'     => [
                'type' => 'date',
                'attr' => 'data-test="date_export"',
            ],
            'table'    => [
                'class' => "hidden-480",
                'attr'  => 'data-check=\'true\'',
            ],
        ],
        'date_order'   => [
            'field'    => 'date_order',
            'db_field' => 'date_order',
            'label'    => 'Ngày đặt hàng',
            'rules'    => '',
            'form'     => [
                'type' => 'date',
                'attr' => 'data-test="date_order"',
            ],
            'table'    => [
                'class' => "hidden-480",
                'attr'  => 'data-check=\'true\'',
            ],
        ],
        'date_begin'   => [
            'field'    => 'date_begin',
            'db_field' => 'date_begin',
            'label'    => 'Ngày bắt đầu',
            'rules'    => '',
            'form'     => [
                'type' => 'date',
                'attr' => 'data-test="date_begin"',
            ],
            'table'    => [
                'class' => "hidden-480",
                'attr'  => 'data-check=\'true\'',
            ],
        ],
        'date_expired' => [
            'field'    => 'date_expired',
            'db_field' => 'date_expired',
            'label'    => 'Ngày hết hạn',
            'rules'    => '',
            'form'     => [
                'type' => 'date',
                'attr' => 'data-test="date_expired"',
            ],
            'table'    => [
                'class' => "hidden-480",
                'attr'  => 'data-check=\'true\'',
            ],
        ],
        'file_attachs' => [
            'field' => 'file_attachs',
            'label' => 'File đính kèm',
            'rules' => '',
            'form'  => [
                'type' => 'text',
            ],
            'table' => [
                'label' => 'File đính kèm',
            ],
        ],
        'note'         => [
            'field'    => 'note',
            'db_field' => 'note',
            'label'    => 'Ghi chú',
            'rules'    => '',
            'form'     => [
                'type' => 'text',
            ],
            'table'    => TRUE,
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
    ];

    public function get_step() {
        return [
            '1' => 'Cắt',
            '2' => 'May',
            '3' => 'Là',
            '4' => 'Đóng thùng',
        ];
    }

    public function get_order() {
        return [
            '0' => 'Nhập kho',
            '1' => 'Xuất kho',
        ];
    }
}