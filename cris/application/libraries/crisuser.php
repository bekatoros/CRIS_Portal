<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crisuser {

    protected $CI;

    function __construct() {
        $this->CI = & get_instance();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    }
    
 public function is_logged_in() {
        if ($this->CI->session->userdata('email')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
    public function logout() {
       
        $this->CI->session->unset_userdata('email');
        $this->CI->session->unset_userdata('name');
        $this->CI->session->unset_userdata('surname');
        $this->CI->session->unset_userdata('title');
        $this->CI->session->sess_destroy();

       
    }
}

