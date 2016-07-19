<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 19-Jul-16
 * Time: 11:03 PM
 */
class Migration_Add_some_table extends CI_Migration {

    public function up() {
        $this->_add_system_configs();
        $this->_add_category_table();
        $this->_add_document_table();
    }

    private function _add_system_configs() {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'name'  => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'value' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('system_configs', TRUE, ['ENGINE' => 'InnoDB']);
    }

    private function _add_category_table() {
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
            'note'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('categories', TRUE, ['ENGINE' => 'InnoDB']);
    }

    private function _add_document_table() {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'name'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'category_id' => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
            'file'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'author'      => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'note'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('documents', TRUE, ['ENGINE' => 'InnoDB']);
    }

    public function down() {
        $this->dbforge->drop_table('system_configs', FALSE);
        $this->dbforge->drop_table('categories', FALSE);
        $this->dbforge->drop_table('documents', FALSE);
    }
}