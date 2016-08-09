<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 19-Jul-16
 * Time: 11:03 PM
 */
class Migration_Add_class_and_notify_table extends CI_Migration {

    public function up() {
        $this->_add_class_table();
        $this->_add_notify_table();
    }

    private function _add_class_table() {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'name'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'description' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'detail'      => array(
                'type'       => 'VARCHAR',
                'constraint' => 2550,
            ),
            'price'       => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('classes', TRUE, ['ENGINE' => 'InnoDB']);
    }

    public function _add_notify_table() {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'link_to_warning' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'content'         => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'status'          => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('notifications', TRUE, ['ENGINE' => 'InnoDB']);
    }

    public function down() {
        $this->dbforge->drop_table('classes', FALSE);
        $this->dbforge->drop_table('notifications', FALSE);
    }
}