<?php

require_once 'BaseController.php';

class Exams extends BaseController{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('exam_model');
        $this->load->model('classroom_model');
    }

    public function create($id)
    {
        $data['classroom'] = $this->classroom_model->findById($id);
        $this->wrapper('exams/create',$data);
    }


}