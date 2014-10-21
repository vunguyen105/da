<?php

class site extends Home_Frontend {

    public $new_nested_set;

    function __construct() {
        parent::__construct();
//        if ($this->is_login() == false)
//            redirect('home/login');
        $this->load->library('session');
        $this->load->library('category_lib');
        $this->new_nested_set = $this->category_lib->category_initialize();

        $data['menu'] = $this->new_nested_set->build_menu_frontend(1);
        $this->template->write_view('header_nav', 'front_end/header_nav', $data, true);
    }

    
     function index(){
        $this->template->add_title('Trang chủ'); 
        $this->load->model('Home_m');
        // $data['slide'] = $this->Home_m->get_img_slide();
        //var_dump($data['slide']);
        //$data['pro_price'] = $this->Home_m->get_pro_price();
        //var_dump($data['pro_price']);
         //$data['pro_new'] = $this->Home_m->get_pro_new(10);
        //echo "<pre>";var_dump($data['pro_new']);
        // $data['pro_top'] = $this->Home_m->get_pro_top();
         //echo '<pre>';var_dump($data['pro_top']);
        // foreach ($data['pro_top'] as $key => $value)
        // {
        //     $data['id'][] = $value['id_pro'];
        // }
        // if(!empty($data['id']))
        // {
        //     $data['top'] = $this->Home_m->get_top($data['id']);
        // }
       //var_dump($data['top']);
        $this->template->write_view('home_page', 'home/home','',true);
        $this->template->render();
    }
   

    public function category() {

        $data['menu'] = $this->new_nested_set->build_menu_frontend(1);
        //var_dump($menu);die;
//        $data['sub_menu'] = array();
//        foreach ($data['subs'] as $key => $value) {
//            $data['sub_menu'][] = $this->new_nested_set->build_menu($value['id']);
//        }
        //var_dump($data['sub_menu']);die;
//        echo "<pre>";
//        var_dump($this->new_nested_set->Item_List(2, $root_nodes1));
//        die;
        //$data['menu2'] = $this->new_nested_set->Menu_Node_Bootstrap($nodes2, $root_nodes2, $class);
        //var_dump($data['menu']);die;
        //$this->template->write_view('home_page', 'category/view_category', $data, true);
        $this->template->write_view('header_nav', 'front_end/header_nav', $data, true);
        $this->template->render();
    }

    public function testxxx() {
        $data['subs'] = $this->new_nested_set->getChildOfTree();
        var_dump($data['subs']);die;
        if (isset($data['subs'][0])) {
            $data['sub_menu'] = $this->new_nested_set->build_menu($data['subs'][0]['id']);
        }
        $this->template->write_view('home_page', 'users/testxxx', '', true);
        $this->template->render();
    }

     function login()
    {
         if(!isset($this->session->userdata['user']))
         {
          
            $this->template->add_title('Đăng nhập'); 
               $this->load->library('form_validation');
                       $this->form_validation->set_rules('username', 'Tài khoản', 'required|xss_clean');
                       $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[4]');

                       if($this->form_validation->run() !==false){
                            $this->load->model('user_m');
                            $very = $this->user_m->verify_user(
                                               $this->input->post('username'),
                                               $this->input->post('password')
                                        );     
                            if($very !== FALSE)
                            {
                                $data =array(
                               'user'=>$this->input->post('username'),
                               'is_logged'=> true,
                               'email' => $very['email'],
                               'lastname' => $very['lastname'],    
                               'firstname' => $very['firstname']
                               );
                               $this->session->set_userdata($data);
                                $this->session->set_flashdata('message', "Bạn đã đăng nhập thành công.");
                                
                                header("Location: " . base_url(). "site/");
                            }
                            else
                            {
                                $this->session->set_flashdata('message', "Sai Tài khoản hoặc sai Mật khẩu");
                                header("Location: " . base_url() . "site/login/");
                            }
                       }
           $this->template->write_view('home_page', 'home/login','',true);
           $this->template->render();
         }
         else
         {
             redirect('site/account');
         }
    }
    function signup()
    {
        if(!isset($this->session->userdata['user']))
        {
            $this->template->add_title('Đăng ký'); 
            $this->load->library('form_validation');
                $this->form_validation->set_rules('username', 'Tài khoản', 'required|xss_clean|callback__checkuser');
                $this->form_validation->set_rules('firstname', 'Họ', 'required|xss_clean');
                $this->form_validation->set_rules('lastname', 'Tên', 'required|xss_clean');              
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[4]');
                $this->form_validation->set_rules('cpassword', 'Confirm password', 'required|trim|matches[password]');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback__checkemail');

                if($this->form_validation->run() !==false){    
                    $this->load->model('user_m');
                     $today = date('d-m-Y H:i:s');                 
                        $new_member_insert_data = array(
                                'username' => $this->input->post('username'),
                                'firstname' => $this->input->post('firstname'),
                                'lastname' => $this->input->post('lastname'),
                                'email' => $this->input->post('email'),
                                'password' => md5($this->input->post('password'))                
                            );
                        if($this->user_m->save($new_member_insert_data))
                        {           
                                 $this->session->set_flashdata('message', "Bạn đã đăng ký thành công mời bạn đăng nhập.");
                                 header("Location: " . base_url() . "Site/login");    
                        }
                        else
                        {
                                header("Location: " . base_url() . "Site/signup");  
                        }

                }

            $this->template->write_view('home_page', 'home/signup','',true);
            $this->template->render();
        }
        else {
             redirect('Site/account');   
        }
    }
    
    function _checkuser($user = NULL){
           $this->load->database();
           $this->db->from('users');
           $this->db->where('username',$user);
           $q = $this->db->get()->result();
           if(!empty($q)) {
               $this->form_validation->set_message('_checkuser', 'Tài khoản đã tồn tại!');
           return false;
           }
           return true;
       }
     
     function _checkemail($email = NULL){
           $this->load->database();
           $this->db->from('users');
           if(isset($this->session->userdata['user']))
           $this->db->where('username <>',$this->session->userdata['user']);   
           $this->db->where('email',$email);
           $q = $this->db->get()->result();
           if(!empty($q)) {
               $this->form_validation->set_message('_checkemail', 'Email đã được đăng ký!');
           return false;
           }
           return true;
       }
       
       function account()
       {    
           $this->template->add_title('Thông tin tài khoản'); 
           if(!isset($this->session->userdata['user']))
               header("Location: " . base_url() . "Site/login");
            $this->load->library('form_validation');
            $this->form_validation->set_rules('firstname', 'Họ', 'required|xss_clean');
            $this->form_validation->set_rules('lastname', 'Tên', 'required|xss_clean');                        
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_checkemail');
            $this->load->model('user_m');
            $data['acc'] = $this->user_m->get_by('username',$this->session->userdata['user']);
           //echo "<pre>"; var_dump($data['acc']);
          // var_dump($this->session->userdata['user']);die;
           if($this->form_validation->run() !==false){
            $this->load->model('user_m');
            $new_member_insert_data = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'address' => $this->input->post('address'),
                    'email' => $this->input->post('email')
            );
              //var_dump($new_member_insert_data);
            $where   = array('username' => $this->session->userdata['user']);
            if($this->user_m->save($new_member_insert_data,true,false,$where))
            {
                $this->session->set_flashdata('message', "Cập nhật thông tin thành công.");
                header("Location: " . base_url() . "site/account");
            }
            else
            {
                
                header("Location: " . base_url() . "site/account");
            }
           
           }
           $this->template->write_view('home_page', 'home/account',$data,true);
           $this->template->render();
       }
       
       function changePass()
       {
        $this->template->add_title('Đổi mật khẩu'); 
        $this->load->library('form_validation');
        $this->form_validation->set_rules('passw', 'Mật khẩu', 'trim|required|callback__checkpass');
        $this->form_validation->set_rules('passnew', 'Mật khẩu mới', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('passnewc', 'Mật khẩu mới confirm', 'trim|required|matches[passnew]');
            $data = '';
            if($this->form_validation->run() !==false){
                $this->load->model('user_m');
                $new_member_insert_data = array(
                        'password' => md5($this->input->post('passnew'))
                );
              
                $where   = array('username' => $this->session->userdata['user']);
                if($this->user_m->save($new_member_insert_data,true,false,$where))
                {
                    $this->session->set_flashdata('message', "Cập nhật mật khẩu thành công.");
                    header("Location: " . base_url() . "site/changePass");
                }
                else
                {
                     
                    header("Location: " . base_url() . "site/changePass");
                }
                 
            }
            $this->template->write_view('home_page', 'home/change_pass',$data,true);
            $this->template->render();
       }
       
       function _checkpass($password = NULL)
       {
        $this->load->database();
        $this->load->library('form_validation');
        $this->db->from('users');
        if(isset($this->session->userdata['user']))             
            $this->db->where('username',$this->session->userdata['user']);
        $this->db->where('password',md5($password));
        
        $q = $this->db->get()->result();
        if(empty($q)) {
            $this->form_validation->set_message('_checkpass', 'Mật khẩu vừa nhập không đúng với mật khâu cũ ');
            return false;
        }
        return true;
       }
        public function logout(){
        $data =array(
                     'user'=> NULL,
                     'is_logged'=> FALSE
                     );
        //$this->session->sess_destroy();
        $this->session->unset_userdata($data);    
        redirect('site/login');
    }
}
