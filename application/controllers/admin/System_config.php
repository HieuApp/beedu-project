<?php
/**
 * Created by PhpStorm.
 * User: CaoLong
 * Date: 7/5/2016
 * Time: 10:48 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class System_config
 */
class System_config extends Manager_base {
    public function __construct() {
        parent::__construct();
        $this->is_in_group(['admin'], TRUE);
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "system_config",
            "view"   => "system_config",
            "model"  => "m_system_config",
            "object" => "bảng system_config",
        );
    }
}