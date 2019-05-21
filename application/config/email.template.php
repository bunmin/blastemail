<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => '', 
    'smtp_port' => 25,
    'smtp_user' => '',
    'smtp_pass' => '',
    'smtp_crypto' => '', //can be 'ssl' or 'tls' for example
    'mailtype' => 'text', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '30', //in seconds
    'charset' => 'utf-8',
    'wordwrap' => TRUE,
    'mailtype' => 'html'
);