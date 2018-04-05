<?php

require_once "BaseController.php";
class Teachers extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('teacher_model');
    }
    public function index()
    {
        $data['teachers'] = $this->teacher_model->getAllTeachers();
        $this->wrapper('teachers/index',$data);
    }
    public function delete($id)
    {
        $this->teacher_model->deleteTeacher($id);
        redirect(base_url('teachers'));
    }
}