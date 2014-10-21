<?php
class User_Controller extends MY_Controller{
    
    function __construct() {
        parent::__construct();
        $data = array();
        // Load library template
        $this->load->library('template');
        // Set template
        $this->template->set_template('admin');
          
        // Add DocType
        $this->template->add_doctype();
          
        // Parse data into view 
        $this->template->parse_view('header','admin/dashboard/header',$data);
        $this->template->parse_view('leftpanel','admin/dashboard/leftpanel',$data);
        $this->template->parse_view('content','admin/dashboard/content',$data);
        $this->template->parse_view('breadcrumbs','admin/dashboard/breadcrumbs',$data);
    }
    
    function is_login(){
        $is_logged = $this->session->userdata('is_logged');
        if(isset($is_logged) && $is_logged == true)
            return true;
        else
            return false;
    }
    
    function role(){
        if(!isset($this->session->userdata['role']))
            return FALSE;
        else
        {
            switch ($this->session->userdata['role']){
                case 1: redirect('AdminDashboard'); break;
                case 2: redirect('ModDashboard'); break;
                case 3: redirect('AuthDashboard'); break;
                case 4: redirect('ChickenDashboard'); break;
                case 5: redirect('UserDashboard'); break;
                default : redirect('Home_page'); break;
                
                  
            }
            
        }
    }
    
}