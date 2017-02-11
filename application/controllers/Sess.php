<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sess extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    function cek() {
        if ($this->session->userdata('username') != NULL && $this->session->userdata('logged_in') == TRUE)
            redirect("Hajj/adm");
    }

    public function index() {
        $this->cek();
        $this->load->view('login');
    }

    function privillege() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            //echo md5($this->input->post("password"));exit;
            $auth = $this->Haj->select_row(
                    "web_user",
                    array(
                         "username" => $this->input->post("username"),
                         "password" => md5($this->input->post("password")) )
                    );
           
            if ( count($auth) > 0) {

                 $this->session->set_userdata(array(
                        'logged_in' => TRUE,
                        'username'  => $auth->username,
                        'nama'  => $auth->nama,
                        'id'        => $auth->user_id,
                        'role'      => $auth->role
                        )
                );
            
                redirect(base_url() . "Hajj/adm", 'refresh');
            } else {
                $this->session->set_flashdata("pesan","<p class='alert alert-danger'>Username atau password salah !</p>");
                $this->index();
            }
        }
    }

}