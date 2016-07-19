<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 19-Jul-16
 * Time: 11:03 PM
 */
class Migration_Add_questions_table extends CI_Migration {

    public function up() {
        $this->_add_question_table();
    }

    private function _add_question_table() {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'question' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'answer'   => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('questions', TRUE, ['ENGINE' => 'InnoDB']);
    }

    public function down() {
        $this->dbforge->drop_table('questions', FALSE);
    }
}