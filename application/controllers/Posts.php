<?php

require_once "BaseController.php";
class Posts extends BaseController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('post_model');
    }

    public function create($classroomId)
    {
        $user = $this->session->userdata('username');
        $type = $this->session->userdata('type');
        if($this->post_model->createPost($classroomId,$type,$user)){
            $this->session->set_flashdata(['message' => 'Your Post has been submitted!']);
        }else{
            $this->session->set_flashdata(['message' => 'Something went wrong please try again!']);
        }
        if($type == 'teacher'){
            redirect(base_url("classrooms/manage/{$classroomId}"));
        }else{
            redirect(base_url("classrooms/view/{$classroomId}"));
        }
    }

    public function file($id)
    {
        $q = $this->db->from('files')
                      ->where('id',$id)
                      ->get();
        $file = $q->row();

        $this->post_model->downloadAttachedFile($file);
    }


    

}