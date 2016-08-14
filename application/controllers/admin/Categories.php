<?php
/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 19-Jul-16
 * Time: 11:27 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Categories
 */
class Categories extends Manager_base {
    public function __construct() {
        parent::__construct();
        $this->is_in_group(['admin'], TRUE);
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "admin/categories",
            "view"   => "categories",
            "model"  => "m_categories",
            "object" => "chuyên mục",
        );
    }
}