<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 06-Jul-16
 * Time: 4:15 PM
 */
class Migration_add_column_in_material_table extends CI_Migration {
    public function up() {
        $this->_add_column_description();
    }

    public function down() {
        $this->_remove_column_description();
    }

    private function _add_column_description() {
        $fields = array(
            'description' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'unit',
            ),
        );
        $this->dbforge->add_column('materials', $fields);
        $field_type = array(
            'type' => array(
                'type'       => 'INT',
                'constraint' => 11,
                'after'      => 'id',
            ),
        );
        $this->dbforge->modify_column('warehouse_activities', $field_type);
    }

    private function _remove_column_description() {
        $fields = array(
            'description' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'unit',
            ),
        );
        $this->dbforge->drop_column('materials', $fields);
        $field_type = array(
            'type' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'id',
            ),
        );
        $this->dbforge->modify_column('warehouse_activities', $field_type);
    }
}