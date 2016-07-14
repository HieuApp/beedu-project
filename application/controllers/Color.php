<?php
/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 05-Jul-16
 * Time: 9:53 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Color
 */
class Color extends Manager_base {
    public function __construct() {
        parent::__construct();
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "color",
            "view"   => "color",
            "model"  => "m_color",
            "object" => "bảng màu",
        );
    }
}