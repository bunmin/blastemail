<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_first_add extends CI_Migration {

        public function up()
        {
                $this->db->query("DROP TABLE IF EXISTS `email_group`;");

                $this->db->query("
                CREATE TABLE IF NOT EXISTS `email_group` (
                  `uuid` char(50) DEFAULT NULL,
                  `group_name` varchar(500) NOT NULL,
                  `created_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  UNIQUE KEY `group_name` (`group_name`),
                  UNIQUE KEY `uuid` (`uuid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

                $this->db->query("DROP TABLE IF EXISTS `email_group_detail`;");

                $this->db->query("
                CREATE TABLE IF NOT EXISTS `email_group_detail` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `uuid_email_group` char(36) NOT NULL,
                  `email` varchar(100) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;");

                $this->db->query("DROP TABLE IF EXISTS `email_log`;");

                $this->db->query("
                        CREATE TABLE IF NOT EXISTS `email_log` (
                        `uuid` char(36) DEFAULT NULL,
                        `receiver` varchar(100) DEFAULT NULL,
                        `cc` varchar(1000) DEFAULT NULL,
                        `bcc` varchar(1000) DEFAULT NULL,
                        `subject` varchar(1000) DEFAULT NULL,
                        `message` longtext,
                        `status` varchar(500) DEFAULT NULL,
                        `send_dt` datetime DEFAULT CURRENT_TIMESTAMP,
                        `read_dt` datetime DEFAULT NULL,
                        UNIQUE KEY `uuid` (`uuid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
                
                $this->db->query("DROP TABLE IF EXISTS `protocol_setting`;");

                $this->db->query("
                CREATE TABLE IF NOT EXISTS `protocol_setting` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `protocol` varchar(200) DEFAULT '0',
                        `setting` varchar(200) DEFAULT '0',
                        `value` varchar(500) DEFAULT '0',
                        `enable` tinyint(1) DEFAULT '0',
                        `created_dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;");

                $this->db->query("DROP TABLE IF EXISTS `user`;");

                $this->db->query("
                CREATE TABLE IF NOT EXISTS `user` (
                        `id_user` int(11) NOT NULL AUTO_INCREMENT,
                        `nama` varchar(50) DEFAULT NULL,
                        `username` varchar(50) DEFAULT NULL,
                        `password` varchar(500) DEFAULT NULL,
                        PRIMARY KEY (`id_user`)
                ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;");

                $this->db->query("
                INSERT INTO `user` (`id_user`, `nama`, `username`, `password`) VALUES
                (1, 'Administrator', 'admin', 'IlMtGDaNXT7MuHA+CftTYeM4zmEOOeST7z7pH7xBAPw=');");

                $this->db->query("DROP TRIGGER IF EXISTS `before_insert_email_log`;");

                $this->db->query("SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';");

                // $this->db->query("DELIMITER //");

                $this->db->query("
                CREATE TRIGGER `before_insert_email_log` BEFORE INSERT ON `email_log` FOR EACH ROW 
                BEGIN
                        IF new.uuid IS NULL THEN
                                SET new.uuid = uuid();
                        END IF;
                END");

                // $this->db->query("DELIMITER ;");

                $this->db->query("SET SQL_MODE=@OLDTMP_SQL_MODE;");

                

        }

        public function down()
        {
                // $this->dbforge->drop_table('blog');
        }
}