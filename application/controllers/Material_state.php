<?php
/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 05-Jul-16
 * Time: 3:00 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Material_state
 */
class Material_state extends Manager_base {
    public function __construct() {
        parent::__construct();
        $this->is_in_group(['admin', 'corporation', 'ppc', 'warehouse_manager'], TRUE);
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "material_state",
            "view"   => "material_state",
            "model"  => "m_material_state",
            "object" => "trạng thái NPL",
        );
    }

    /**
     * TODO: custom manager of table to remove add button
     * @param array $data
     */
    public function manager($data = Array()) {
        $data['view_file'] = 'admin/material_state/manager_container';
        return parent::manager($data);
    }

    /**
     * TODO: remove column action and check
     * @return type
     */
    public function get_column_data() {
        $columns = parent::get_column_data();
        unset($columns['custom_check']);
        unset($columns['custom_action']);
        return $columns;
    }
}