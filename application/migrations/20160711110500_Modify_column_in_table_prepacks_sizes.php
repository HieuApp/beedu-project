<?php

/**
 * Created by IntelliJ IDEA.
 * User: phong
 * Date: 11-Jul-16
 * Time: 11:06 AM
 */
class Migration_Modify_column_in_table_prepacks_sizes extends CI_Migration {
    public function up() {
        $this->dbforge->modify_column('prepacks_sizes', [
            'quantity' => array(
                'name'       => 'rate',
                'type'       => 'INT',
                'constraint' => 2,
            ),
        ]);
    }

    public function down() {
        $this->dbforge->modify_column('prepacks_sizes', [
            'rate' => array(
                'name'       => 'quantity',
                'type'       => 'INT',
                'constraint' => 11,
            ),
        ]);
    }
}