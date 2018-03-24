<?php
require_once "BaseController.php";

class Classrooms extends BaseController{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('classroom_model');
        $this->load->model('teacher_model');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        //Validations
        $this->form_validation->set_rules('name','Name','required|min_length[3]');
       

        if($this->form_validation->run() == FALSE)
        {
            $this->wrapper('classrooms/create');
        }else{
            if($this->classroom_model->createClassroom($this->input->post())){
                //Success
                $this->session->set_flashdata(['message' => 'Successfully Created a classroom!']);
                redirect(base_url(''));
            }else{
                //fail
                $this->session->set_flashdata(['message' => 'Cannot Create Classroom.']);
                redirect('');
            }
        }
    }

    public function manage($id)
    {
        $data['classroom'] = $this->classroom_model->view($id);
        $this->wrapper('classrooms/view',$data);
    }

}