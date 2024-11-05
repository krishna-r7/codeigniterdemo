<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),

            'contact' => array(
                'type' => 'INT',
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down() {
        if ($this->db->table_exists('users')) {
            $this->dbforge->drop_table('users');
        }
    }
}
    