<?php

/**
 * Created by IntelliJ IDEA.
 * User: phong
 * Date: 08-Jul-16
 * Time: 9:15 AM
 */
class Migration_Modify_columns_in_orders_table extends CI_Migration {
    public function up() {
        $this->_modify_columns_of_orders();
    }

    public function down() {
        $this->_revert_modify_columns_of_orders();
    }

    private function _modify_columns_of_orders() {
        $fields = array(
            'branch_name' => array(
                'name'       => 'brand_name',
                'type'       => 'varchar',
                'constraint' => 50,
            ),
            'name'        => array(
                'type'       => 'varchar',
                'constraint' => 15,
            ),
            'customer'    => array(
                'type'       => 'varchar',
                'constraint' => 40,
            ),
        );
        $this->dbforge->modify_column('orders', $fields);
    }

    private function _revert_modify_columns_of_orders() {
        $fields = array(
            'brand_name' => array(
                'name'       => 'branch_name',
                'type'       => 'varchar',
                'constraint' => 255,
            ),
            'name'       => array(
                'type'       => 'varchar',
                'constraint' => 255,
            ),
            'customer'   => array(
                'type'       => 'varchar',
                'constraint' => 255,
            ),
        );
        $this->dbforge->modify_column('orders', $fields);
    }
}
