<?php

class Member extends CI_Controller {

    function get_user() {
        $user = $this->input->get('user_id');
        $result = $this->member_model->get_user($user);

        echo '[' . json_encode($result) . ']';
    }

    private function get_header() {
        $data['orgunits'] = $this->orgunit_model->get_org_units();
        $data['userproj'] = $this->project_model->get_user_projects($this->session->userdata['userid']);
        $this->load->view('/member/member_header', $data);
    }

    function is_ldap() {
        //@todo an den exei org unit na to orisei

        $this->load->library('ldap');

        $user = $this->input->post('username');
        $pass = $this->input->post('password');


        if ($this->ldap->check_ldap_user($user, $pass)) {


            if ($this->member_model->is_registered($this->session->userdata['email'])) {
                $this->member_model->get_userData($this->session->userdata['email']);
                $this->get_header();
                $data = $this->home();
                $this->load->view('/home', $data);
            } else {
                $this->load->model('orgunit_model');
                $this->get_header();
                $data['orgunits'] = $this->orgunit_model->get_org_units();
                $this->load->view('/member/register', $data);
            }
            $this->load->view('/footers/general_footer');
        } else {
            //    echo 'mphka alla dendoyleue';

            $this->load->view('/headers/general_header');
            $data = $this->home();
            $data['message'] = "Invalid user credentials! <br/> Please try again!";
            $this->load->view('home', $data);
            $this->load->view('/footers/general_footer');
        }
    }

    function is_cas() {
        //@todo an den exei org unit na to orisei

        $this->load->library('cas');
        $this->cas->force_auth();
        $user = $this->cas->user();

        if ($this->cas->check_cas_user($user)) {

            if ($this->member_model->is_registered($this->session->userdata['email'])) {
                $this->member_model->get_userData($this->session->userdata['email']);
                $this->get_header();
                $data = $this->home();
                $this->load->view('/home', $data);
            } else {
                $this->load->model('orgunit_model');
                $this->get_header();
                $data['orgunits'] = $this->orgunit_model->get_org_units();
                $this->load->view('/member/register', $data);
            }
            $this->load->view('/footers/general_footer');
        } else {
            //    echo 'mphka alla dendoyleue';

            $this->load->view('/headers/general_header');
            $data = $this->home();
            $data['message'] = "Invalid user credentials! <br/> Please try again!";
            $this->load->view('home', $data);
            $this->load->view('/footers/general_footer');
        }
    }

    function register() {
//        $this->form_validation->set_rules('name', 'Name', 'required');
//        $this->form_validation->set_rules('surname', 'Surname', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('name_other', 'Other Name', 'required');
        $this->form_validation->set_rules('surname_other', 'other surname', 'required');

        $this->form_validation->set_message('name', 'Το όνομα σας είναι υποχρεωτικό');
        $this->form_validation->set_message('name_other', 'Το όνομα σας είναι υποχρεωτικό');
        $this->form_validation->set_message('surname_other', 'Το επώνυμό σας είναι υποχρεωτικό');

        $this->load->model('orgunit_model');
        $data['orgunits'] = $this->orgunit_model->get_org_units();

        if ($this->form_validation->run() == FALSE) {
            $data['error_msg'] = TRUE;
            $this->get_header();
            $this->load->view('/member/register', $data);
            $this->load->view('/footers/general_footer');
        } else {

            $gender = $this->input->post('gender');
            $othername = $this->input->post('name_other');
            $othersurname = $this->input->post('surname_other');
            $orgunit = $this->input->post('orgunit');
            $name = $this->session->userdata['name'];
            $email = $this->session->userdata['email'];
            $surname = $this->session->userdata['surname'];
            $pers_id = $this->member_model->register($othername, $othersurname, $email, $orgunit, $name, $surname, $gender);
            $this->session->set_userdata('userid', $pers_id);
            $this->session->set_userdata('name_other', $othername);
            $this->session->set_userdata('surname_other', $othersurname);
            $this->session->set_userdata('gender', $gender);
            $this->session->set_userdata('department', $orgunit);
            $this->session->set_userdata('cris', '0');
            $this->member_index();
        }
    }

    function updateProfile() { {

            $gender = $this->input->post('gender');
            $othername = $this->input->post('name_other');
            $othersurname = $this->input->post('surname_other');
            $orgunit = $this->input->post('orgunit');
            $name = $this->input->post('name'); //greek name
            $email = $this->session->userdata['email'];
            $surname = $this->input->post('surname'); //greek suname
            $www = $this->input->post('website'); //website
            $tel = $this->input->post('telephone'); //telephone
            $contact = $this->input->post('contact'); //contact
            $pers_id = $this->session->userdata['userid'];
            if ($this->member_model->updateProfile($othername, $othersurname, $email, $orgunit, $this->session->userdata['name'], $this->session->userdata['surname'], $gender, $pers_id, $www, $tel, $contact)) {
                $this->member_model->get_userData($email);
                $message = 'Το προφιλ σας ενημερώθηκε επιτυχώς';
                $this->profile($message);
            }
        }
    }

    function updateTeaching() {
        $pers_id = $this->session->userdata['userid'];
        $email = $this->session->userdata['email'];
        $teaching = $this->input->post('teaching'); //teach
        if ($this->member_model->updateTeaching($pers_id, $teaching)) {
            $this->member_model->get_userData($email);
            $message = 'Το προφιλ σας ενημερώθηκε επιτυχώς';
            $this->profile($message);
        }
    }

    function uploadCV($userid) {
        if ($this->crisuser->is_logged_in()) {
            $error = "";
            $msg = "";
            $file_element_name = 'fileToUpload';

            if (!$error) {
                $config['upload_path'] = './files/';
                $config['allowed_types'] = 'pdf';

                //      $config['max_size'] = 1024 * 512;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($file_element_name)) {
                    $error = $this->upload->display_errors('', '');
                } else {
                    // Update your DB here
                    //  echo  "success";
                    $cv = $this->member_model->getCV($this->session->userdata('userid'));
                 
                   
                  
                 unlink('/srv/www/htdocs/cris/files/' . $cv['cfCVDoc']);
                   
                    //     log( 'files/'.$this->member_model->getCV($this->session->userdata('userid')));
                    //unlink( );                   
                    $data = $this->upload->data();
                    $this->member_model->upload_CV($this->session->userdata('userid'), $data);
                    $email = $this->session->userdata['email'];
                    $this->member_model->get_userData($email);
                }
                
            }
            /* echo 
              echo "{";
              echo "error: '" . $error . "',\n";
              echo "msg: '" . $msg . "'\n";
              echo "}"; */
        } else {
            $this->login();
        }
    }

    function uploadPic($userid) {
        if ($this->crisuser->is_logged_in()) {
            $error = "";
            $msg = "";
            $file_element_name = 'picToUpload';

            if (!$error) {
                $config['upload_path'] = './userpic/';
                //    $config['allowed_types'] = 'jpg|jpeg';  
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                //   $config['max_size'] = 1024 * 512;
                $config['encrypt_name'] = FALSE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($file_element_name)) {
                    $error = $this->upload->display_errors('', '');
                    echo "300 " . $error;
                } else {
                    // Update your DB here
                    $msg .= "200 OK";
                    $data = $this->upload->data();
                    $this->member_model->upload_Pic($this->session->userdata('userid'), $data);
                    echo $msg;
                }
            } else {

                echo "{";
                echo "error: '" . $error . "',\n";
                echo "msg: '" . $msg . "'\n";
                echo "}";
            }
        } else {
            $this->login();
        }
    }

    function cris() {
        //edo tha ginete h energopoihsh toy cris
        //klhsh toy model gia allagh toy cris sto xrhsth
        //allagh toy session data gia energopoihsh toy cris

        if (!$this->session->userdata('cris')) {
            $this->member_model->enable_cris($this->session->userdata('userid'));
            $this->session->set_userdata('cris', '1');
        } else {
            $this->member_model->disable_cris($this->session->userdata('userid'));
            $this->session->set_userdata('cris', '0');
        }

        $this->profile();
    }

    function index() {

        if ($this->crisuser->is_logged_in()) {
            $this->member_index();
        } else {

            $this->login();
        }
    }

    function addPosition() {
        if ($this->crisuser->is_logged_in()) {
            $pers_id = $this->session->userdata['userid'];
            $position = $this->input->post('position'); //teach
            $extra = $this->input->post('extra');
            $startdate = convert_datepicker_to_str($this->input->post('startDate')); //teach
            $enddate = convert_datepicker_to_str($this->input->post('endDate')); //teach
            if ($this->member_model->addPosition($pers_id, $position, $startdate, $enddate, $extra)) {
                $this->member_model->get_userData($email);
                $message = 'Το προφιλ σας ενημερώθηκε επιτυχώς';
                $this->profile($message);
            }
        } else {
            $this->login();
        }
    }

    function addLesson() {
        if ($this->crisuser->is_logged_in()) {
            $pers_id = $this->session->userdata['userid'];
            $name = $this->input->post('lesson_name'); //teach
//         $startdate= convert_datepicker_to_str($this->input->post('startDate')); //teach
//         $enddate= convert_datepicker_to_str($this->input->post('endDate')); //teach
            if ($this->member_model->addLesson($pers_id, $name)) {
                $this->member_model->get_userData($email);
                $message = 'Το προφιλ σας ενημερώθηκε επιτυχώς';
                $this->profile($message);
            }
        } else {
            $this->login();
        }
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
                , 'projects' => $this->project_model->count_dep_projects($dep['id'])
            );
            array_push($data['fulldata'], $temp);
        }

        $data['publ'] = $this->publication_model->count_all_Publications();
        $data['users'] = $this->member_model->count_all_users();

        return $data;
    }

    function login() {
        $data = $this->home();
        $data['header'] = true;
        $this->load->view('/headers/general_header', $data);
        $this->load->view('home', $data);
        $this->load->view('/footers/general_footer');
    }

    function member_index() {


        $this->get_header();

        $data = $this->home();

        $this->load->view('home', $data);

        $this->load->view('/footers/general_footer');
    }

    public function profile($message = '') {
        $data['message'] = $message;
        $this->load->model('orgunit_model');
        $data['orgunits'] = $this->orgunit_model->get_org_units();
        $data['position'] = $this->member_model->getPosition($this->session->userdata('userid'));
        $data['positionTypes'] = $this->config->item('PositionTypes');
        $data['currentposid'] = $this->member_model->getcurrent($this->session->userdata('userid'));
        $data['teaching'] = $this->member_model->getlessons($this->session->userdata('userid'));
        $data['research'] = $this->member_model->getresearch($this->session->userdata('userid'));
        $data['photo'] = $this->member_model->getphoto($this->session->userdata('userid'));
        $data['cv'] = $this->member_model->getCV($this->session->userdata('userid'));
        if ($this->crisuser->is_logged_in()) {
            $this->get_header();

            $this->load->view('/member/profile', $data);
            $this->load->view('/footers/general_footer');
        } else {
            $this->login();
        }
    }

    public function logout() {

        $this->crisuser->logout();
        $this->load->library('cas');
        $this->cas->logout();
        $this->index();
    }

    function setcurrent($userid, $posid) {
        if ($this->crisuser->is_logged_in()) {

            //  $manid = $this->input->post('persid');
            // $projid = "" . $this->input->post('projid');
            //   echo $manid;
            $this->member_model->setcurrent($userid, $posid);
            $message = 'Το προφιλ σας ενημερώθηκε επιτυχώς';
            $this->profile($message);
        } else {
            $this->login();
        }
    }

    function removeLesson($lessonid) {
        if ($this->crisuser->is_logged_in()) {

            $this->member_model->deletelesson($lessonid);
            $this->profile();
        } else {
            $this->login();
        }
    }

    function searchInterest() {
        if ($this->crisuser->is_logged_in()) {

            $search = $this->input->get('term'); //teach


            $result = $this->member_model->search_interest($search);

            print_r($result);
        } else {
            $this->login();
        }
    }

    function searchLesson() {
        if ($this->crisuser->is_logged_in()) {

            $search = $this->input->get('term'); //teach


            $result = $this->member_model->search_lesson($search);

            print_r($result);
        } else {
            $this->login();
        }
    }

    function addResearch() {
        if ($this->crisuser->is_logged_in()) {
            $pers_id = $this->session->userdata['userid'];
            $name = $this->input->post('area_name'); //teach

            if ($this->member_model->addResearch($pers_id, $name)) {
                $this->member_model->get_userData($email);
                $message = 'Το προφιλ σας ενημερώθηκε επιτυχώς';
                $this->profile($message);
            }
        } else {
            $this->login();
        }
    }

    function removeresearch($researchid) {
        if ($this->crisuser->is_logged_in()) {

            $this->member_model->deleteresearch($researchid);
            $this->profile();
        } else {
            $this->login();
        }
    }

    function removeposition($positionid) {
        if ($this->crisuser->is_logged_in()) {

            $current = $this->member_model->getcurrent($this->session->userdata('userid'));
            foreach ($current as $cp) {
                $posid = $cp['cuCurrentPosId'];
            }
            if ($posid == $positionid) {
                $message = 'Δε μπορείτε να διαγράψετε τρέχουσα θέση';
            } else {
                $this->member_model->deleteposition($positionid);
                $message = 'Το προφιλ σας ενημερώθηκε επιτυχώς';
            }
            $this->profile($message);
        } else {
            $this->login();
        }
    }

    function searchrepository($search = '') {
        if ($this->crisuser->is_logged_in()) {
            $search = $search . $this->input->post('reposearch'); //teach
            $this->load->library('rssparser', array('url' => 'http://estia2.hua.gr:8080/xmlui/open-search/?query=' . $search . '&format=rss'));
            $this->get_header();

            $data['results'] = $this->rssparser->getFeed(50);
            $this->load->view('searchresult', $data);

            $this->load->view('/footers/general_footer');
        } else {
            $this->login();
        }
    }

}
