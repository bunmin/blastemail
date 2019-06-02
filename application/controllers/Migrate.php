<?php

class Migrate extends CI_Controller
{

        public function index()
        {
            $db_name = "blast_email";

            if( ! isset($this->db))
            {
                throw new RuntimeException("Must have a database loaded to run a migration");
            }

            // Are we connected to database ?
            if( ! $this->db->database !== $db_name)
            {

                //find out if that db even exists
                $this->load->dbutil();
                if( ! $this->dbutil->database_exists($db_name))
                {
                    // try to create database
                    $this->load->dbforge();
                    if( ! $this->dbforge->create_database($db_name))
                    {
                        throw new RuntimeException("Could not create the database '".$db_name."'");
                    }
                }
                

                // Connection data for database must be available 
                // in /config/database.php for this to work.

                // if(($db = $this->load->database('migrate', TRUE)) === TRUE)
                if($db = $this->load->database('migrate', TRUE))
                {
                    $this->db = $db;  //replace the previously loaded database
                }
                else
                {
                    throw new RuntimeException("Could not load '".$db_name."' database");
                }
            }

            $this->load->library('migration');

            if ($this->migration->current() === FALSE)
            {
                    show_error($this->migration->error_string());
            } else {
                redirect('app');
            }
        }

}