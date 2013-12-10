
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cowriter_model extends CI_Model {

    function __construct() {
        parent::__construct();
        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    }

    function get_users($userid) {
        $str = 'SELECT * FROM cfPers WHERE cfPersId not in (Select 
           cfPersId from irCowriter where cfcoPersId=' . $userid . ')
           and cfPersId !=' . $userid;

        $query = $this->db->query($str);

        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return FALSE;
        }
    }

    function get_cowriter($userid) {
        // this->db->select('cfcoPersId');
        $this->db->from('irCowriter as co, cfPers as p ');
        $this->db->where('co.cfCoPersid = p.cfPersid');
        $this->db->where('co.cfPersId', $userid);
        $query = $this->db->get();
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return FALSE;
        }
    }

    function add_cowriter($persid, $copersid) {
        try {
            $data = array(
                'cfPersId' => $persid,
                'cfCoPersId' => $copersid
            );
            $this->db->trans_start();

            $this->db->insert('irCowriter', $data);
            $data2 = array(
                'cfPersId' => $copersid,
                'cfCoPersId' => $persid
            );
            $this->db->insert('irCowriter', $data2);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                return FALSE;
            } else {
                $this->db->trans_commit();
                return TRUE;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

}