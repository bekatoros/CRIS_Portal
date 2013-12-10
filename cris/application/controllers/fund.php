<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Fund extends CI_Controller {

    function index() {
        if ($this->crisuser->is_logged_in()) {
            $this->get_all_funds();
        } else {          
              redirect('/');
        }
    }

    private function get_header() {
           $data['orgunits'] = $this->orgunit_model->get_org_units();
        $data['userproj'] = $this->project_model->get_user_projects($this->session->userdata['userid']);
        $this->load->view('/member/member_header', $data);
    }

    function show($fundid) {
        if ($this->crisuser->is_logged_in()) {
            //$fundid = $this->input->get('fund');            
            $data['fund'] = $this->fund_model->get_fund_data($fundid);  
            $data['project']= $this->fund_model->get_funded_project($fundid);  
            $data['member'] = $this->project_model->is_member_of($this->session->userdata['userid'],  $data['project']['0']['cfProjId']);
            $this->get_header();
            $this->load->view('/fund/show', $data);
            $this->load->view('/footers/general_footer');
        } else {
            redirect('/');
        }
    }

    function submit() {
        if ($this->crisuser->is_logged_in()) {
            $name_en = $this->input->post('fName_en');
            $name_el = $this->input->post('fName_el');
            $amount = $this->input->post('fAmount');
            $sdate = convert_datepicker_to_str($this->input->post('startDate'));
            $edate = convert_datepicker_to_str($this->input->post('endDate'));
            $ownerid = $this->session->userdata['userid'];
            // echo $sdate . '   '  . $edate . '   '  . $name_en . '   '  . $name_el  . '   '  . $ownerid; 
            $fundid = $this->fund_model->add_fund($name_en, $name_el, $amount, $sdate, $edate, $ownerid);
            $this->get_all_funds();
        } else {
               redirect('/');
        }
    }

    function update($fundid) {
        if ($this->crisuser->is_logged_in()) {
            $name_en = $this->input->post('fName_en');
            $name_el = $this->input->post('fName_el');
            $amount = $this->input->post('fAmount');
            $sdate = convert_datepicker_to_str($this->input->post('startDate'));
            $edate = convert_datepicker_to_str($this->input->post('endDate'));
            //$fundid = $this->input->post('fundid');
            // echo $sdate . '  ' . $edate . '  ' . $name_el . '  ' . $name_en . '  ' . $fundid;
           if( $this->fund_model->update($name_en, $name_el, $amount, $sdate, $edate, $fundid)){
              $message='Οι αλλαγές καταχωρήθηκαν';
                $this->get_fund($fundid, $message);
           }
        } else {
              redirect('/');
        }
    }

    private function get_fund($fundid,$message='') {
        $data['fund'] = $this->fund_model->get_fund_data($fundid);
        $data['message']=$message;
//        echo '<pre>';
//        print_r($data);
//         echo '</pre>';
        $this->get_header();

        $this->load->view('/fund/show', $data);
        $this->load->view('/footers/general_footer');
    }

    private function get_all_funds() {

        $data['fund'] = $this->fund_model->get_all_funds();
        //    print_r($data['fund']);
        $this->get_header();
        $this->load->view('/fund/show_all', $data);
        $this->load->view('/footers/general_footer');
    }

    function add() {
        if ($this->crisuser->is_logged_in()) {
            $this->load->view('/member/member_header');
            $this->load->view('/fund/add');
            $this->load->view('/footers/general_footer');
        } else {
            redirect('/');
        }
    }

}
