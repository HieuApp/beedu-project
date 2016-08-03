<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 03-Aug-16
 * Time: 10:09 PM
 */
class Migration_Add_some_column extends CI_Migration {
    public function up() {
        $this->_add_column_to_document();
        $this->_add_feedback_table();
    }

    public function down() {
        $this->dbforge->drop_table('feedback_manages', FALSE);
        $this->dbforge->drop_table('documents', FALSE);
    }

    private function _add_column_to_document() {
        $fields = array(
            'description'      => array(
                'type'       => 'VARCHAR',
                'constraint' => 2550,
                'after'      => 'category_id',
            ),
            'count_downloaded' => array(
                'type'       => 'INT',
                'constraint' => 11,
                'after'      => 'author',
            ),
        );
        $this->dbforge->add_column('documents', $fields);
    }

    private function _add_feedback_table() {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'email_reader'     => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'feedback_content' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('feedback_manages', TRUE, ['ENGINE' => 'InnoDB']);
    }
}