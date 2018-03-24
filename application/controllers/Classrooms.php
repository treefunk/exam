<?php
require "BaseController.php";

class Classrooms extends BaseController{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('classroom_model');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        //Validations
        $this->form_validation->set_rules('name','Name','required|min_length[3]');
       

        if($this->form_validation->run() == FALSE)
        {
            $this->wrapper('classrooms/create');
        }else{
            $this->classroom_model->create();
        }
    }
}