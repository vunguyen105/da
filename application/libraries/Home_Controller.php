<?php

class Home_Controller extends MY_Controller{   
    function __construct() {
        parent::__construct();        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('user_m');
    }  
    
     public function is_login(){
        $is_logged = $this->session->userdata('is_logged');
        if(isset($is_logged) && $is_logged == true)
            return true;
        else
            return false;
    }
}
?>
