<?php

class Site extends Home_Frontend{
    public function __construct() {
        parent::__construct();
        $this->load->helper("text");
    }
    
    function index(){
        $this->template->add_title('Trang chủ'); 
        $this->load->model('Home_m');
         $data['slide'] = $this->Home_m->get_img_slide();
        //var_dump($data['slide']);
        $data['pro_price'] = $this->Home_m->get_pro_price();
        //var_dump($data['pro_price']);
         $data['pro_new'] = $this->Home_m->get_pro_new(10);
        //echo "<pre>";var_dump($data['pro_new']);
         $data['pro_top'] = $this->Home_m->get_pro_top();
         //echo '<pre>';var_dump($data['pro_top']);
        foreach ($data['pro_top'] as $key => $value)
        {
            $data['id'][] = $value['id_pro'];
        }
        if(!empty($data['id']))
        {
            $data['top'] = $this->Home_m->get_top($data['id']);
        }
       //var_dump($data['top']);
        $this->template->write_view('home_page', 'home/home',$data,true);
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
                            $this->load->model('dashboard_m');
                            $very = $this->dashboard_m->verify(
                                               $this->input->post('username'),
                                               $this->input->post('password')
                                        );     
                            if($very !== FALSE)
                            {
                                $data =array(
                               'user'=>$this->input->post('username'),
                               'is_logged'=> true,
                               'email' => $very->email,
                               'last_name' => $very->last_name,    
                               'first_name' => $very->first_name
                               );
                               $this->session->set_userdata($data);
                                $this->session->set_flashdata('message', "Bạn đã đăng nhập thành công.");
                                header("Location: " . base_url());
                            }
                            else
                            {
                                $this->session->set_flashdata('message', "Sai Tài khoản hoặc sai Mật khẩu");
                                header("Location: " . base_url() . "Site/login/");
                            }
                       }
           $this->template->write_view('home_page', 'home/login','',true);
           $this->template->render();
         }
         else
         {
             redirect('Site/account');
         }
    }
    
    function signup()
    {
        if(!isset($this->session->userdata['user']))
        {
            $this->template->add_title('Đăng ký'); 
            $this->load->library('form_validation');
                $this->form_validation->set_rules('username', 'Tài khoản', 'required|xss_clean|callback_checkuser');
                $this->form_validation->set_rules('firstname', 'Họ', 'required|xss_clean');
                $this->form_validation->set_rules('lastname', 'Tên', 'required|xss_clean');              
                $this->form_validation->set_rules('password', 'Mật khẩu', 'required|min_length[4]');
                $this->form_validation->set_rules('cpassword', 'Confirm password', 'required|trim|matches[password]');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_checkemail');

                if($this->form_validation->run() !==false){    
                    $this->load->model('user_m');
                     $today = date('d-m-Y H:i:s');                 
                        $new_member_insert_data = array(
                                'user_name' => $this->input->post('username'),
                                'first_name' => $this->input->post('firstname'),
                                'last_name' => $this->input->post('lastname'),
                                'email' => $this->input->post('email'),
                                'password' => md5($this->input->post('password'))                
                            );
                         if($this->user_m->create($new_member_insert_data))
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
    
    function checkuser($user = NULL){
           $this->load->database();
           $this->db->from('user');
           $this->db->where('user_name',$user);
           $q = $this->db->get()->result();
           if(!empty($q)) {
               $this->form_validation->set_message('checkuser', 'Tài khoản đã tồn tại!');
           return false;
           }
           return true;
       }
     
     function checkemail($email = NULL){
           $this->load->database();
           $this->db->from('user');
           if(isset($this->session->userdata['user']))
           $this->db->where('user_name <>',$this->session->userdata['user']);	
           $this->db->where('email',$email);
           $q = $this->db->get()->result();
           if(!empty($q)) {
               $this->form_validation->set_message('checkemail', 'Email đã được đăng ký!');
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
            $data['acc'] = $this->user_m->get_user($this->session->userdata['user']);
           // var_dump($data['acc']);
           if($this->form_validation->run() !==false){
           	$this->load->model('user_m');
           	$new_member_insert_data = array(
           			'first_name' => $this->input->post('firstname'),
           			'last_name' => $this->input->post('lastname'),
                                'address' => $this->input->post('address'),
                                 'phone' => $this->input->post('phone'),
           			'email' => $this->input->post('email')
           	);
           	//var_dump($new_member_insert_data);
           	if($this->user_m->update($new_member_insert_data))
           	{
           		$this->session->set_flashdata('message', "Cập nhật thông tin thành công.");
           		header("Location: " . base_url() . "Site/account");
           	}
           	else
           	{
           		
           		header("Location: " . base_url() . "Site/account");
           	}
           
           }
           $this->template->write_view('home_page', 'home/account',$data,true);
           $this->template->render();
       }
       
       function changePass()
       {
       	$this->template->add_title('Đổi mật khẩu'); 
       	$this->load->library('form_validation');
       	$this->form_validation->set_rules('passw', 'Mật khẩu', 'trim|required|callback_checkpass');
       	$this->form_validation->set_rules('passnew', 'Mật khẩu mới', 'trim|required|min_length[4]|max_length[32]');
       	$this->form_validation->set_rules('passnewc', 'Mật khẩu mới confirm', 'trim|required|matches[passnew]');
       		$data = '';
       		if($this->form_validation->run() !==false){
       			$this->load->model('user_m');
       			$new_member_insert_data = array(
       					'password' => md5($this->input->post('passnew'))
       			);
       		
       			if($this->user_m->update($new_member_insert_data))
       			{
       				$this->session->set_flashdata('message', "Cập nhật mật khẩu thành công.");
       				header("Location: " . base_url() . "Site/changePass");
       			}
       			else
       			{
       				 
       				header("Location: " . base_url() . "Site/changePass");
       			}
       			 
       		}
	       	$this->template->write_view('home_page', 'home/change_pass',$data,true);
	       	$this->template->render();
       }
       
       function checkpass($password = NULL)
       {
       	$this->load->database();
        $this->load->library('form_validation');
       	$this->db->from('user');
       	if(isset($this->session->userdata['user']))       		
       		$this->db->where('user_name',$this->session->userdata['user']);
       	$this->db->where('password',md5($password));
       	
       	$q = $this->db->get()->result();
       	if(empty($q)) {
       		$this->form_validation->set_message('checkpass', 'Mật khẩu vừa nhập không đúng');
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
    
    function best_price()
    {
        $data = '';
         $this->template->add_title('Sản phẩm hot'); 
        $this->load->model('Home_m');
         $data['pro_new'] = $this->Home_m->get_pro_new(4);
            $data['pro_top'] = $this->Home_m->get_pro_top(8);
            foreach ($data['pro_top'] as $key => $value)
        {
            $data['id'][] = $value['id_pro'];
        }
        if(!empty($data['id']))
        {
            $data['top'] = $this->Home_m->get_top($data['id']);
        }
        $this->template->add_title('Sản phẩm khuyến mại'); 
        $this->load->model('Home_m');
        $this->load->library('pagination'); 
                $this->load->model('Product_m');
                $config['base_url'] = base_url('Site/'.$this->uri->segment(3, '').'/'.$this->uri->segment(4, '').'/best_price'.'?'); // xác định trang phân trang 
                $config['total_rows'] = $this->Product_m->get_count_pro_price();
                $config['per_page'] = 9; // xác định số record ở mỗi trang 
                $config['full_tag_open'] = ' <div class="pagination"><ul>';
                $config['first_link'] = '<<';
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['last_link'] = '>>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';
                $config['prev_link'] = '&#8592;';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = '&#8594;';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li>';
                $config['cur_tag_close'] = '</li>';
                $config['full_tag_close'] = '</ul></div>';
                $config['cur_tag_open'] = '<li><a class="curent">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['uri_segment'] = 7; // xác định segment chứa page number 
                $config['page_query_string'] = TRUE;
                //$data['create_links'] = $this->pagination->create_links();
                $this->pagination->initialize($config);
                $offset= '';
                if(isset($_GET['per_page'])) $offset = $_GET['per_page'];
                $data['pro_price'] = $this->Home_m->get_pro_price($config['per_page'],$offset);
                //$data['pros'] = $this->Product_m->get_pro_page($cat,$config['per_page'],$offset);
        $this->template->write_view('home_page', 'home/best_price',$data,true);
	$this->template->render();
    }
    
    
    function pro_hot()
    {        
        $this->template->add_title('Sản phẩm hot'); 
        $this->load->model('Home_m');
         $data['pro_new'] = $this->Home_m->get_pro_new(4);
            $data['pro_top'] = $this->Home_m->get_pro_top(8);
            foreach ($data['pro_top'] as $key => $value)
        {
            $data['id'][] = $value['id_pro'];
        }
        if(!empty($data['id']))
        {
            $data['top'] = $this->Home_m->get_top($data['id']);
        }
        $this->load->library('pagination'); 
                $this->load->model('Product_m');
                 $data['pro_top'] = $this->Home_m->get_pro_top_detail();
//                    echo '<pre>';var_dump($data['pro_top']);die;
                   foreach ($data['pro_top'] as $key => $value)
                   {
                       $data['id'][] = $value['id_pro'];
                   }
                   if(!empty($data['id']))
                   {
                       $config['base_url'] = base_url('Site/'.$this->uri->segment(3, '').'/'.$this->uri->segment(4, '').'/pro_hot'.'?'); // xác định trang phân trang 
//                       /$config['total_rows'] = count($data['id']);
                      // var_dump($config['total_rows']);
                $config['total_rows'] = $this->Home_m->top_count($data['id']);
                $config['per_page'] = 9; // xác định số record ở mỗi trang 
                $config['full_tag_open'] = ' <div class="pagination"><ul>';
                $config['first_link'] = '<<';
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['last_link'] = '>>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';
                $config['prev_link'] = '&#8592;';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = '&#8594;';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li>';
                $config['cur_tag_close'] = '</li>';
                $config['full_tag_close'] = '</ul></div>';
                $config['cur_tag_open'] = '<li><a class="curent">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['uri_segment'] = 7; // xác định segment chứa page number 
                $config['page_query_string'] = TRUE;
                $offset= '';
                $this->pagination->initialize($config);
                if(isset($_GET['per_page'])) $offset = $_GET['per_page'];
                $data['tops'] = $this->Home_m->get_top($data['id'],$config['per_page'],$offset);              
                }
                //$data['pro_price'] = $this->Home_m->get_pro_price($config['per_page'],$offset);
               
                
                //$data['pros'] = $this->Product_m->get_pro_page($cat,$config['per_page'],$offset);
        $this->template->write_view('home_page', 'home/pro_hot',$data,true);
	$this->template->render();
    }
    
    function pro_new()
    {        
        $this->template->add_title('Sản phẩm mới'); 
        $this->load->model('Home_m');
         $this->template->add_title('Sản phẩm hot'); 
        $this->load->model('Home_m');
         $data['pro_new'] = $this->Home_m->get_pro_new(4);
            $data['pro_top'] = $this->Home_m->get_pro_top(8);
            foreach ($data['pro_top'] as $key => $value)
        {
            $data['id'][] = $value['id_pro'];
        }
        if(!empty($data['id']))
        {
            $data['top'] = $this->Home_m->get_top($data['id']);
        }
        $this->load->library('pagination'); 
        
                $this->load->model('Product_m');
                $config['base_url'] = base_url('Site/'.$this->uri->segment(3, '').'/'.$this->uri->segment(4, '').'/pro_new'.'?'); // xác định trang phân trang 
                $config['total_rows'] = $this->Home_m->get_pro_new_count();
                //var_dump($config['total_rows']);die;
                $config['per_page'] = 9; // xác định số record ở mỗi trang 
                $config['full_tag_open'] = ' <div class="pagination"><ul>';
                $config['first_link'] = '<<';
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['last_link'] = '>>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';
                $config['prev_link'] = '&#8592;';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = '&#8594;';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li>';
                $config['cur_tag_close'] = '</li>';
                $config['full_tag_close'] = '</ul></div>';
                $config['cur_tag_open'] = '<li><a class="curent">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['uri_segment'] = 7; // xác định segment chứa page number 
                $config['page_query_string'] = TRUE;
                $this->pagination->initialize($config);
                $offset= '';
                if(isset($_GET['per_page'])) $offset = $_GET['per_page'];
                //$data['pro_price'] = $this->Home_m->get_pro_price($config['per_page'],$offset);
                $data['tops'] = $this->Home_m->get_pro_new($config['per_page'],$offset);                
        $this->template->write_view('home_page', 'home/pro_new',$data,true);
	$this->template->render();
    }
}