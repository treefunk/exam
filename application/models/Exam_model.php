<?php

require_once 'BaseModel.php';

class Exam_model extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function createExamForClassroomId($classroomId,$examtitle,$timelimit)
    {
        $timelimit = (int)$timelimit;
        $q = $this->db->insert('exams',[
                          'classroom_id' => $classroomId,
                          'name' => $examtitle,
                          'timelimit' => $timelimit,
                          'created_by' => $this->session->userdata('username')
                      ]);
        return $this->db->insert_id();
    }

    public function createQuestionsAndAnswer($examId,$questions)
    {
        foreach($questions as $question)
        {
            $q = $this->db->insert('questions',[
                'exam_id' => $examId,
                'question_type' => $question->questionType,
                'question' => $question->question
            ]);

            $questionId = $this->db->insert_id();

            $correctanswer = $question->answers[(int)$question->correctanswer];
            foreach($question->answers as $answer)
            {
                $this->db->insert('answers', [
                    'question_id' => $questionId,
                    'answer' => $answer,
                    'isCorrect' => ($answer == $correctanswer) ? 1 : 0
                ]);
            }
        }

        return true;
    }

    public function getAllExamsInClassroomId($classroomId)
    {
        $q = $this->db->from('exams')
                      ->where('classroom_id',$classroomId)
                      ->get();
        return $q->result();
    }

    public function checkIfExamNameExists($examName,$classroomId){
        $q = $this->db->from('exams')
                      ->where('name',$examName)
                      ->where('classroom_id',$classroomId)
                      ->get();
        if($q->num_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function findById($id){
        $q = $this->db->from('exams')
                      ->where('id', $id)
                      ->get();
        return $q->row();
    }

    public function getCurrentTimeLimit($studentId,$examId)
    {
        $timelimit = $this->getTimeLimitOfExam($examId);
        if($timelimit == 0){
            return "No time limit";
        }
                $q = $this->db->from('exam_time')
                          ->where('student_id',$studentId)
                          ->where('exam_id',$examId)
                          ->get();
        if($q->num_rows() == 0){
            $this->db->insert('exam_time',[
                'student_id' => $studentId,
                'exam_id' => $examId,
                'time' => $timelimit
            ]);

            return $timelimit-0;
        }else{
            $currentTime = $q->row()->time;
            if($currentTime == 0){
                die();
            }   
            $q = $this->db->set(['time' => ($currentTime - 10)])
                          ->where('student_id',$studentId)
                          ->where('exam_id',$examId)
                          ->update('exam_time');
            return $currentTime-0;
        }

    }

    public function getTimeLimitOfExam($examId)
    {
        $q = $this->db->from('exams')
                      ->where('id',$examId)
                      ->get();
        return $q->result()[0]->timelimit;
    }

    public function updateTimeExam($examId,$studentId)
    {
        $q = $this->db->set(['time' => ($currentTime - 10)])
                      ->where('student_id',$studentId)
                      ->where('exam_id',$examId)
                      ->update('exam_time');
    }

    public function getAllExamQuestions($examId)
    {
        $result = [];
        $q = $this->db->from('questions')
                      ->where('exam_id',$examId)
                      ->get();
        $questions = $q->result();

        for($x = 0 ; $x < count($questions) ; $x++)
        {
            $result["question_{$x}"]['question'] = $questions[$x]->question;
            $result["question_{$x}"]['id'] = $questions[$x]->id;
            $result["question_{$x}"]['num'] = $x;
            $q = $this->db->from('answers')
                          ->where('question_id',$questions[$x]->id)
                          ->get();
            $answers = $q->result();
            foreach($answers as $answer){
                $result["question_{$x}"]['answers'][] = $answer;
                
            }
        }
        // var_dump($result); die();
        return $result;
        
    }

    public function getAnswersForQuestion($question_id)
    {
        $q = $this->db->from('answers')
                      ->where('question_id', $question_id)
                      ->get();
        return $q->result();
    }

    public function getCorrectAnswerForQuestionByIndex($question_id)
    {
        $x = 0;
        $q = $this->db->from('answers')
                      ->where('question_id', $question_id)
                      ->get();
        $questions = $q->result();
        foreach($questions as $question){
            if($question->isCorrect == 1){
                return $x;
            }else{
                $x++;
            }
        }
    }

    public function countTotalQuestions($examId)
    {
            $q = $this->db->from('questions')
                      ->where('exam_id',$examId)
                      ->get();
        return $q->num_rows();
    }

    public function getAllUnfinishedExams($studentId,$classroomId)
    {
        $q = $this->db->from('exams')
                      ->join('student_scores','exams.id = student_scores.exam_id')
                      ->where('student_id',$studentId)
                      ->where('classroom_id',$classroomId)
                      ->get();
        $finishedExam = $q->result();
        $finished = [];
        
        foreach($finishedExam as $e){
            $finished[] = $e->exam_id;
        }
        $q = $this->db->from('exams')
                      ->where('classroom_id',$classroomId)
                      ->get();
        $allExams = $q->result();
        
        $all_exams = [];
        foreach($allExams as $exam){
            $all_exams[] = $exam->id;
        }
        if($finished == 0){
            return false;
        }
        $unfinishedExams = array_diff($all_exams,$finished);
        if($unfinishedExams == NULL){
            return [];
        }
        $q = $this->db->from('exams')
                      ->where_in('id',$unfinishedExams)
                      ->where('classroom_id',$classroomId)
                      ->get();
        return $q->result();
    }

    public function getAllScoresForStudent($studentId,$classroomId)
    {
        $q = $this->db->select('student_scores.*,exams.*,exams.name as exam_name')
                      ->from('student_scores')
                      ->join('exams','student_scores.exam_id = exams.id')
                      ->where('student_id',$studentId)
                      ->where('classroom_id',$classroomId)
                      ->get();
        return $q->result();
    }

}