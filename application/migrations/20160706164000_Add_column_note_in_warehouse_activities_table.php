<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 06-Jul-16
 * Time: 4:40 PM
 */
class Migration_add_column_note_in_warehouse_activities_table extends CI_Migration {
    public function up() {
        $this->_add_column_note_in_warehouse_activities();
    }

    public function down() {
        $this->_remove_column_note_in_warehouse_activities();
    }

    private function _add_column_note_in_warehouse_activities() {
        $field_note = array(
            'note' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'warehouse_id',
            ),
        );
        $this->dbforge->add_column('warehouse_activities', $field_note);
    }

    private function _remove_column_note_in_warehouse_activities() {
        $field_note = array(
            'note' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'warehouse_id',
            ),
        );
        $this->dbforge->drop_column('warehouse_activities', $field_note);
    }

}
