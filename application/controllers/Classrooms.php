<?php
require_once "BaseController.php";

class Classrooms extends BaseController{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('classroom_model');
        $this->load->model('teacher_model');
        $this->load->model('student_model');
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
        $this->checkIfLoggedIn('teacher');
        $data['classroom'] = $this->classroom_model->view($id);
        $this->wrapper('classrooms/manage',$data);
    }

    public function join()
    {
        $this->checkIfLoggedIn('student');
        $code = $this->input->post('classcode');
        $studentId = $this->session->userdata('id');
        
        if($this->classroom_model->joinStudentToClassroom($studentId,$code)){
            $this->session->set_flashdata(['message' => 'Successfully joined the classroom!']);
        }
    }

    public function view($id)
    {
        $data['classroom'] = $this->classroom_model->findById($id);
        $data['teacher'] = $this->teacher_model->teacherOfClassroomId($id);
        $this->wrapper('classrooms/view',$data);
    }

    public function students($id)
    {

        $data['students'] = $this->student_model->studentsInClassroomId($id) ;
        
        $this->wrapper('classrooms/students',$data);
    }

}