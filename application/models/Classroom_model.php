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
        $teacherId = $this->teacherLoggedInId();
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



}