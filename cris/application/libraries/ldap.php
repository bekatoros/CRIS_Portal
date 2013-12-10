<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ldap {

    protected $CI;

    function __construct() {
        $this->CI = & get_instance();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    }

    public function check_ldap_user($user, $pass) {
        $ldaphost = $this->CI->config->item('ldaphost');
        $ldapport = $this->CI->config->item('ldapport');


        $ds = ldap_connect($ldaphost, $ldapport) or die("Could not connect to $ldaphost");
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
        //ldap_set_option($ds, LDAP_OPT_DEBUG_LEVEL, 7);
        if ($ds) {

            $ldapbind = ldap_bind($ds, $user, $pass);

            if ($ldapbind) {
             

                $filter = "mail=" . $user;
                if (!($search = @ldap_search($ds, 'dc=hua,dc=gr', $filter))) {

                } else {
                    $number_returned = ldap_count_entries($ds, $search);
                    $info = ldap_get_entries($ds, $search);
                    //echo "<p> The number of entries returned is " . $number_returned . "<p>";
                    for ($i = 0; $i < $info["count"]; $i++) {
                        $data['email'] = $info[$i]['mail'][0];
                        $data['name'] = $info[$i]['givenname'][0];
                        $data['surname'] = $info[$i]['sn'][0];
                        $data['title'] = $info[$i]['title'][0];
                        $data['department'] = $info[$i]['department'][0];
                    }
                    $this->CI->session->set_userdata($data);
                    return TRUE;
                }
            } else {
                $data['error_message'] = 'Invalid user credentials! <br/> Please try again!';

                return FALSE;
            }
        }
    }

    public function find_user($user) {
        $ldaphost = $this->CI->config->item('ldaphost');
        $ldapport = $this->CI->config->item('ldapport');


        $ds = ldap_connect($ldaphost, $ldapport) or die("Could not connect to $ldaphost");
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
        //ldap_set_option($ds, LDAP_OPT_DEBUG_LEVEL, 7);
        if ($ds) {

            $ldapbind = ldap_bind($ds, $this->CI->config->item('ldapuser'),  $this->CI->config->item('ldappass'));

            if ($ldapbind) {
                //print "Congratulations! $user is authenticated.";

                $filter = "mail=" . $user;
                if (!($search = @ldap_search($ds, 'dc=hua,dc=gr', $filter))) {
              
                } else {
                    $number_returned = ldap_count_entries($ds, $search);
                    $info = ldap_get_entries($ds, $search);
                    //echo "<p> The number of entries returned is " . $number_returned . "<p>";
                    for ($i = 0; $i < $info["count"]; $i++) {
//                       
                        $data['email'] = $info[$i]['mail'][0];
                        $data['name'] = $info[$i]['givenname'][0];
                        $data['surname'] = $info[$i]['sn'][0];
                        $data['title'] = $info[$i]['title'][0];
               //         $data['department'] = $info[$i]['department'][0];
                    }
                  //  $this->CI->session->set_userdata($data);
                    return $data;
                }
            } else {
                $data['error_message'] = 'Invalid user credentials! <br/> Please try again!';

                return FALSE;
            }
        }
    }
    
}

?>