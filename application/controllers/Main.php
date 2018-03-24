<?php

require_once "BaseController.php";

class Main extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('teacher_model');
        $this->load->model('baseModel');
    }

    public function index()
    {
        if($this->checkIfLoggedIn('teacher')){
            $data['classrooms'] = $this->teacher_model->loadClassrooms($this->session->userdata('id'));
            $this->wrapper('teacher_dashboard',$data);

        }elseif($this->checkIfLoggedIn('student')){

            $this->wrapper('student_dashboard');

        }elseif($this->checkIfLoggedIn('admin')){

            $this->wrapper('admin_dashboard');

        }else{
            
            $this->wrapper('login');
        }
    }

    public function authenticate($num) # 1 = Student | 2 = Teacher | 10 = Admin
    {
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');
        switch($num){
            case 1:
                $tablename = 'students';
            break;
            case 2:
                $tablename = 'teachers';
            break;
            case 10:
                $tablename = 'admin';
            break;
        }
        if(isset($tablename)){
            $this->baseModel->authenticate($data,$tablename);
            redirect(base_url());
        }
    }

    public function signup($num) # 1 = Student | 2 = Teacher | 10 = Admin
    {
        #todo: Form validation
        if($this->input->post())
        {
            $data['username'] = $this->input->post('username');
            $data['password'] = $this->input->post('password');

            switch($num){
                case 1:
                    //Student
                    $this->baseModel->signup($data,'students');
                break;
                case 2:
                    //Teacher
                    $this->baseModel->signup($data,'teachers');
                break;
                case 10:
                    //Admin
                break;
            }
        }
    }
    
    public function register()
    {
        if(!$this->checkIfLoggedIn()){
            $this->load->view('signup');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(''));
    }


}