<?php

require_once 'BaseModel.php';

class Post_model extends BaseModel{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function createPost($classroomId,$type,$by)
    {
        $q = $this->db->insert('posts',[
            'classroom_id' => $classroomId,
            'title' => $this->input->post('title'),
            'body' => $this->input->post('body'),
            'created_by' => $by,
            'type' => $type
        ]);
        
        if($_FILES){

            $filename = $this->db->insert_id().'_'.$_FILES['fileToUpload']['name'];
            $origname = $_FILES['fileToUpload']['name'];
            $config['upload_path']          = APPPATH.'uploads\\';
            $config['max_size']             = "100000000000";
            $config['allowed_types']        = "*";
            $config['file_name']            = $filename;


            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('fileToUpload'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error); die();
            }
            else
            {
                    $data = $this->upload->data();
                    //var_dump($data); die();
                    $post_id = $this->db->insert_id();
                    $q = $this->db->insert('files',[
                        'post_id' => $post_id,
                        'name' => $origname,
                        'full_path' => $data['full_path'],
                        'file_type' => $data['file_type'],
                        'file_path' => $data['file_path']
                    ]);
            }
        
        }
        if($q){
            return true;
        }
        return false;

    }


    public function getAllPostsForClassroom($classroomId)
    {
        $q = $this->db->from('posts')
                      ->where('classroom_id',$classroomId)
                      ->get();
        return $q->result();
    }

    public function downloadAttachedFile($file)
    {
            $filename = $file->full_path;
            $fileinfo = pathinfo($filename);
            $sendname = $file->name;
            ob_start();
            header('Content-Description: File Transfer'); 
            header('Content-Type: application/octet-stream'); 
            header('Content-Disposition: attachment; filename="'.$sendname.'"');
            header('Pragma: public'); 
            flush(); 
            readfile($filename);
            exit();
    }

    public function checkIfPostHasAttachments($postId)
    {
        $q = $this->db->from('files')
                      ->where('post_id',$postId)
                      ->get();
        
        if($q->num_rows() > 0){
            return true;
        }
        return false;
    }

    public function fileOfPostId($postId)
    {
        $q = $this->db->from('files')
                      ->where('post_id',$postId)
                      ->get();
        return $q->row();
    }




}