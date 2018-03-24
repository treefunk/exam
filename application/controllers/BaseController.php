<?php

class BaseController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkIfLoggedIn($type = '') # $type: 'admin','student','teacher','any'
    {
        if($this->session->userdata('type') === $type){ return true; }
        elseif($this->session->userdata('username')){ return true; }
        else{  return false; }
    }

    public function wrapper($view,$data = NULL)
    {
        $this->load->view('partials/header');
        $this->load->view('partials/navigation');
        $this->load->view($view,$data);
        $this->load->view('partials/footer');
    }
}