<?php

class Home extends Backend_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    
    public function index()
    {
        $this->template->add_title('híc');
        $this->template->write('title', 'Sản phẩm mới');
        $this->template->write('desption', 'Sản phẩm mới');
        $this->load->model('user_m');
        //$xxx  = $this->user_m->get_by('email','nhamthinh@gmail.com');
        //var_dump($xxx);die;
        $this->template->render();
   //     $this->load->view('test');
    }
    
    public function login()
    {
        $dashboard = 'dashboard';
        //$this->is_login()== FALSE || redirect($dashboard);    
        $rules = $this->user_m->rules_login;
        $this->form_validation->set_rules($rules);

        if($this->form_validation->run() == TRUE){
        $very = $this->user_m->verify_user(
                                $this->input->post('username'),
                                $this->input->post('password')
                         );   
           if($very !== FALSE){
                    $data =array(
                                'is_logged'=> true,
                                'user'=>$very->USRNM,
                                'email' => $very->EMAIL,
                                'role' => $very->ROLE_ID,
                                'full_name' => $very->FULL_NAME
                    );
                $this->session->set_userdata($data);
                $this->session->set_flashdata('message', 'Bạn đã đăng nhập thành công. Hihihi');
                redirect($dashboard);
            }
            else { 
                $this->session->set_flashdata('message', 'Tài khoản hoặc mặc khẩu không hợp lệ');
                redirect('home/login','refresh');
            }
        }
        $this->load->view('home/login');
    }
    
       public function logout(){
        $this->session->sess_destroy();
        redirect('home/login');
    }
    
    public function test()
    {
        echo 1;die;
        $this->load->model('user_m');
        $xxx = $this->user_m->test();
        echo json_encode(array('a'=>$xxx,'b'=>1));die;
    }
}
?>
