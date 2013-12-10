<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orgunit_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_org_units() {

        $query = $this->db->get('cfOrg_Unit');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $org_unit) {
                $orgunits[]=  array( 'name'=>$org_unit->cuName_el,'id'=> $org_unit->cfOrg_UnitId);
               //  $orgunits[] => array('Walnut Bun','Coffee'),
               // $orgunits[][1]= $org_unit->cfOrg_UnitId;
            }
            return $orgunits;
        } else {
            return FALSE;
        }
    }
    
    function get_name($depid)
    {
     //   $this->db->select('cuName_el');
        $this->db->where('cfOrg_UnitId', $depid);
        $query = $this->db->get('cfOrg_Unit');

        if ($query->num_rows() == 1) {
           
            return $query->result_array();
        } else {
            return FALSE;
        }
        
    }
    
    function get_org_units2() {

        
        $query = $this->db->get('cfOrg_Unit');

        if ($query->num_rows() > 0) {
                        
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
      function find_users_orgunit($persid) {

        $this->db->where('cfPersId', $persid);
        $query = $this->db->get('cfPers_OrgUnit');
       

        if ($query->num_rows() > 0) {                        
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    function get_org_units_data() {
        $this->db->select('* , count(*) as people ');
      $this->db->from('cfOrg_Unit as ou outer join cfPers_OrgUnit as po');
     //   SELECT *,COUNT( * )  AS PEOPLE FROM (`cfOrg_Unit` as ou, `cfPers_OrgUnit` as po) WHERE `ou`.`cfOrg_UnitId` = po.cfOrg_UnitId 
        $this->db->where('ou.cfOrg_UnitId = po.cfOrg_UnitId' );
       // $this->db->where('orp.cfOrg_UnitId','po.cfOrg_UnitId' );
        $query = $this->db->get('');
        
        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
                        
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    
}