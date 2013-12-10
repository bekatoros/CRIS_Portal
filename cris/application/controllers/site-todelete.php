 
<?php 
class Site extends CI_Controller {


public function index(){
    
$data['myvalue']="some String";
$data['other']="other String";
$this->load->view('index_test',$data);

}

public function dos(){
echo 'dos';
}

public function about(){
$this->load->view('about');
}

}
?>