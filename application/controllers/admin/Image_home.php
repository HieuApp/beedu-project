<?php
/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 03-Aug-16
 * Time: 9:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Image_home
 */
class Image_home extends Manager_base {
    public function __construct() {
        parent::__construct();
    }

    public function setting_class() {
        // TODO: Implement setting_class() method.
        $this->name = Array(
            "class"  => "admin/image_home",
            "view"   => "image_home",
            "model"  => "m_image_homes",
            "object" => "hình ảnh",
        );
    }
}