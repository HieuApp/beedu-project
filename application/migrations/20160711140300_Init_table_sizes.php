<?php

/**
 * Created by IntelliJ IDEA.
 * User: phong
 * Date: 11-Jul-16
 * Time: 2:05 PM
 */
class Migration_Init_table_sizes extends CI_Migration {
    public function up() {
        $table_name = "sizes";
        $this->db->insert_batch($table_name, Array(
            Array(
                'id'          => 1,
                'name'        => 'xs',
                'description' => 'XS',
            ),
            Array(
                'id'          => 2,
                'name'        => 's',
                'description' => 'S',
            ),
            Array(
                'id'          => 3,
                'name'        => 'm',
                'description' => 'M',
            ),
            Array(
                'id'          => 4,
                'name'        => 'l',
                'description' => 'L',
            ),
            Array(
                'id'          => 5,
                'name'        => 'xl',
                'description' => 'XL',
            ),
            Array(
                'id'          => 6,
                'name'        => 'xxl',
                'description' => 'XXL',
            ),
        ));
    }

    public function down() {
        $this->db->delete("sizes", "name='xs'");
        $this->db->delete("sizes", "name='s'");
        $this->db->delete("sizes", "name='m'");
        $this->db->delete("sizes", "name='l'");
        $this->db->delete("sizes", "name='xl'");
        $this->db->delete("sizes", "name='xxl'");
    }
}