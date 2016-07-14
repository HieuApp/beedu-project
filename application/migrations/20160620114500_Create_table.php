<?php

/**
 * Created by PhpStorm.
 * User: a
 * Date: 4/11/16
 * Time: 10:16
 */
class Migration_Create_table extends CI_Migration {
    public function up() {
        $this->_create_producing_orders_table();
        $this->_create_order_producing_plans_table();
        $this->_create_warehouse_activities_table();
        $this->_create_warehouse_activity_items_table();
        $this->_create_steps_table();
        $this->_create_warehouses_table();
        $this->_create_lines_table();
        $this->_create_daily_productivity_table();
        $this->_create_colors_table();
        $this->_create_sizes_table();
        $this->_create_system_configs_table();
        $this->_create_subscriptions_table();
        $this->_create_material_balances_table();
        $this->_create_orders_table();
        $this->_create_materials_table();
        $this->_create_order_technical_attributes_table();
        $this->_create_packing_lists_table();
        $this->_create_packing_list_order_table();
        $this->_create_prepacks_table();
        $this->_create_prepack_attributes_table();
        $this->_modify_user_table();
    }

    public function _modify_user_table() {
        $fields = array(
            'parent_id' => array(
                'type'       => 'INT',
                'constraint' => 11,
                'after'      => 'email',
            ),
        );
        $this->dbforge->add_column('users', $fields);
    }

    public function down() {
        $this->dbforge->drop_table('producing_orders', FALSE);
        $this->dbforge->drop_table('order_producing_plans', FALSE);
        $this->dbforge->drop_table('warehouse_activities', FALSE);
        $this->dbforge->drop_table('warehouse_activity_items', FALSE);
        $this->dbforge->drop_table('order_producing_steps', FALSE);
        $this->dbforge->drop_table('warehouses', FALSE);
        $this->dbforge->drop_table('lines', FALSE);
        $this->dbforge->drop_table('daily_productivities', FALSE);
        $this->dbforge->drop_table('colors', FALSE);
        $this->dbforge->drop_table('sizes', FALSE);
        $this->dbforge->drop_table('system_configs', FALSE);
        $this->dbforge->drop_table('subscriptions', FALSE);
        $this->dbforge->drop_table('material_balances', FALSE);
        $this->dbforge->drop_table('orders', FALSE);
        $this->dbforge->drop_table('materials', FALSE);
        $this->dbforge->drop_table('order_technical_attributes', FALSE);
        $this->dbforge->drop_table('packing_lists', FALSE);
        $this->dbforge->drop_table('packing_list_order', FALSE);
        $this->dbforge->drop_table('prepacks', FALSE);
        $this->dbforge->drop_table('prepack_attributes', FALSE);
    }


    private function _create_orders_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `orders` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR (255) NOT NULL,
                  `customer` VARCHAR (255) NOT NULL,
                  `date_order` DATE  NOT NULL ,
                  `date_begin` DATE ,
                  `date_expried` DATE ,
                  `file_attachs` TEXT ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_materials_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `materials` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR (100) NOT NULL,
                  `unit` VARCHAR (255) NOT NULL,
                  `quantity` INT (11) NOT NULL DEFAULT '0' ,
                  `note` TEXT ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_order_technical_attributes_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `order_technical_attributes` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `order_id` INT(11) NOT NULL ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_material_balances_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `material_balances` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `order_id` INT(11) NOT NULL,
                  `color_id` INT(11) NOT NULL,
                  `size_id` INT(11) NOT NULL,
                  `material_id` int(11) NOT NULL,
                  `cons` FLOAT  NOT NULL ,
                  `quantity` INT(11) NOT NULL,
                  `quantity_issued` INT(11) NOT NULL,
                  `quantity_factual` INT(11) NOT NULL,
                  `balance` INT(11) NOT NULL,
                  `note` TEXT ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_subscriptions_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `subscriptions` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `company_id` int(11) NOT NULL,
                  `start_sub` DATE NOT NULL,
                  `end_sub` DATE NOT NULL,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_producing_orders_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `producing_orders` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `order_id` INT (11) NOT NULL ,
                  `date_created` DATE NOT NULL ,
                  `date_revised` DATE ,
                  `date_input` DATE NOT NULL ,
                  `date_del` DATE NOT NULL ,
                  `address_recieve` VARCHAR (255) ,
                  `user_created` INT (11) NOT NULL ,
                  `attribute` TEXT ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_order_producing_plans_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `order_producing_plans` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `order_id` INT(11) NOT NULL ,
                  `line_id` INT (11) NOT NULL ,
                  `step_id` INT (11) NOT NULL ,
                  `date_ns_etd` DATE NOT NULL ,
                  `date_start` DATE NOT NULL ,
                  `date_end` DATE NOT NULL ,
                  `count_saturday` INT (1) NOT NULL ,
                  `count_sunday` INT (1) NOT NULL ,
                  `quantity_for_line` INT (11) NOT NULL,
                  `output_per_day` INT (11) NOT NULL DEFAULT '0',
                  `note` TEXT ,  
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_warehouse_activities_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `warehouse_activities` (
                  `id` int(11) NOT NULL AUTO_INCREMENT ,
                  `type` VARCHAR (255) NOT NULL ,
                  `date` DATE NOT NULL ,
                  `warehouse_id` INT (11) NOT NULL ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_warehouse_activity_items_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `warehouse_activity_items` (
                  `id` int(11) NOT NULL AUTO_INCREMENT ,
                  `material_balance_id` INT (11) NOT NULL ,
                  `quantity` INT (11) NOT NULL ,
                  `activity_id` INT (11) NOT NULL ,
                  `note` TEXT ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_steps_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `order_producing_steps` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR (255) NOT NULL ,
                  `type` VARCHAR (255) ,
                  `note` TEXT ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_warehouses_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `warehouses` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR (255) NOT NULL ,
                  `note` TEXT ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_lines_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `lines` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR (255) NOT NULL ,
                  `user_id` INT (11) NOT NULL ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_daily_productivity_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `daily_productivities` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `date` DATE NOT NULL ,
                  `order_id` INT (11) NOT NULL ,
                  `line_id` INT (11) NOT NULL ,
                  `step_id` INT (11) NOT NULL ,
                  `quantity` INT (11) ,
                  `quality_state` INT (11) ,
                  `quality_note` TEXT (255) ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_colors_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `colors` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR (100) NOT NULL,
                  `description` VARCHAR (255),
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_sizes_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `sizes` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR (100) NOT NULL,
                  `description` VARCHAR (255),
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_system_configs_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `system_configs` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR (100) NOT NULL,
                  `value` VARCHAR (150) NOT NULL,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_packing_lists_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `packing_lists` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `order_id` INT(11) NOT NULL,
                  `p_o_no` VARCHAR (255) NOT NULL ,
                  `prepack` VARCHAR (255) NOT NULL ,
                  `carton_id_from` INT (11) NOT NULL ,
                  `carton_id_to` INT (11) NOT NULL ,
                  `color` VARCHAR (255) NOT NULL ,
                  `size_xs` INT (11) NOT NULL ,
                  `size_s` INT (11) NOT NULL ,
                  `size_m` INT (11) NOT NULL ,
                  `size_l` INT (11) NOT NULL ,
                  `size_xl` INT (11) NOT NULL ,
                  `size_xxl` INT (11) NOT NULL ,
                  `pcs_per_ctn` INT (11) NOT NULL ,
                  `ttl_ctn` INT (11) NOT NULL ,
                  `ttl_pcs` INT (11) NOT NULL ,
                  `nw_per_ctn` INT (11) NOT NULL ,
                  `gw_per_ctn` INT (11) NOT NULL ,
                  `ttl_nw` INT (11) NOT NULL ,
                  `ttl_gw` INT (11) NOT NULL ,
                  `meas` VARCHAR (255) NOT NULL ,
                  `ttl_cbm` INT (11) NOT NULL ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_packing_list_order_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `packing_list_order` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR (100) NOT NULL,
                  `detail` VARCHAR (255) NOT NULL,
                  `order_id` INT(11) NOT NULL ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_prepacks_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `prepacks` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name` VARCHAR (100) NOT NULL,
                  `order_id` INT(11) NOT NULL ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }

    private function _create_prepack_attributes_table() {
        $sql = "CREATE TABLE IF NOT EXISTS `prepack_attributes` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `product_id` INT (11) NOT NULL ,
                  `color_id` INT (11) NOT NULL ,
                  `size_id` INT (11) NOT NULL ,
                  `quantity` INT (11) NOT NULL ,
                  `created_on`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
    }
}