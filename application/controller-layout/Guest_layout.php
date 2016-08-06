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
 * @property M_system_config m_system_config
 */
abstract class Guest_layout extends Base_guest_layout {

    protected $role_allow = 'guest';

    function __construct() {
        parent::__construct();
        $this->load->model('M_system_config', 'm_system_config');
        $this->_set_top_bar();
    }

    private function _set_top_bar() {
        $data = Array(
            'view_file' => "guest/base_layout/top_bar",
        );
        $result = $this->m_system_config->get_all();
        $data["menu_1"] = $result[1]->value;
        $data["menu_2"] = $result[2]->value;
        $data["menu_3"] = $result[3]->value;
        $data["menu_4"] = $result[4]->value;
        $data["menu_5"] = $result[5]->value;
        $data["beedu_info"] = $result[15]->value;
        $data["address_contact"] = $result[16]->value;
        $data["phone_contact"] = $result[17]->value;
        $data["email_contact"] = $result[18]->value;
        $this->set_data_part('top_bar', $data, TRUE);
    }
}
