

<?php

class Cowriter extends CI_Controller {

    function show_cowriters() {

        if ($this->crisuser->is_logged_in()) {
            $data['suggest'] = $this->cowriter_model->get_users($this->session->userdata['userid']);
            $data['cowriters'] = $this->cowriter_model->get_cowriter($this->session->userdata['userid']);
            //      var_dump($data['cowriters']);
            //var_dump($data['suggest']);
            $this->get_header();
            $this->load->view('/member/cowriter', $data);
            $this->load->view('/footers/general_footer');
        } else {
            redirect('/');
        }
    }

    private function get_header() {
        $data['userproj'] = $this->project_model->get_user_projects($this->session->userdata['userid']);
        $this->load->view('/member/member_header', $data);
    }

    function new_cowriter() {
        if ($this->crisuser->is_logged_in()) {

            $this->get_header();

            if ($this->input->post('sel') === 'other') {
                $email = $this->input->post('email') . "@hua.gr";
                $this->invite_cowriter($email);
            } else {
                $copers_id = $this->input->post('sel');
                $this->add_cowriter($copers_id);
            }
            $data['suggest'] = $this->cowriter_model->get_users($this->session->userdata['userid']);
            $data['cowriters'] = $this->cowriter_model->get_cowriter($this->session->userdata['userid']);

            $this->load->view('/member/cowriter', $data);
            $this->load->view('/footers/general_footer');
        } else {
            redirect('/');
        }
    }

    function invite_cowriter($email = 'tsadimas@hua.gr') {

        $data = $this->ldap->find_user($email);

        if ($data) {
            $copers_id = $this->member_model->register_no_unit('', '', $data['email'], '', $data['name'], $data['surname'], '');
            $userid = $this->session->userdata['userid'];
            //  echo 'userid ' . $userid;
            $this->cowriter_model->add_cowriter($userid, $copers_id);
            //send mail to $email
            $this->crisemail->send_email("bekatoros@hua.gr", $email, "Πρόσκληση στο σύστημα CRIS", "Σε προσκαλώ να εγγραφείς στο 
                σύστημα Υποβολής Δημοσιεύσεων μπορείς να εισέλθει στο ".base_url() . "index.php/publications");
        } else {
            return FALSE;
        }
    }

    function add_cowriter($copers_id) {

        $userid = $this->session->userdata['userid'];
        if ($this->cowriter_model->add_cowriter($userid, $copers_id)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
