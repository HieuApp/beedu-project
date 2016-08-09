<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 03-Aug-16
 * Time: 10:09 PM
 */
class Migration_Add_avatar_column extends CI_Migration {
    public function up() {
        $this->_add_avatar_to_document();
        $this->_add_avatar_to_class();
    }

    public function down() {
        $this->dbforge->drop_table('classes', FALSE);
        $this->dbforge->drop_table('documents', FALSE);
    }

    private function _add_avatar_to_document() {
        $fields = array(
            'avatar' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'category_id',
            ),
        );
        $this->dbforge->add_column('documents', $fields);
    }

    private function _add_avatar_to_class() {
        $fields = array(
            'avatar' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'description',
            ),
        );
        $this->dbforge->add_column('classes', $fields);
    }
}