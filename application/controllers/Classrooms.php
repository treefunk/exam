<?php
require_once "BaseController.php";

class Classrooms extends BaseController{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('classroom_model');
        $this->load->model('teacher_model');
        $this->load->model('student_model');
        $this->load->model('exam_model');
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
        $data['exams'] = $this->exam_model->getAllExamsInClassroomId($id);
        $data['posts'] = $this->populateFeed($id);
        $this->wrapper('classrooms/manage',$data);
    }

    public function populateFeed($classroomId,$student = false)
    {
        $this->load->model('exam_model');
        $this->load->model('post_model');
        $feed = [];


        $exams = $this->exam_model->getAllExamsInClassroomId($classroomId);
        $posts = $this->post_model->getAllPostsForClassroom($classroomId);
        foreach($posts as $post)
        {
            $post->type = "post";
            $post->date = new DateTime($post->created_at,new DateTimeZone('Asia/Hong_kong'));
            if($this->post_model->checkIfPostHasAttachments($post->id)){
                $file = $this->post_model->fileOfPostId($post->id);
                $post->attached = $file->id;
                $post->full_path = $file->full_path;
                $post->file_type = $file->file_type;
                $post->file_name = $file->name;
            }
            $feed[] = $post;
        }
        foreach($exams as $exam)
        {
            if($this->exam_model->checkIfStudentHasTakenExam($student,$exam->id) && $this->session->userdata('type') == 'student'){
                $name = $exam->name;
                $date = new DateTime($exam->created_at,new DateTimeZone('Asia/Hong_kong'));
                $created_at = $exam->created_at;
                $score = $this->exam_model->getScoresForStudent($student,$exam->id);
                $score->name =  $name;
                $score->date = $date;
                $score->type = "score";
                $score->created_at = $created_at;
                $feed[] = $score;
            }else{
                $exam->type = "exam";
                $exam->date = new DateTime($exam->created_at,new DateTimeZone('Asia/Hong_kong'));
                $feed[] = $exam;
            }
        }
        $feed = $this->sortFeed($feed);
        return $feed;
    }

    public function join()
    {
        $this->checkIfLoggedIn('student');
        $code = $this->input->post('classcode');
        $studentId = $this->session->userdata('id');
        
        if($this->classroom_model->joinStudentToClassroom($studentId,$code)){
            $this->session->set_flashdata(['message' => 'Successfully joined the classroom!']);
        }
        redirect(base_url(''));
    }

    public function view($id)
    {
        $this->session->set_userdata('referred_from', current_url());
        $data['classroom'] = $this->classroom_model->findById($id);
        $data['teacher'] = $this->teacher_model->teacherOfClassroomId($id);
        $data['exams'] = $this->exam_model->getAllUnfinishedExams($this->session->userdata('id'),$id);
        $data['scores'] = $this->exam_model->getAllScoresForStudent($this->session->userdata('id'),$id);
        $data['posts'] = $this->populateFeed($id,$this->session->userdata('id'));
        $this->wrapper('classrooms/view',$data);
    }

    public function students($id)
    {

        $data['students'] = $this->student_model->studentsInClassroomId($id) ;
        
        $this->wrapper('classrooms/students',$data);
        
    }

    public function sortFeed($data)
    {
        usort($data, function($a,$b){
            return strtotime($b->created_at) - strtotime($a->created_at);
        });
        return $data;
    }

    public function index()
    {
        $data['classrooms'] = $this->classroom_model->getAllClassrooms();
        $this->wrapper('classrooms/index',$data);
    }

}