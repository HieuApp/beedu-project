<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 19-Jul-16
 * Time: 11:30 PM
 */
class Documents extends Manager_base {
    public function __construct() {
        parent::__construct();
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "admin/documents",
            "view"   => "documents",
            "model"  => "m_documents",
            "object" => "tài liệu",
        );
    }
}