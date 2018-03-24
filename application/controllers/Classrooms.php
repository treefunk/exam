<?php
require "BaseController.php";

class Classrooms extends BaseController{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $this->load->library('form_validation');
        //Validations
        $this->form_validation->set_rules([
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|min_length[2]'
        ]);
       

        if($this->form_validation->run() === FALSE)
        {
            $this->wrapper('classrooms/create');
        }else{
 
        }
    }
}