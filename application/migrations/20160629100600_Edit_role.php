<?php

/**
 * Created by PhpStorm.
 * User: ha
 * Date: 06/29/2016
 * Time: 10:06 AM
 *
 * @property CI_DB_query_builder $db
 */
class Migration_Edit_role extends CI_Migration {

    public function up() {
        $table_name = "ion_groups";
        $data = array(
            'name'        => 'corporation',
            'description' => 'Công ty',
        );
        $this->db->update($table_name, $data, "name='develop'");
        $this->db->insert_batch($table_name, Array(
            Array(
                'name'        => 'ppc',
                'description' => 'PPC',
            ),
            Array(
                'name'        => 'warehouse_manager',
                'description' => 'Quản lý kho',
            ),
            Array(
                'name'        => 'quality_manager',
                'description' => 'Quản lý chất lượng',
            ),
            Array(
                'name'        => 'producer',
                'description' => 'Sản xuất',
            ),
        ));
    }

    public function down() {
        $data = Array(
            'name'        => 'develop',
            'description' => 'Develop',
        );
        $this->db->update("ion_groups", $data, "name='corporation'");
        $this->db->delete("ion_groups", "name='ppc'");
        $this->db->delete("ion_groups", "name='warehouse_manager'");
        $this->db->delete("ion_groups", "name='quality_manager'");
        $this->db->delete("ion_groups", "name='producer'");
    }
}