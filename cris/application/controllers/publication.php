<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Publication extends CI_Controller {

    function index() {
        if ($this->crisuser->is_logged_in()) {
            $this->get_all_Pub();
        } else {
            redirect('/');
        }
    }

    function add() {
        if ($this->crisuser->is_logged_in()) {
            $this->get_header();
            $this->load->view('/publication/add');
            $this->load->view('/footers/general_footer');
        } else {
            redirect('/');
        }
    }

    function submit() {
        // echo 'mphka';
        if ($this->crisuser->is_logged_in()) {

            $data['pubid'] = $this->add_Pub();

            $this->get_header();
            $this->load->view('/publication/addfile', $data);
            $this->load->view('/footers/general_footer');
        } else {
            redirect('/');
        }
    }

    private function add_Pub() {
        //@todo add validation rules       

        $userid = $this->session->userdata['userid'];
        $depid = $this->session->userdata['department'];
        $type = $this->input->post('pubType');
        $title = $this->input->post('fTitle');
        $title_sec = $this->input->post('fTitle_sec');
        $uri = $this->input->post('uri');
        $citation = $this->input->post('citation');
        $pubType = $this->input->post('pubType');
        $sdate = convert_datepicker_to_str($this->input->post('startDate'));
        $data = $this->publication_model->add_Publication($userid, $depid, $type, $title, $title_sec, $uri, $citation, $sdate, $pubType);
        return $data;
    }

    function submit_file($pubid) {
        if ($this->crisuser->is_logged_in()) {

            $tmpName = $_FILES["fileToUpload"]['tmp_name'];
            $name = $_FILES["fileToUpload"]['name'];
            $fp = fopen($tmpName, 'r');
            $file = fread($fp, filesize($tmpName));
            fclose($fp);
            $this->publication_model->replace_file($pubid, $file, $name);
            echo '200 OK';
        } else {
            redirect('/');
        }
    }

    function replace_file($pubid) {
        if ($this->crisuser->is_logged_in()) {

            $tmpName = $_FILES["fileToUpload"]['tmp_name'];
            $name = $_FILES["fileToUpload"]['name'];
            $fp = fopen($tmpName, 'r');
            $file = fread($fp, filesize($tmpName));
            fclose($fp);

            $this->publication_model->replace_file($pubid, $file, $name);
        } else {
            redirect('/');
        }
    }

    private function get_all_Pub() {
        $this->get_header();
        $data['publication'] = $this->publication_model->get_all_Publications($this->session->userdata['userid']);
        $this->load->view('/publication/show_all', $data);
        $this->load->view('/footers/general_footer');
    }

    function show($pubid) {
        if ($this->crisuser->is_logged_in()) {
            $this->get_pub($pubid);
        } else {
            redirect('/');
        }
    }

    function up_one($pubid, $order_num) {
        if ($this->crisuser->is_logged_in()) {
            $this->publication_model->swap_writers($pubid, $order_num, $order_num - 1);
            $this->get_pub($pubid);
        } else {
            redirect('/');
        }
    }

    function down_one($pubid, $order_num) {
        if ($this->crisuser->is_logged_in()) {
            $this->publication_model->swap_writers($pubid, $order_num, $order_num + 1);
            $this->get_pub($pubid);
        } else {
            redirect('/');
        }
    }

    private function get_header() {
        $data['orgunits'] = $this->orgunit_model->get_org_units();
        $data['userproj'] = $this->project_model->get_user_projects($this->session->userdata['userid']);
        $this->load->view('/member/member_header', $data);
    }

    function addcowriter($pubid) {
        if ($this->crisuser->is_logged_in()) {
            $persid = $this->input->post('userid');
            $this->publication_model->add_Pers_to_Publ($pubid, $persid);
            $this->get_pub($pubid);
        } else {
            redirect('/');
        }
    }

    function addproj($pubid) {
        if ($this->crisuser->is_logged_in()) {
            $projid = $this->input->post('projid');
            $this->publication_model->add_Publ_to_Project($pubid, $projid);
            $this->get_pub($pubid);
        } else {
            redirect('/');
        }
    }

    public function get_pub($pubid) {

        $data['publication'] = $this->publication_model->get_Pub_Data($pubid);
        $data['writer'] = $this->publication_model->is_writer_of($this->session->userdata['userid'], $pubid);
        $data['projects'] = $this->publication_model->get_projects($pubid);
        $data['cowriter'] = $this->publication_model->get_members($this->session->userdata['userid'], $pubid);
        $data['suggest'] = $this->cowriter_model->get_cowriter($this->session->userdata['userid']);
        $data['admeta'] = $this->publication_model->get_admeta($pubid);
        $data['subjects'] = $this->publication_model->get_subject($pubid);

        $this->get_header();
        $this->load->view('/publication/show', $data);
        $this->load->view('/footers/general_footer');
    }

    function update($pubid) {
        if ($this->crisuser->is_logged_in()) {
            $title = $this->input->post('fTitle');
            $title_sec = $this->input->post('fTitle_sec');
            $uri = $this->input->post('uri');
            $citation = $this->input->post('citation');
            $pubType = $this->input->post('pubType');
            $sdate = convert_datepicker_to_str($this->input->post('startDate'));
            $this->publication_model->update($title, $title_sec, $uri, $sdate, $citation, $pubid, $pubType);
            $this->get_pub($pubid);
        } else {
            redirect('/');
        }
    }

    function update_meta($pubid) {
        if ($this->crisuser->is_logged_in()) {
            $abstract_el = $this->input->post('abstract_el');
            $abstract_en = $this->input->post('abstract_en');
            $subject_el = $this->input->post('subject_el');
            $subject_en = $this->input->post('subject_en');

            $this->publication_model->update_meta($abstract_el, $abstract_en, $pubid);
            $this->publication_model->update_subject($subject_el, $subject_en, $pubid);

            $this->get_pub($pubid);
        } else {
            redirect('/');
        }
    }

}
