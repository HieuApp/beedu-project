<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 8/17/2016
 * Time: 10:04 PM
 */
class Migration_Add_column_into_system_config extends CI_Migration {
    public function up() {
        $this->_add_column_into_system_config();
    }

    public function down() {
        $this->dbforge->drop_column('system_configs', 'module');
    }

    private function _add_column_into_system_config() {
        $fields = array(
            'module' => array(
                'type'       => 'INT',
                'constraint' => 11,
                'after'      => 'value',
            ),
        );
        $this->dbforge->add_column('system_configs', $fields);
    }
}