<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 8/25/2016
 * Time: 9:26 PM
 */
class Migration_Add_learning_method_table extends CI_Migration {
    public function up() {
        $this->_add_learning_method_table();
    }

    public function down() {
        $this->dbforge->drop_table('learning_method', FALSE);
    }

    private function _add_learning_method_table() {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'avatar'      => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'title'       => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'description' => array(
                'type'       => 'VARCHAR',
                'constraint' => 2550,
            ),
            'note'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('learning_method', TRUE, ['ENGINE' => 'InnoDB']);
    }
}