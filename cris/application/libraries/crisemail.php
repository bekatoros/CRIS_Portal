<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crisemail {

    protected $CI;

    function __construct() {
        $this->CI = & get_instance();
       // error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    }


    function send_email($from,$to,$subject,$message) {
        
            $this->CI->email->set_newline("\r\n");
            $this->CI->email->from($from);
            $this->CI->email->to($to);
            $this->CI->email->subject($subject);
            $this->CI->email->message($message);

            if ($this->CI->email->send()) {
                return true;
            } else {
                return $this->CI->email->print_debugger();
            }
        
    }
}