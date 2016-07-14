<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 07-Jul-16
 * Time: 5:12 PM
 */
class Migration_add_fields_into_warehouse_activities_table extends CI_Migration {
    public function up() {
        $this->_add_column_into_warehouse_activities();
    }

    public function down() {
        $this->_drop_column_into_warehouse_activities();
    }

    private function _add_column_into_warehouse_activities() {
        $field = array(
            'user_id'       => array(
                'type'       => 'INT',
                'constraint' => 11,
                'after'      => 'type',
            ),
            'time_receive'  => array(
                'type'  => 'timestamp',
                'after' => 'type',
            ),
            'material_pack' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'type',
            ),
        );
        $this->dbforge->add_column('warehouse_activities', $field);
    }

    private function _drop_column_into_warehouse_activities() {
        $field = array(
            'user_id'       => array(
                'type'       => 'INT',
                'constraint' => 11,
                'after'      => 'type',
            ),
            'time_receive'  => array(
                'type'  => 'timestamp',
                'after' => 'type',
            ),
            'material_pack' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'type',
            ),
        );
        $this->dbforge->drop_column('warehouse_activities', $field);
    }
}
