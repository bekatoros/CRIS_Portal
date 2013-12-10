<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$config['cas_server_url'] = 'https://yourssoserver'; 
$config['cas_port'] = '443'; 
$config['phpcas_path'] = '/opt/cas'; 
$config['cas_disable_server_validation'] = TRUE; 
//$config['cas_cachain']='/var/www/cert/chain-1650-pki.hua.gr.pem';
$config['cas_debug'] = TRUE; // <-- use this to enable phpCAS debug mode

$config['cas_logout']='/logout';
$config['casusermailattr']="mail";
$config['casuserfirstattr']="ginenName";
?>
