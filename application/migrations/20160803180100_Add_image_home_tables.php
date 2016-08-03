<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 03-Aug-16
 * Time: 6:01 PM
 */
class Migration_Add_image_home_tables extends CI_Migration {

    public function up() {
        $this->_add_image_homes_table();
    }

    private function _add_image_homes_table() {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'title'       => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'description' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'file'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'note'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('image_homes', TRUE, ['ENGINE' => 'InnoDB']);
    }

    public function down() {
        $this->dbforge->drop_table('image_homes', FALSE);
    }
}