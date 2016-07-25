<?php
/**
 * Created by IntelliJ IDEA.
 * User: phamtrong
 * Date: 3/17/16
 * Time: 11:16
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class Admin_layout
 */
abstract class Guest_layout extends Base_layout {

    protected $role_allow = 'guest';

    function __construct() {
        parent::__construct();
        $this->_set_top_bar();
    }

    private function _set_top_bar() {
        $data = Array(
            'view_file' => "guest/base_layout/top_bar",
        );
        $this->set_data_part('top_bar', $data, TRUE);
    }
}
