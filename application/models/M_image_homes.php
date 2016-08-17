<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 19-Jul-16
 * Time: 11:32 PM
 */
class M_image_homes extends Crud_manager {
    protected $_table = 'image_homes';
    protected $soft_delete = FALSE;
    public $schema = [
        'title'       => [
            'field'    => 'title',
            'db_field' => 'title',
            'label'    => 'Tên ảnh',
            'rules'    => 'required',
            'form'     => [
                'type' => 'text',
                'attr' => 'data-test="title"',
            ],
            'filter'   => [
                'search_type' => 'like',
                'attr'        => 'data-test="filter"',
            ],
            'table'    => [
                'label' => 'Tên ảnh',
            ],
        ],
        'description' => [
            'field'    => 'description',
            'db_field' => 'description',
            'label'    => 'Mô tả',
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
        'file'        => [
            'field'    => 'file',
            'db_field' => 'file',
            'label'    => 'File',
            'rules'    => 'required',
            'form'     => [
                'type'                     => 'file', //multiple_file
                'class'                    => 'ace_file_input',//Use ACE theme for file input
//                'attr'         => 'data-disable_client_validate=1',//Disable validate in client
                'upload'                   => [//As config of File Upload Class in codeingiter
                    'upload_path'      => 'upload/image',
                    'allowed_types'    => 'jpg|jpeg|png',
                    'max_size'         => '20480',
                    'min_size'         => '10',
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
        'note'        => [
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
        'created_on'  => [
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
    }

    public function preview_img($origin_column_value, $column_name, &$record, $column_data, $caller) {
        $src = base_url($record->file);
        return "<div>
                  <img src='$src' width='150' height='100'>
                </div>";
    }

}