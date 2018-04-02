<?php

require_once 'BaseModel.php';


class Classroom_model extends BaseModel{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function createClassroom($classroom)
    {
        $teacherId = $this->session->userdata('id');
        $code = $this->generateCode($teacherId);
        if($q = $this->db->insert('classrooms',[
            'name' => $classroom['name'],
            'teacher_id' => $teacherId,
            'code' => $code
        ])){
           return true ;
        }
        return false;
    }

    public function generateCode($salt)
    {
        return $salt.bin2hex(openssl_random_pseudo_bytes(2));
    }

    public function view($id)
    {
        $q = $this->db->from('classrooms')
                        ->where('id',$id)
                        ->where('teacher_id',$this->session->userdata('id'))
                        ->get()
                        ->row();
        return $q;
    }

    public function joinStudentToClassroom($studentId,$classcode)
    {
        $q = $this->db->from('classrooms')
                      ->where('code',$classcode)
                      ->get();
        if($q->num_rows() > 0)
        {
            $classroom = $q->row();

            $q = $this->db->from('student_classroom')
                          ->where('student_id',$studentId)
                          ->where('classroom_id',$classroom->id)
                          ->get();
            if($q->num_rows() > 0){
                $this->session->set_flashdata('message','You\'ve already joined this class!');
                return false;
            }

            $q = $this->db->insert('student_classroom',[
                'student_id' => $studentId,
                'classroom_id' => $classroom->id
            ]);
            if($q){
                return true;
            }
        }else{
            $this->session->set_flashdata('message','Code does not exist!');
            return false;
        }
    }

    public function findById($id)
    {
        $q = $this->db->from('classrooms')
                      ->where('id',$id)
                      ->get();
        return $q->row();
    }

}