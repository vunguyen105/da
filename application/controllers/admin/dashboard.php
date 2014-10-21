<?php
class dashboard  extends Backend_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('dashboard_m');
        //if($this->is_login()== TRUE) redirect('Admin/user');
        //if($this->is_login()== FALSE) redirect('Admin/dashboard');
       // else $this->load->view('user/login.php');  
//        var_dump($this->session->userdata('is_logged'));
    }

    function index() {
       if($this->is_login()== true) redirect('dashboard/user');
        else
        {   
            $this->load->view('user/login.php');
        }   
    }
    
    function login(){
        if($this->is_login()== true) redirect('dashboard/user');// var_dump ($this->session->userdata('is_logged'));//  die('sdasd');//
        else
        {
            $this->load->library('form_validation');
                    $this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
                    $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|min_length[4]');

                    if($this->form_validation->run() !==false){
                      $very = $this->dashboard_m->verify_user(
                                            $this->input->post('username'),
                                            $this->input->post('password')
                                     ); 
                                     //echo "<pre>";var_dump($very);die;
                        if($very !== false){
                            
                            $data =array(
                            'username'=>$this->input->post('username'),
                            'is_logged'=> true,
                            'email' => $very->email,
                            'is_admin' => true,     
                            'lastname' => $very->lastname,
                            'firstname' => $very->firstname
                            );
                            $this->session->set_userdata($data);
                            //var_dump($this->session->userdata('is_logged'));die;
                            //var_dump($data);die;
                            redirect('dashboard/user');

                            //var_dump($this->session->userdata());
                        }  else {
                             $this->session->set_flashdata('message', "Sai Tài khoản hoặc sai Mật khẩu");
                             $this->load->view('user/login.php');
                        }                      
                    }
                    $this->load->view('user/login.php');
            }     
       }
       
    public function logout(){
        //$this->session->sess_destroy();
        $data =array(
                            'user'=>NULL,
                            'is_logged'=> FALSE,
                            'is_admin' => FALSE
                            );
        $this->session->unset_userdata($data);
        $this->index();
    }
    
    
    
}

