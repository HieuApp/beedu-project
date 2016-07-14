<?php
/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 05-Jul-16
 * Time: 10:16 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Material
 */
class Material extends Manager_base {
    public function __construct() {
        parent::__construct();
        $this->is_in_group(['admin', 'corporation', 'ppc', 'warehouse_manager'], TRUE);
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "material",
            "view"   => "material",
            "model"  => "m_materials",
            "object" => "nguyên liệu",
        );
    }
}