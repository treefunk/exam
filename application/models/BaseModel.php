<?php

class BaseModel extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function authenticate($data,$tablename) # types: [Student,Teacher,Admin]
    {
        $q = $this->db->from($tablename)->where('username',$data['username'])->get();
        if($q->num_rows() > 0){
            $user = $q->result()[0];
            if(password_verify($data['password'],$user->password)){
                switch($tablename){
                 case 'students':
                    $type = "student";
                 break;
                 case 'teachers':
                    $type = "teacher";
                 break;
                 case 'admin':
                    $type = "admin";
                 break;   
                }
                $this->session->set_userdata([
                    'id' => $user->id,
                    'type' => $type,
                    'username' => $user->username
                ]);
                return true;
            }
        }else{
            var_dump("wrong password");
        }
        var_dump("not found");
    }

    public function signup($data,$type) # types: [Student,Teacher,Admin]
    {
        $data['password'] = password_hash($data['password'],PASSWORD_BCRYPT);
        return $this->db->set($data)->insert($type);
    }


}