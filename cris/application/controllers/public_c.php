<?php

class public_c extends CI_Controller {

    function license() {

        if ($this->crisuser->is_logged_in()) {
            $this->get_header();
        } else {
            $this->load->view('/headers/general_header', $data);
        }

        $this->load->view('/public/license');
        $this->load->view('/footers/general_footer');
    }

    function home() {
        $this->lang->load("errormessage", "greek");
        $this->lang->load("errormessage", "english");
        $data['language_msg'] = $this->lang->line("msg_first_name");

        $data['orgunits'] = $this->orgunit_model->get_org_units();
        $data['fulldata'] = array();
        foreach ($data['orgunits'] as $dep) {
            $temp = array('name' => $dep['name'], 'id' => $dep['id'],
                'pub' => $this->publication_model->count_dep_Publications($dep['id'])
                , 'people' => $this->member_model->count_dep_users($dep['id'])
                , 'projects' => $this->project_model->count_dep_projects($dep['id']));
            array_push($data['fulldata'], $temp);
        }
        if ($this->session->userdata('cris') === '1') {
            $data['header'] = true;
        } else {
            $data['header'] = false;
        }
        $this->load->view('/headers/general_header', $data);

        $data['publ'] = $this->publication_model->count_all_Publications();
        $data['users'] = $this->member_model->count_all_users();

        return $data;
    }

    public function logout() {

        $this->crisuser->logout();
        $this->index();
    }

    function showpub($pubid) {
        $data['orgunits'] = $this->orgunit_model->get_org_units();
        if ($this->session->userdata('cris') === '1') {
            $data['header'] = true;
        } else {
            $data['header'] = false;
        }

        if ($this->crisuser->is_logged_in()) {
            $this->get_header();
        } else {
            $this->load->view('/headers/general_header', $data);
        }

        $data['publication'] = $this->publication_model->get_Pub_Data($pubid);
        //   $data['writer'] = $this->publication_model->is_writer_of($this->session->userdata['userid'], $pubid);
        $data['projects'] = $this->publication_model->get_projects($pubid);
        $data['cowriter'] = $this->publication_model->get_members(0, $pubid);
        // $data['suggest'] = $this->cowriter_model->get_cowriter($this->session->userdata['userid']);
        $data['admeta'] = $this->publication_model->get_admeta($pubid);
        $data['subjects'] = $this->publication_model->get_subject($pubid);

        $this->load->view('/public/publication', $data);
        $this->load->view('/footers/general_footer');
    }

    function showdep($depid) {
        $data['orgunits'] = $this->orgunit_model->get_org_units();
        if ($this->session->userdata('cris') === '1') {
            $data['header'] = true;
        } else {
            $data['header'] = false;
        }


        if ($this->crisuser->is_logged_in()) {
            $this->get_header();
        } else {
            $this->load->view('/headers/general_header', $data);
        }



        $data['users'] = $this->member_model->get_dep_users($depid);
        $data['publ'] = $this->publication_model->count_dep_Publications($depid);
        $data['depname'] = $this->orgunit_model->get_name($depid);

        $data['fulldata'] = array();
        foreach ($data['users'] as $us) {
            $temp = array('cfPersId' => $us['cfPersId'],
                'cuFamilyNames_el' => $us['cuFamilyNames_el'],
                'cuFirstNames_el' => $us['cuFirstNames_el'],
                'publ' => $this->publication_model->count_user_Publications($us['cfPersId']));

            array_push($data['fulldata'], $temp);
        }

        $this->load->view('/public/department', $data);

        $this->load->view('/footers/general_footer');
    }
    
    function iframe($userid){
   
       $this->load->view('/headers/header_preamble', $data);
        $data['publication'] = $this->publication_model->get_all_Publications($userid);

        $data['fullpub'] = array();
        foreach ($data['publication'] as $pub) {
            $data['cowriter'] = $this->publication_model->get_members(0, $pub['cfResPublid']);

            $temp2 = '';

            foreach ($data['cowriter'] as $cow) {
                $temp2 = $temp2 . ', ' . '<a href="' . base_url() . 'index.php/public_c/showperson/' . $cow['cfPersId'] . '">' . $cow['cfFirstNames'] . ' ' . $cow['cfFamilyNames'] . '</a>';
              
            }
          
            $temp2 = substr($temp2, 1);
            $temp = array('cfTitle' => $temp2 . ': ' . $pub['cfTitle'] . ' ' . substr($pub['cfResPubDate'], 0, 4),
                'cfResPublid' => $pub['cfResPublid'],
                'irBitId' => $pub['irBitId']
            );
            array_push($data['fullpub'], $temp);
        }     


        $this->load->view('/public/iframe', $data);
        $this->load->view('/footers/iframe_footer');
        
        
    }

    function showperson($userid) {
        $data['orgunits'] = $this->orgunit_model->get_org_units();
        if ($this->session->userdata('cris') === '1') {
            $data['header'] = true;
        } else {
            $data['header'] = false;
        }


        if ($this->crisuser->is_logged_in()) {
            $this->get_header();
        } else {
            $this->load->view('/headers/general_header', $data);
        }
        $data['users_orgunit'] = $this->orgunit_model->find_users_orgunit($userid);
        $data['userdata'] = $this->member_model->get_user($userid);
        $data['position'] = $this->member_model->getPosition($userid);
        $data['positionTypes'] = $this->config->item('PositionTypes');
        $data['currentposid'] = $this->member_model->getcurrent($userid);
        $data['teaching'] = $this->member_model->getlessons($$userid);
        $data['research'] = $this->member_model->getresearch($userid);
        $data['photo'] = $this->member_model->getphoto($userid);
        $data['cv'] = $this->member_model->getCV($userid);
        $data['publication'] = $this->publication_model->get_all_Publications($userid);

        $data['fullpub'] = array();
        foreach ($data['publication'] as $pub) {
            $data['cowriter'] = $this->publication_model->get_members(0, $pub['cfResPublid']);

            $temp2 = '';

            foreach ($data['cowriter'] as $cow) {
                $temp2 = $temp2 . ', ' . '<a href="' . base_url() . 'index.php/public_c/showperson/' . $cow['cfPersId'] . '">' . $cow['cfFirstNames'] . ' ' . $cow['cfFamilyNames'] . '</a>';
              
            }
          
            $temp2 = substr($temp2, 1);
            $temp = array('cfTitle' => $temp2 . ': ' . $pub['cfTitle'] . ' ' . substr($pub['cfResPubDate'], 0, 4),
                'cfResPublid' => $pub['cfResPublid'],
                'irBitId' => $pub['irBitId']
            );
            array_push($data['fullpub'], $temp);
        }


        


        $this->load->view('/public/person', $data);
        $this->load->view('/footers/general_footer');
    }

    function index() {

        if ($this->crisuser->is_logged_in()) {
            $this->member_index();
        } else {
                $this-> home();
                $this->load->view('/home', $data);
                $this->load->view('/footers/general_footer');
        }
    }

    function member_index() {
        $data['orgunits'] = $this->orgunit_model->get_org_units();
        //  $this->lang->load("errormessage", "greek");
        // $this->lang->load("errormessage", "english");
        //  $data['language_msg'] = $this->lang->line("msg_first_name");

        $this->get_header();
        $data = $this->home();


        $this->load->view('/member/home', $data);
        $this->load->view('/footers/general_footer');
    }

    private function get_header() {
        $data['orgunits'] = $this->orgunit_model->get_org_units();
        $data['userproj'] = $this->project_model->get_user_projects($this->session->userdata['userid']);
        $this->load->view('/member/member_header', $data);
    }

}