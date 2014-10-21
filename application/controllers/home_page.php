<?php
class Home_page  extends Backend_Controller{
    function __construct() {
        parent::__construct();
        //if($this->is_login()== true) redirect('dashboard');
        //else $this->load->view('user/login.php');
    }

    function index() {
        //if($this->is_login()== true) redirect('dashboard');
        //else 
            $this->load->view('user/login.php');
    }
    
    function login(){
        if($this->is_login()== true) redirect('dashboard');
        else
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('username', 'User', 'required|xss_clean');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');

                if($this->form_validation->run() !==false){
                    $this->load->model('home_m');
                  $very = $this->home_m->verify_user(
                                        $this->input->post('username'),
                                        $this->input->post('password')
                                 );      
                                 //var_dump($very); die();
                    if($very !== false){
                        $data =array(
                        'user'=>$this->input->post('username'),
                        'is_logged'=> true,
                        'role' => $very->ROLE_ID,
                        'email' => $very->EMAIL,
                        'full_name' => $very->FULL_NAME
                        );
                        $this->session->set_userdata($data);
                        $this->role();
                    }
                }
                $this->index();
            }
       }
       
    public function logout(){
        $this->session->sess_destroy();
        $this->index();
    }
    
    
    
}

