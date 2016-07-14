<?php
/**
 * Created by PhpStorm.
 * User: CaoLong
 * Date: 7/5/2016
 * Time: 10:34 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Color
 */
class Size extends Manager_base {
    public function __construct() {
        parent::__construct();
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "size",
            "view"   => "size",
            "model"  => "m_size",
            "object" => "bảng size",
        );
    }
}