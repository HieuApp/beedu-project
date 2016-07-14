<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 14-Jul-16
 * Time: 2:37 PM
 */
class Migration_edit_column_in_warehouse_activities_table extends CI_Migration {
    public function up() {
        $this->_add_column_into_warehouse_activities();
        $this->_add_field_status();
    }

    public function down() {
        $this->_drop_column_into_warehouse_activities();
    }

    private function _add_column_into_warehouse_activities() {
        $field = array(
            'time_receive' => array(
                'type'  => 'date',
                'after' => 'material_pack',
            ),
        );

        $this->dbforge->modify_column('warehouse_activities', $field);

    }

    private function _add_field_status() {
        $field_status = array(
            'status' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'note',
            ),
        );
        $this->dbforge->add_column('warehouse_activities', $field_status);
    }

    private function _drop_column_into_warehouse_activities() {
        $this->dbforge->drop_table('warehouse_activities', FALSE);
    }
}