<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_mod_emaillog extends CI_Migration {

        public function up()
        {
            $fields = array(
                'remarks' => array('type' => 'TEXT'),
                'sender_name' => array('type' => 'VARCHAR','constraint' => 500),
                'sender_email' => array('type' => 'VARCHAR','constraint' => 100),
            );
            $this->dbforge->add_column('email_log', $fields);
        }

        public function down()
        {
                $this->dbforge->drop_table('email_log');
        }
}