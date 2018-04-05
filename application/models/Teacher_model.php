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

    public function getAllTeachers()
    {
        $q = $this->db->from('teachers')
                      ->where('created_at !=',NULL)
                      ->get();
        
        return $q->result();
    }

    public function deleteTeacher($id)
    {
        $q = $this->db->set(['created_at' => NULL])
                      ->where('teacher_id',$id)
                      ->update('classrooms');
        $q = $this->db->set(['created_at' => NULL])
                      ->where('id',$id)
                      ->update('teachers');
        if($q){
            $this->session->set_flashdata('Successfully Deleted!');
            return true;
        }else{
            $this->session->set_flashdata('Something went wrong');
            return false;
        }
    }

}