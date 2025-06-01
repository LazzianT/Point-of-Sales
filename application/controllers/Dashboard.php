<?php
class Dashboard extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if($this->session->userdata('loggedin') == FALSE){
            redirect("Auth");
        }
    }

    public function index(){
        $data['judul'] = "Warung";
        $this->load->view('Template/header',$data);
        $this->load->view('Template/sidebar',$data);
        $this->load->view('Dashboard/index',$data);
        $this->load->view('Template/footer');
    }
}
?>