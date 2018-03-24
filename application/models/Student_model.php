<?php

require_once 'BaseModel.php';

class Student_model extends BaseModel{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function studentsInClassroomId($id)
    {
        $q = $this->db->from('students')
                      ->join('student_classroom','students.id = student_classroom.student_id')
                      ->where('id',$id)
                      ->get();
        return $q->result();
    }

    public function classroomsOfStudentId($id)
    {
        $q = $this->db->from('classrooms')
                      ->join('student_classroom','classrooms.id = student_classroom.classroom_id')
                      ->where('student_id',$id)
                      ->get();
        return $q->result();                      
    }


}