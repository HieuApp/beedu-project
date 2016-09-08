<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 19-Jul-16
 * Time: 11:32 PM
 */
class M_documents extends Crud_manager {
    protected $_table = 'documents';
    protected $soft_delete = FALSE;
    public $schema = [
        'name'             => [
            'field'    => 'name',
            'db_field' => 'name',
            'label'    => 'Tên tài liệu',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="name"',
            ],
            'filter'   => [
                'search_type' => 'like',
                'attr'        => 'data-test="filter"',
            ],
            'table'    => [
                'label' => 'Tên tài liệu',
            ],
        ],
        'category_id'      => [
            'field'    => 'category_id',
            'db_field' => 'ct.id',
            'label'    => 'Thư mục',
            'rules'    => 'required',
            'form'     => [
                'type'            => 'select',
                'target_model'    => 'M_categories',
                'target_function' => 'dropdown',
                'target_arg'      => ['id', 'name'],
            ],
            'filter'   => [
                'type' => 'multiple_select',
            ],
        ],
        'category_name'    => [
            'field'    => 'category_name',
            'db_field' => 'ct.name',
            'label'    => 'Thư mục',
            'rules'    => 'required',
            'table'    => TRUE,
        ],
        'avatar'           => [
            'field'    => 'avatar',
            'db_field' => 'avatar',
            'label'    => 'Avatar',
            'rules'    => 'required',
            'form'     => [
                'type'                     => 'file', //multiple_file
                'class'                    => 'ace_file_input',//Use ACE theme for file input
//                'attr'         => 'data-disable_client_validate=1',//Disable validate in client
                'upload'                   => [//As config of File Upload Class in codeingiter
                    'upload_path'      => 'upload/image',
                    'allowed_types'    => 'jpg|jpeg|png',
                    'max_size'         => '20480',
                    'min_size'         => '1',
                    'min_width'        => 30,
                    'min_height'       => 40,
                    'max_width'        => 12000,
                    'max_height'       => 16000,
                    'encrypt_name'     => TRUE,
                    'file_ext_tolower' => TRUE,
                ],
                'callback_before_validate' => '',
                'callback_after_validate'  => '',
                'resize'                   => [ //As config of Image Manipulation Class(resize) in CodeIgniter (without source_image)
                    'height' => 104,
                    'width'  => 104,
                ],
                'watermarking'             => [ //As config of Image Manipulation Class(watermarking) in CodeIgniter (without source_image)
                    'wm_text'          => 'Copyright 2016 - TrongPD',
                    'wm_type'          => 'text',
                    'wm_font_size'     => '16',
                    'wm_font_color'    => 'ffffff',
                    'wm_vrt_alignment' => 'bottom',
                    'wm_hor_alignment' => 'right',
                    'wm_padding'       => '20',
                ],
            ],
            'table'    => [
                'callback_render_data' => "preview_img",
            ],
        ],
        'description'      => [
            'field'    => 'description',
            'db_field' => 'description',
            'label'    => 'Mô tả',
            'rules'    => '',
            'table'    => [
                'label' => 'Mô tả',
            ],
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="description"',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
        ],
        'file'             => [
            'field'    => 'file',
            'db_field' => 'file',
            'label'    => 'File',
            'rules'    => 'required',
            'form'     => [
                'type'                     => 'file', //multiple_file
                'class'                    => 'ace_file_input',//Use ACE theme for file input
//                'attr'         => 'data-disable_client_validate=1',//Disable validate in client
                'upload'                   => [//As config of File Upload Class in codeingiter
                    'upload_path'      => 'upload/file',
                    'allowed_types'    => 'pdf|txt|doc|docx',
                    'max_size'         => '2048000',
//                    'min_size'         => '100',
//                    'min_width'        => 300,
//                    'min_height'       => 400,
//                    'max_width'        => 1200,
//                    'max_height'       => 1600,
                    'encrypt_name'     => TRUE,
                    'file_ext_tolower' => TRUE,
                ],
                'callback_before_validate' => '',
                'callback_after_validate'  => '',
                'resize'                   => [ //As config of Image Manipulation Class(resize) in CodeIgniter (without source_image)
                    'height' => 104,
                    'width'  => 104,
                ],
                'watermarking'             => [ //As config of Image Manipulation Class(watermarking) in CodeIgniter (without source_image)
                    'wm_text'          => 'Copyright 2016 - MinhNV',
                    'wm_type'          => 'text',
                    'wm_font_size'     => '16',
                    'wm_font_color'    => 'ffffff',
                    'wm_vrt_alignment' => 'bottom',
                    'wm_hor_alignment' => 'right',
                    'wm_padding'       => '20',
                ],
            ],
//            'table'    => TRUE,
        ],
        'author'           => [
            'field'    => 'author',
            'db_field' => 'author',
            'label'    => 'Tác giả',
            'rules'    => '',
            'table'    => [
                'label' => 'Tác giả',
            ],
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="author"',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
        ],
        'count_downloaded' => [
            'field'    => 'count_downloaded',
            'db_field' => 'count_downloaded',
            'label'    => 'Số lượt tải',
            'rules'    => '',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="description"',
            ],
        ],
        'note'             => [
            'field'    => 'note',
            'db_field' => 'note',
            'label'    => 'Ghi chú',
            'rules'    => '',
            'form'     => [
                'type' => 'text',
            ],
            'filter'   => [
                'search_type' => 'like',
                'type'        => 'text',
            ],
            'table'    => TRUE,
        ],
        'created_on'       => [
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
        $this->before_get[] = "join_categories_table";
    }

    public function join_categories_table() {
        $this->db->select($this->_table_alias . ".*, ct.name as category_name, ct.id as category_id");
        $this->db->join("categories as ct", $this->_table_alias . ".category_id=ct.id");
    }

    public function preview_img($origin_column_value, $column_name, &$record, $column_data, $caller) {
        $src = base_url($record->avatar);
        return "<div>
                  <img src='$src' width='150' height='100'>
                </div>";
    }
}