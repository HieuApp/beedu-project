<?php
/**
 * Created by PhpStorm.
 * User: ha
 * Date: 07/07/2016
 * Time: 9:12 AM
 */
class Migration_Delete_quantity_material_table extends CI_Migration {
    public function up() {
        $this->_delete_quantity_table();
        $this->_rename_warehouse_order_schedules_table();
    }

    public function _delete_quantity_table() {
         $sql = 'ALTER TABLE `materials` DROP COLUMN `quantity`;';
        $this->db->query($sql);
    }
    public function _rename_warehouse_order_schedules_table() {
        $sql = 'RENAME TABLE `warehouse_order_schedules` TO `warehouse_order_plans`;';
        $this->db->query($sql);
    }
    public function down() {
        $this->dbforge->drop_table('materials', FALSE);
    }
}