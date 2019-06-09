<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_urlredirect extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'uuid' => array(
                                'type' => 'CHAR',
                                'constraint' => 36
                        ),
                        'url' => array(
                                'type' => 'VARCHAR',
                                'constraint' => 100
                        ),
                ));
                $this->dbforge->add_key('uuid', TRUE);
                $this->dbforge->create_table('url_redirect');
        }

        public function down()
        {
                $this->dbforge->drop_table('url_redirect');
        }
}