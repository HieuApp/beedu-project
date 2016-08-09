<?php
/**
 * Created by PhpStorm.
 * User: CaoLong
 * Date: 7/5/2016
 * Time: 10:48 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Questions
 */
class Classes extends Manager_base {
    public function __construct() {
        parent::__construct();
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "admin/classes",
            "view"   => "classes",
            "model"  => "m_classes",
            "object" => "lớp học",
        );
    }
}