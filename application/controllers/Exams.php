<?php

require_once 'BaseController.php';

class Exams extends BaseController{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('exam_model');
        $this->load->model('classroom_model');
    }

    public function create($id)
    {
        $data['classroom'] = $this->classroom_model->findById($id);
        $this->wrapper('exams/create',$data);
    }

    public function take($id)
    {
        if(!$this->exam_model->checkIfStudentHasTakenExam($this->session->userdata('id'),$id)){
            $data['exam'] = $this->exam_model->findById($id);
            $data['questions'] = $this->exam_model->getAllExamQuestions($id);
            $this->wrapper('exams/take.php',$data);
        }else{
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        }
    }

    public function submit($studentId,$examId)
    {
        $q = $this->db->from('exams')
                      ->where('id',$examId)
                      ->get();
        $classroomId = $q->result()[0]->classroom_id;
        $score = 0;
        $totalQuestions = $this->exam_model->countTotalQuestions($examId);
        foreach($this->input->post() as $k => $v)
        {
            if($this->exam_model->getCorrectAnswerForQuestionByIndex((int)$k) == (int)$v){
                $score++;
            }
        }
        $q = $this->db->insert('student_scores',[
            'student_id' => $studentId,
            'exam_id' => $examId,
            'score' => $score,
            'total' => $totalQuestions,
            'percentage' => ($score/$totalQuestions) * 100
        ]);
        //flash
        redirect(base_url("classrooms/view/{$classroomId}"));
    }

    public function scores($examId)
    {
        $data['scores'] = $this->exam_model->getAllScoresForThisExam($examId);
        $data['exam'] = $this->exam_model->findById($examId);
        $this->wrapper('exams/scores',$data);
    }


}