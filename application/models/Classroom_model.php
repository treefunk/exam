<?php

require('BaseModel.php');


class Classroom_model extends BaseModel{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function createClassroom($classroom)
    {
        // var_dump($this->generateCode('')); die();
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



}