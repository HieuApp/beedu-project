<?php
/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 05-Jul-16
 * Time: 11:26 AM
 */
class Migration_add_warehouse_order_schedules_table extends CI_Migration {
    public function up() {
        $this->_create_warehouse_order_schedules_table();
    }

    public function down() {
        $this->dbforge->drop_table('warehouse_order_schedules', FALSE);
    }

    private function _create_warehouse_order_schedules_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `warehouse_order_schedules` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `order_id` INT(11) NOT NULL ,
                  `user_id` INT(11) NOT NULL ,
                  `time_receive` DATE NOT NULL,
                  `note` TEXT ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }
}