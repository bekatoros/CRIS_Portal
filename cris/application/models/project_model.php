<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Project_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_projects() {//cfPers_ResPubl
        $query = $this->db->get('cfProj');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function get_project_data($projectid) {//cfPers_ResPubl
        $this->db->where('cfProjId', $projectid);
        $query = $this->db->get('cfProj');

        if ($query->num_rows() > 0) {
            //  echo 'mphka';
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    
      function count_dep_projects($depid)
    {
        $this->db->from('cfProj_OrgUnit');      
        $this->db->where('cfOrg_UnitId', $depid);
        $query = $this->db->get();      
        
        return $query->num_rows();
    }

    function get_project_funding($projectid) {


        $this->db->from(' cfProj_Fund as pf, cfFund as f ');
        $this->db->where('pf.cfFundId = f.cfFundId');

        $this->db->where('cfProjId', $projectid);

        $query = $this->db->get('');

        if ($query->num_rows() > 0) {
            //  echo 'mphka';
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
   function get_project_units($projectid){
       $this->db->from(' cfProj_OrgUnit as po, cfOrg_Unit as o ');
        $this->db->where('po.cfOrg_UnitId = o.cfOrg_UnitId ');

        $this->db->where('cfProjId', $projectid);

        $query = $this->db->get('');

        if ($query->num_rows() > 0) {
            //  echo 'mphka';
            return $query->result_array();
        } else {
            return FALSE;
        }
       
   }
   
   function get_user_projects($userid)
   {  $this->db->from(' cfProj_Pers as pp, cfProj as p ');
      $this->db->where('pp.cfProjid = p.cfProjid ');
      $this->db->where('pp.cfPersId', $userid);
     // $this->db->limit(5, 0);
      $query = $this->db->get('');

        if ($query->num_rows() > 0) {
            //  echo 'mphka';
            return $query->result_array();
        } else {
            return FALSE;
        }
   }

    function is_member_of($userid, $projectid) {
        $this->db->where('cfProjId', $projectid);
        $this->db->where('cfPersId', $userid);
        $query = $this->db->get('cfProj_Pers');

        if ($query->num_rows() > 0) {
            //  echo 'mphka';
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function get_members($userid, $projectid) {

        $this->db->from('cfProj_Pers as pr, cfPers as p ');
        $this->db->where('pr.cfPersid = p.cfPersid');

        $this->db->where('cfProjId', $projectid);

        $query = $this->db->get('');

        if ($query->num_rows() > 0) {
            //  echo 'mphka';
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function add_project($name_en, $name_el, $code, $sdate, $edate, $ownerid, $orgunit) {

        //@todo fix dates

     //   $newsdate = date('Y-m-d', strtotime($sdate));
      //  $newedate = date('Y-m-d', strtotime($edate));
        $data1 = array(
            'cfTitle' => $name_en,
            'cuTitle_el' => $name_el,
            'cuProjCode' => $code,
            'cfStartDate' => $sdate,
            'cfEndDate' => $edate
        );
        $this->db->trans_start();
        $this->db->insert('cfProj', $data1);
        $proj_id = $this->db->insert_id();


        $data = array(
            'cfProjId' => $proj_id,
            'cfPersId' => $ownerid,
            'cfStartDate' => $newsdate,
            'cfEndDate' => $newedate
        );

        $this->db->insert('cfProj_Pers', $data);

        $data2 = array(
            'cfProjId' => $proj_id,
            'cfOrg_UnitId' => $orgunit,
            'cfStartDate' => $newsdate,
            'cfEndDate' => $newedate
        );

        $this->db->insert('cfProj_OrgUnit', $data2);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $proj_id;
        }
    }
    
    function add_org_to_proj($orgunit,$proj_id)
    {
        $data2 = array(
            'cfProjId' => $proj_id,
            'cfOrg_UnitId' => $orgunit            
        );

        $this->db->insert('cfProj_OrgUnit', $data2);
        
    }

    function add_to_proj($userid, $projid) {

        $data = array(
            'cfProjId' => $projid,
            'cfPersId' => $userid
        );
        $this->db->insert('cfProj_Pers', $data);
    }

    function add_fund_to_proj($fundid, $projid) {

        $data = array(
            'cfProjId' => $projid,
            'cfFundId' => $fundid            
        );
        $this->db->insert('cfProj_Fund', $data);
    }

    function update($name_en, $name_el, $code, $sdate, $edate, $projid) {
        // echo $sdate;
        //@todo fix dates....
    //    $newsdate = date('Y-m-d', strtotime($sdate));
        // echo $newsdate;
      //  $newedate = date('Y-m-d', strtotime($edate));

        $data1 = array(
            'cfTitle' => $name_en,
            'cuTitle_el' => $name_el,
            'cuProjCode' => $code,
            'cfStartDate' => $sdate,
            'cfEndDate' => $edate
        );
        $this->db->where('cfProjid', $projid);
        $this->db->update('cfProj', $data1);
       // print_r($data1);
    }
    
    function setmanager($projid, $manid)
    {
         $data1 = array(
            'cuManagerId' => $manid            
        );
        $this->db->where('cfProjid', $projid);
        $this->db->update('cfProj', $data1);
        
    }

}