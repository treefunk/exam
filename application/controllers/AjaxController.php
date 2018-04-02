<?php

require_once 'BaseController.php';

class AjaxController extends BaseController{
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('exam_model');
    }

    public function exam($classroomId,$examtitle,$timelimit)
    {
        if($this->exam_model->checkIfExamNameExists($examtitle,$classroomId))
        {
            header('HTTP/1.1 500 Internal Server BangBangBang!');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'Exam name already exists! please choose another name')));
        }

        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        $examtitle = trim(urldecode($examtitle));
        
        var_dump($examtitle);
        $examId = $this->exam_model->createExamForClassroomId($classroomId,$examtitle,$timelimit);
        if($this->exam_model->createQuestionsAndAnswer($examId,$data)){
            $this->session->set_userdata(['message' => 'Exam Successfully Created!']);
            redirect(base_url());
        }
        
        
    }
    
    public function onLoadAjax($examId,$studentId)
    {
        $time = $this->exam_model->getCurrentTimeLimit($studentId,$examId);
        header('Content-type: application/json; charset=UTF-8');
        die(json_encode($time));
    }

    public function updateExam($examId,$studentId)
    {
        $this->exam_model->updateTimeExam($examId,$studentId);
        die(json_encode(['gg' => 'haha']));
    }
}