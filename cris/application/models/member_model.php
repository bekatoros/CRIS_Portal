<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function is_registered($email) {
        $this->db->where('cuEmail', $email);
        $query = $this->db->get('cfPers');

        if ($query->num_rows() == 1) {
            return $query->row()->cfPersId;
        } else {
            return FALSE;
        }
    }
    

    function get_user($userid) {
        $this->db->where('cfPersId', $userid);
        $query = $this->db->get('cfPers');
        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    function count_dep_users($depid)
    {
        $this->db->from('cfPers_OrgUnit');      
        $this->db->where('cfOrg_UnitId', $depid);
        $query = $this->db->get(); 
       return $query->num_rows();
    }
    
    function count_all_users()
    {
        $this->db->from('cfPers');     
       
        $query = $this->db->get(); 
       return $query->num_rows();
    }
    
     function get_dep_users($depid)
    {
        $this->db->from('cfPers_OrgUnit as po, cfPers as p');
        $this->db->where('po.cfPersId = p.cfPersId');        
        $this->db->where('cfOrg_UnitId', $depid);
        $this->db->order_by("cuFamilyNames_el", "asc");
        $query = $this->db->get(); 
       if ($query->num_rows() >0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }


    function get_userData($email) {

        $this->db->where('cuEmail', $email);
        $query = $this->db->get('cfPers');

        if ($query->num_rows() == 1) {

            $data['userid'] = $query->row()->cfPersId;
            $data['cris'] = $query->row()->cuCrisEnabled;
            $data['surname'] = $query->row()->cuFamilyNames_el; //el
            $data['name'] = $query->row()->cuFirstNames_el;       //el 
            $data['surname_other'] = $query->row()->cfFamilyNames; //en
            $data['name_other'] = $query->row()->cfFirstNames;   //en
            $data['gender'] = $query->row()->cfGender;   //en
            $data['website'] = $query->row()->cuWebsite;
            $data['telephone'] = $query->row()->cuTelephone;
            $data['contact'] = $query->row()->cuContact;
            //   $data['teaching'] = $query->row()->cuTeaching;
            $this->db->where('cfPersId', $data['userid']);
            $query2 = $this->db->get('cfPers_OrgUnit');
            if ($query2->num_rows() == 1) {
                $data['department'] = $query2->row()->cfOrg_UnitId;
            }
            $this->session->set_userdata($data);


            return TRUE; //$query->row();
        } else {
            return FALSE;
        }
    }

    function is_cris_enabled($persid) {
        $this->db->where('cfPersId', $persid);
        $this->db->where('cuCrisEnabled', '1');
        $query = $this->db->get('cfPers');
        if ($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function register_no_unit($name, $surname, $email, $department_id, $name_el, $surname_el, $gender) {
        $data = array(
            'cfFirstNames' => $name,
            'cfFamilyNames' => $surname,
            'cuEmail' => $email,
            'cfGender' => $gender,
            'cuCrisEnabled' => '0',
            'cuFamilyNames_el' => $surname_el,
            'cuFirstNames_el' => $name_el
        );
        $this->db->trans_start();
        $this->db->insert('cfPers', $data);

        $pers_id = $this->db->insert_id();


        $data = array(
            'cfPersId' => $pers_id,
            'cfOrg_UnitId' => '1'//exei mpei proswrina
        );

        $this->db->insert('cfPers_OrgUnit', $data);



        $data3 = array(
            'cfPersId' => $pers_id
        );
        $this->db->insert('cfPers_CV', $data3);



        $data4 = array(
            'cfPersId' => $pers_id
        );

        $this->db->insert('cuPosition', $data4);



        $this->db->trans_complete();
        if ($pers_id) {
            return $pers_id;
        } else {
            return FALSE;
        }
    }

    function register($name, $surname, $email, $department_id, $name_el, $surname_el, $gender) {
        $data = array(
            'cfFirstNames' => $name,
            'cfFamilyNames' => $surname,
            'cuEmail' => $email,
            'cfGender' => $gender,
            'cuCrisEnabled' => '0',
            'cuFamilyNames_el' => $surname_el,
            'cuFirstNames_el' => $name_el
        );

        $this->db->trans_start();

        $this->db->insert('cfPers', $data);

        $pers_id = $this->db->insert_id();
        $data = array(
            'cfPersId' => $pers_id,
            'cfOrg_UnitId' => $department_id
        );

        $this->db->insert('cfPers_OrgUnit', $data);



        $data3 = array(
            'cfPersId' => $pers_id
        );

        $this->db->insert('cfPers_CV', $data3);

       /* $data4 = array(
            'cfPersId' => $pers_id
        );

        $this->db->insert('cuPosition', $data4);
*/
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            return $pers_id;
        }
    }

    function updateTeaching($pers_id, $teaching) {
        $data = array(
            'cuTeaching' => $teaching,
        );

        $this->db->where('cfPersId', $pers_id);
        $this->db->update('cfPers', $data);

        return TRUE;
    }

    function updateProfile($name, $surname, $email, $department_id, $name_el, $surname_el, $gender, $pers_id, $www, $tel, $contact) {
        $data = array(
            'cfFirstNames' => $name,
            'cfFamilyNames' => $surname,
            'cfGender' => $gender,
            'cuWebsite' => $www,
            'cuTelephone' => $tel,
            'cuContact' => $contact,
            'cuFamilyNames_el' => $surname_el,
            'cuFirstNames_el' => $name_el
        );

        $this->db->trans_start();
        $this->db->where('cfPersId', $pers_id);
        $this->db->update('cfPers', $data);

        //  $pers_id = $this->db->insert_id();
        $data2 = array(
            'cfOrg_UnitId' => $department_id
        );
        $this->db->where('cfPersId', $pers_id);
        $this->db->update('cfPers_OrgUnit', $data2);

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
            //return $pers_id;
            return TRUE;
        }
    }

    function enable_cris($pers_id) {
        $data = array('cuCrisEnabled' => '1');
        $this->db->where('cfPersId', $pers_id);
        $this->db->update('cfPers', $data);
        // echo $this->db->last_query();
    }

    function disable_cris($pers_id) {
        $data = array('cuCrisEnabled' => '0');
        $this->db->where('cfPersId', $pers_id);
        $this->db->update('cfPers', $data);
        // echo $this->db->last_query();
    }

    function getCV($pers_id) {
        $this->db->where('cfPersId', $pers_id);
        $query = $this->db->get('cfPers_CV');
        if ($query->num_rows() == 1) {            
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    function upload_CV($userid, $uploadeddata) {
        //  print_r($uploadeddata);
        //   echo 'to full path einai'.$uploadeddata['full_path'];
        $data = array('cfCVDoc' => $uploadeddata['file_name']);
        $this->db->where('cfPersId', $userid);
        $this->db->update('cfPers_CV', $data);
    }
    
    function upload_Pic($userid, $uploadeddata) {
        //  print_r($uploadeddata);
        //   echo 'to full path einai'.$uploadeddata['full_path'];
        $data = array('cuPhoto' => $uploadeddata['file_name']);
        $this->db->where('cfPersId', $userid);
        $this->db->update('cfPers', $data);
    }

    function addPosition($pers_id, $position, $startdate, $enddate,$extra) {
        $data = array(
            'cfPersid' => $pers_id,
            'cuStartDate' => $startdate,
            'cuEndDate' => $enddate,
            'cuPositionType' => $position,
            'cuExtra'=>$extra
        );
        $this->db->insert('cuPosition', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getPosition($pers_id) {
        $this->db->where('cfPersid', $pers_id);
        $query = $this->db->get('cuPosition');

        if ($query->num_rows() > 0) {
            //  echo 'mphka';
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function setcurrent($userid, $posid) {
        $data1 = array(
            'cuCurrentPosId' => $posid
        );
        $this->db->where('cfPersId', $userid);
        $this->db->update('cfPers', $data1);
    }

    function getcurrent($userid) {
        $this->db->select('cuCurrentPosId');
        $this->db->where('cfPersid', $userid);
        $query = $this->db->get('cfPers');

        if ($query->num_rows() > 0) {

            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    function getphoto ($userid) {
        $this->db->select('cuPhoto');
        $this->db->where('cfPersid', $userid);
        $query = $this->db->get('cfPers');

        if ($query->num_rows() > 0) {

            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function getlessons($userid) {

        $this->db->where('cfPersid', $userid);
        $query = $this->db->get('cuTeaching');

        if ($query->num_rows() > 0) {

            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function getresearch($userid) {

        $this->db->where('cfPersid', $userid);
        $query = $this->db->get('cuResearch');

        if ($query->num_rows() > 0) {

            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function addLesson($pers_id, $name) {
        $data = array(
            'cfPersid' => $pers_id,
            'cuName' => $name
        );
        $this->db->insert('cuTeaching', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
    
    function search_lesson($search)
    {
        $this->db->select('cuName as label');
        $this->db->like('cuName', $search);
        $query = $this->db->get('cuTeaching');   
        return json_encode($query->result_array());    
        
    }
    

    function deletelesson($lessonid) {
        $this->db->where('cuLessonId', $lessonid);
        $this->db->delete('cuTeaching');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function search_interest($search)
    {
        $this->db->select('cuName as label');
        $this->db->like('cuName', $search);
        $query = $this->db->get('cuResearch');   
        return json_encode($query->result_array());    
        
    }
    
    
    

    function addResearch($pers_id, $name) {
        $data = array(
            'cfPersid' => $pers_id,
            'cuName' => $name
        );

        $this->db->insert('cuResearch', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function deleteresearch($researchid) {
        $this->db->where('cuResearchId', $researchid);
        $this->db->delete('cuResearch');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function deleteposition($positionid) {
        $this->db->where('cuPositionId', $positionid);
        $this->db->delete('cuPosition');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
