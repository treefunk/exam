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
        $this->load->model('student_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {

        if($this->checkIfLoggedIn('teacher')){
            $data['classrooms'] = $this->teacher_model->loadClassrooms($this->session->userdata('id'));
            $this->wrapper('teacher_dashboard',$data);

        }elseif($this->checkIfLoggedIn('student')){
            $data['classrooms'] = $this->student_model->classroomsOfStudentId($this->session->userdata('id'));
            $this->wrapper('student_dashboard',$data);

        }elseif($this->checkIfLoggedIn('admin')){

            $this->wrapper('admin_dashboard');

        }else{
            
            $this->wrapper('home'); 
        }
    }
    public function login()
    {
        $this->wrapper('login');
    }

    public function loginuser($id)
    {
        $data['id'] = $id;
        $this->wrapper('loginuser',$data);
    }

    public function reg()
    {
        $this->wrapper('register');
    }
    public function reguser($id)
    {
        $data['id'] = $id;
        $this->wrapper('reguser',$data);
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
                if(!$this->baseModel->authenticate($data,$tablename)){
                    redirect(base_url("main/loginuser/{$num}"));
                }else{
                    redirect(base_url());
                }
            }
    }

    public function signup($num) # 1 = Student | 2 = Teacher | 10 = Admin
    {
        #todo: Form validation


        if($num == 1){
            $user = 'students';
        }elseif($num == 2){
            $user = 'teachers';
        }else{
            $user = 'admin';
        }
        $this->form_validation->set_rules('username','Username',"required|is_unique[{$user}.username]");
        $this->form_validation->set_rules('password','Password','required');
        $this->form_validation->set_rules('confirm_password','Username','required|matches[password]');

        //var_dump($this->form_validation->run()); die();
        if($this->form_validation->run() === FALSE)
        {
            $data['id'] = $num;
            $this->wrapper('reguser',$data);
            return;
        }
        else{
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
                    $this->baseModel->signup($data,'admin');
                break;
            }
            $this->session->set_flashdata(['message' => "Signed up successfully!"]);
            redirect(base_url("main/loginuser/{$num}"));
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