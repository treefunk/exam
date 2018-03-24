<?php

require_once "BaseModel.php";

class Teacher_model extends BaseModel{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function loadClassrooms($teacherId)
    {
        $q = $this->db->from('classrooms')
                      ->where('teacher_id',$teacherId)
                      ->get();
        return $q->result();
    }

    public function teacherOfClassroomId($id)
    {
        $q = $this->db->from('teachers')
                      ->join('classrooms','teachers.id = classrooms.teacher_id')
                      ->where('classrooms.id',$id)
                      ->get();
        return $q->row();
    }

}