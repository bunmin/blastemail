<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_emaillogdetail extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'detail_id' => array(
                                'type' => 'INT',
                                'constraint' => 11,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'email_log_uuid' => array(
                                'type' => 'CHAR',
                                'constraint' => '36',
                        ),
                        'log_action' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '500',
                                'null' => TRUE,
                        ),
                        'excuted_date' => array(
                                'type' => 'DATETIME',
                                'null' => TRUE,
                        ),
                        'description' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '1000',
                                'null' => TRUE,
                        ),
                ));
                $this->dbforge->add_key('detail_id', TRUE);
                $this->dbforge->create_table('email_log_detail');
        }

        public function down()
        {
                $this->dbforge->drop_table('email_log_detail');
        }
}