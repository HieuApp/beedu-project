<?php
/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 30-Jun-16
 * Time: 11:45 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Line
 */
class Line extends Manager_base {
    public function __construct() {
        parent::__construct();
        $this->is_in_group(['admin', 'corporation', 'ppc'], TRUE);
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "line",
            "view"   => "line",
            "model"  => "m_line",
            "object" => "tổ sản xuất",
        );
    }
}