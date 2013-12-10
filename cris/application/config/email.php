<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


//Provide a valid username + password
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://your_smtp_host';
$config['smtp_port'] = 465; //your port
$config['smtp_user'] = 'your_smtp_user';	
$config['smtp_pass'] = 'your_password';
$config['newline'] = '\r\n';
$config['smtp_timeout'] = '60';
$config['starttls'] = TRUE;
