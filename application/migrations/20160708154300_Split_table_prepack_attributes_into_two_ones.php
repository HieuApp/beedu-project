<?php

/**
 * Created by IntelliJ IDEA.
 * User: phong
 * Date: 08-Jul-16
 * Time: 3:43 PM
 */
class Migration_Split_table_prepack_attributes_into_two_ones extends CI_Migration {

    /**
     * Drop table prepack_attributes, use prepacks_colors and prepacks_sizes instead
     */
    public function up() {
        $this->dbforge->drop_table('prepack_attributes', FALSE);

        $this->dbforge->add_field([
            'prepack_id' => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
            'color_id'   => array(
                'type'       => 'INT',
                'constraint' => 7,
            ),
            'quantity'   => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->add_field('id');
        $this->dbforge->create_table('prepacks_colors', TRUE, ['ENGINE' => 'InnoDB']);

        $this->dbforge->add_field([
            'prepack_id' => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
            'size_id'    => array(
                'type'       => 'INT',
                'constraint' => 2,
            ),
            'quantity'   => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->add_field('id');
        $this->dbforge->create_table('prepacks_sizes', TRUE, ['ENGINE' => 'InnoDB']);
    }

    /**
     * Drop two new tables (prepacks_colors and prepacks_sizes)
     * Recreate table prepack_attributes
     */
    public function down() {
        $this->dbforge->drop_table('prepacks_colors', FALSE);
        $this->dbforge->drop_table('prepacks_sizes', FALSE);

        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'product_id' => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
            'color_id'   => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
            'size_id'    => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
            'quantity'   => array(
                'type'       => 'INT',
                'constraint' => 11,
            ),
            'created_on' => array(
                'type'  => 'timestamp',
                'after' => 'quantity',
            ),
        ]);
        $this->dbforge->add_field('created_on TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('prepack_attributes', TRUE, ['ENGINE' => 'InnoDB']);
    }
}
