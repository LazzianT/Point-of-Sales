<?php
class Auth extends CI_Controller{
    public function __construct(){
        parent::__construct();
        // if($this->session->userdata('loggedin') == TRUE){
        //     redirect(base_url('Dashboard'));
        // }
    }

    public function index(){
        $this->load->view('Auth/index');
    }

    public function loginProses(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->load->model('authModel');
        $data['result'] = $this->authModel->getDataLogin($username,$password);
        $forSession = $this->authModel->getDataSession($username,$password);
        $this->session->set_userdata(
            [
                "username" => $forSession[0]['username'],
                "nama" => $forSession[0]['nama'],
                "level" => $forSession[0]['level'],
                "loggedin" => TRUE
            ]
        );
        
        echo json_encode(array("response" => $data['result']));
    }

    public function logout(){
        session_destroy();
        redirect(base_url('Auth'));
    }
}