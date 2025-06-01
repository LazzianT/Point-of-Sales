<?php

class AuthModel extends CI_Model{
    public function getDataLogin($username,$password){
        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        return $this->db->get()->num_rows();
    }


    public function getDataSession($username,$password){
        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        return $this->db->get()->result_array();
    }
}