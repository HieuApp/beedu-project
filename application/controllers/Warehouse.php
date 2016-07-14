<?php
/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 08-Jul-16
 * Time: 10:34 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Material
 */
class Warehouse extends Manager_base {
    public function __construct() {
        parent::__construct();
        $this->is_in_group(['admin', 'corporation', 'ppc', 'warehouse_manager'], TRUE);
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "warehouse",
            "view"   => "warehouse",
            "model"  => "m_warehouses",
            "object" => "kho",
        );
    }
}