<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 05-Jul-16
 * Time: 9:41 AM
 */
class Migration_Edit_color_table extends CI_Migration {
    public function up() {
        $this->_modify_color_table();
    }

    public function _modify_color_table() {
        $fields = array(
            'color_code' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'description',
            ),
        );
        $this->dbforge->add_column('colors', $fields);
    }

    public function down() {
        $fields = array(
            'color_code' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'description',
            ),
        );
        $this->dbforge->drop_column('colors', $fields);
    }
}