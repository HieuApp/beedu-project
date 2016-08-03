<?php
/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 03-Aug-16
 * Time: 10:30 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback_manage extends Manager_base {
    public function __construct() {
        parent::__construct();
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "admin/feedback_manage",
            "view"   => "feedback_manage",
            "model"  => "m_feedback_manage",
            "object" => "phản hồi",
        );
    }
}