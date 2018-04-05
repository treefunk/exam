<?php

require_once 'BaseController.php';

class Admin extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if($this->checkIfLoggedIn('admin')){
            $this->wrapper('admin_dashboard');
        }else{
            //login muna
            $this->wrapper('admin_login');
        }
    }
}