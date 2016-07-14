<?php

/**
 * Created by PhpStorm.
 * User: miunh
 * Date: 12-Jul-16
 * Time: 9:23 AM
 */
class Migration_Add_notifications_table extends CI_Migration {

    /**
     * Drop table prepack_attributes, use prepacks_colors and prepacks_sizes instead
     */
    public function up() {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'link_to_warning' => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'icon'            => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'content'         => array(
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ),
            'count'           => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
            'user_receive_id' => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
            'status'          => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('notifications', TRUE, ['ENGINE' => 'InnoDB']);

    }

    /**
     * Drop two new tables (prepacks_colors and prepacks_sizes)
     * Recreate table prepack_attributes
     */
    public function down() {
        $this->dbforge->drop_table('notifications', FALSE);
    }
}