<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Project extends CI_Controller {

    function index() {
        if ($this->crisuser->is_logged_in()) {
            $this->get_all_Projects();
        } else {
            redirect('/');
        }
    }

    private function get_all_Projects() {
        $data['project'] = $this->project_model->get_all_projects();
        $this->get_header();
        $this->load->view('/project/show_all', $data);
        $this->load->view('/footers/general_footer');
    }

    function show($projectid) {
        //   $projectid = $this->input->get('project');
        if ($this->crisuser->is_logged_in()) {
            $this->get_project($projectid);
        } else {
            redirect('/');
        }
    }

    private function get_header() {
        $data['orgunits'] = $this->orgunit_model->get_org_units();
        $data['userproj'] = $this->project_model->get_user_projects($this->session->userdata['userid']);
        $this->load->view('/member/member_header', $data);
    }

    private function get_project($projectid) {
        $data['project'] = $this->project_model->get_project_data($projectid);
        $data['member'] = $this->project_model->is_member_of($this->session->userdata['userid'], $projectid);
        $data['members'] = $this->project_model->get_members($this->session->userdata['userid'], $projectid);
        $data['suggest'] = $this->cowriter_model->get_cowriter($this->session->userdata['userid']);
        $data['funding'] = $this->project_model->get_project_funding($projectid);
        // $data['funds'] = $this->fund_model->get_all_funds();
        $data['orgmembers'] = $this->project_model->get_project_units($projectid);
        $data['orgunits'] = $this->orgunit_model->get_org_units2();

        $this->get_header();
        $this->load->view('/project/show', $data);
        $this->load->view('/footers/general_footer');
    }

    function submit() {
        if ($this->crisuser->is_logged_in()) {
            $name_en = $this->input->post('fName_en');
            $name_el = "" . $this->input->post('fName_el');
            $code = $this->input->post('projcode');
            $orgunit = $this->input->post('orgunit');
            $sdate = convert_datepicker_to_str($this->input->post('startDate'));
            $edate = convert_datepicker_to_str($this->input->post('endDate'));
            $ownerid = $this->session->userdata['userid'];

            $fund_en = $this->input->post('fName_en_fund');
            $fund_el = $this->input->post('fName_el_fund');
            $amount = $this->input->post('fAmount');

            $projid = $this->project_model->add_project($name_en, $name_el, $code, $sdate, $edate, $ownerid, $orgunit);

            $fundid = $this->fund_model->add_fund($fund_en, $fund_el, $amount, $sdate, $edate);
            $this->project_model->add_fund_to_proj($fundid, $projid);

            $this->get_all_projects();
        } else {
            redirect('/');
        }
    }

    function add() {
        if ($this->crisuser->is_logged_in()) {
            $data['orgunits'] = $this->orgunit_model->get_org_units();
            //  $data['funds'] = $this->fund_model->get_all_funds();
            $this->get_header();
            $this->load->view('/project/add', $data);
            $this->load->view('/footers/general_footer');
        } else {
            redirect('/', 'refresh');
        }
    }

    function adduser($projid) {
        if ($this->crisuser->is_logged_in()) {
            $userid = $this->input->post('userid');
            // $projid = "" . $this->input->post('projid');
            //   echo $sdate.$edate;
            $this->project_model->add_to_proj($userid, $projid);
            $this->get_project($projid);
        } else {
            redirect('/');
        }
    }

    function setmanager($projid, $manid) {
        if ($this->crisuser->is_logged_in()) {

            //  $manid = $this->input->post('persid');
            // $projid = "" . $this->input->post('projid');
            //   echo $manid;
            $this->project_model->setmanager($projid, $manid);
            $this->get_project($projid);
        } else {
            redirect('/');
        }
    }

    function addorgunit($projid) {
        if ($this->crisuser->is_logged_in()) {
            $orgunit = $this->input->post('orgunitid');
            // $projid = "" . $this->input->post('projid');
            //   echo $sdate.$edate;
            $this->project_model->add_org_to_proj($orgunit, $projid);
            $this->get_project($projid);
        } else {
            redirect('/');
        }
    }

    function addfund($projid) {
        if ($this->crisuser->is_logged_in()) {
            $fundid = $this->input->post('fundid');
            // $projid = "" . $this->input->post('projid');
            //   echo $sdate.$edate;
            $this->project_model->add_fund_to_proj($fundid, $projid);
            $this->get_project($projid);
        } else {
            redirect('/');
        }
    }

    function update($projid) {
        if ($this->crisuser->is_logged_in()) {
            $name_en = $this->input->post('fName_en');
            $name_el = $this->input->post('fName_el');
            $code = $this->input->post('projcode');
            $sdate = convert_datepicker_to_str($this->input->post('startDate'));
            $edate = convert_datepicker_to_str($this->input->post('endDate'));
            //  $projid = "" . $this->input->post('projid');
            //  echo $sdate . $edate;
            $this->project_model->update($name_en, $name_el, $code, $sdate, $edate, $projid);
            $this->get_project($projid);
        } else {
            redirect('/');
        }
    }

}