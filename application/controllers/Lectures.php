<?php

require_once 'BaseController.php';

class Lectures extends BaseController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lecture_model');
        $this->load->helper(['url','form']);
    }

    public function create()
    {
        if($this->input->post()){
            
        }
        $this->wrapper('lectures/create');
    }
}