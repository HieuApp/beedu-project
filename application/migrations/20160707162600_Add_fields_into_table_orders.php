<?php

/**
 * Created by IntelliJ IDEA.
 * User: phong
 * Date: 07-Jul-16
 * Time: 4:27 PM
 */
class Migration_Add_fields_into_table_orders extends CI_Migration {
    public function up() {
        $this->_modify_columns_of_orders();
        $this->_add_columns_of_orders();
    }

    private function _modify_columns_of_orders() {
        $fields = array(
            'date_expried' => array(
                'name' => 'date_expired',
                'type' => 'timestamp',
            ),
            'date_order'   => array(
                'type' => 'timestamp',
            ),
            'date_begin'   => array(
                'type' => 'timestamp',
            ),
        );
        $this->dbforge->modify_column('orders', $fields);
    }

    private function _add_columns_of_orders() {
        $fields = array(
            'branch_name' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'customer',
            ),
            'date_export' => array(
                'type'  => 'timestamp',
                'after' => 'branch_name',
            ),
            'note'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'after'      => 'date_expired',
            ),
        );
        $this->dbforge->add_column('orders', $fields);
    }

    public function down() {
        $this->dbforge->drop_table('orders', FALSE);
    }
}