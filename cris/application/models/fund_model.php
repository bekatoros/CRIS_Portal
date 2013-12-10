<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fund_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_funds() {//cfPers_ResPubl
      
        $query = $this->db->get('cfFund');
        if ($query->num_rows() > 0 ) {
          //  echo 'mphka';
            return $query->result_array();
        }
        else
        {
          return FALSE;
        }        
    }
    
     function get_fund_data($fundid) {//cfPers_ResPubl
      
         
         $this->db->where('cfFundid',$fundid);    
         $query = $this->db->get('cfFund');
        
        if ($query->num_rows() > 0 ) {
          //  echo 'mphka';
            return $query->result_array();
        }
        else
        {
          return FALSE;
        }
        
        
     }
     
    function get_funded_project($fundid){
        $this->db->select('cfProjId');
        $this->db->where('cfFundid',$fundid);   
        $query = $this->db->get('cfProj_Fund');
         if ($query->num_rows() > 0 ) {
          
            return $query->result_array();
        }
        else
        {
          return FALSE;
        }
    }
     
     
    function update($name_en, $name_el, $amount, $sdate, $edate, $fundid)
    {     
        $data = array(
            'cfName' => $name_en,
            'cuName_el' => $name_el,
            'cfAmount' => $amount,
            'cfStartDate' => $sdate,
            'cfEndDate' => $edate             
        );      
        $this->db->where('cfFundid',$fundid);
        $this->db->update('cfFund', $data);     
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
    }
          
    function add_fund($name_en, $name_el, $amount, $sdate, $edate)
    {        
        $data = array(
            'cfName' => $name_en,
            'cuName_el' => $name_el,
            'cfAmount' => $amount,
            'cfStartDate' => $sdate,
            'cfEndDate' => $edate,
            'cuOwnerId' => ""
        );

        $this->db->insert('cfFund', $data);
      
        $fund_id = $this->db->insert_id();
        return $fund_id;
    }
        
}