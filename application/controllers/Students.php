<?php

require_once "BaseController.php";
class Students extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('student_model');
    }
    public function index()
    {
        if($this->checkIfLoggedIn('admin')){
            $data['students'] = $this->student_model->getAllstudents();
            $this->wrapper('students/index',$data);
        }
    }
    public function delete($id)
    {
        if($this->checkIfLoggedIn('admin')){
            $this->student_model->deleteStudent($id);
            redirect(base_url('students'));
        }
    }
}