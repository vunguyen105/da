<?php

class AdminDashboard extends dashboard{

    function __construct() {
        parent::__construct();
        if($this->is_login()== false) redirect('home_page/login');
        if($this->session->userdata['role'] = 1) redirect('home_page');
    }
    public function index() {
        $this->template->render();
    }
    public function create_user() {
        
        $this->template->write('title', 'Tạo tài khoản mới');
        $this->template->write('desption', 'Tạo tài khoản mới');
        $this->template->add_title('Tạo Tài Khoản');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user', 'user', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Tên', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('cpassword', 'Nhập lại mật khẩu', 'trim|required|matches[password]');
        
        if($this->form_validation->run()==false){
                //$this->load->view('user/create_user');
                $this->template->write_view('content', 'user/create_user','',true);
        }
            else
            { 
                    $this->load->model('dashboard_m');
                    //$data['fromdate'] = date('Y-m-d H:i(worry)', strtotime($data['fromdate']));
                    //$date = 'TO_DATE('.$data['fromdate'].', yyyy-mm-DD HH24:MI:SS)';
                    $new_member_insert_data = array(
                            'USRID' => 29,
                            'USRNM' => $this->input->post('user'),
                            'ROLE_ID' => $this->input->post('role'),
                            'FULL_NAME' => $this->input->post('lastname'),
                            'EMAIL' => $this->input->post('email'),
                            'PASS_WORD' => md5($this->input->post('password')),
                            'STATUS' => $this->input->post('role'),
                            'CREATE_USR' =>  '8/3/2013',//$date,
                            'MOBILE' => '01674650860'                            
                        );
                    if($this->dashboard_m->create_user($new_member_insert_data))
                    {                        
                            $data['main_content'] = 'successful';
                            redirect('dashboard/viewAll_user');
                    }
                    else
                    {
                            $this->template->write_view('content', 'user/create_user','',true);
                    }
            }
        
        $this->template->render();
    }
    
    function viewAll_user() {
        $this->template->write('title', 'Thống kê giao dịch');
        $this->template->write('desption', 'Thống kê giao dịch');
        $this->load->model('dashboard_m');
        $data['users']=$this->dashboard_m->getAll_user();
        $this->template->write_view('content', 'user/viewAll_user',$data,true);
        $this->template->render();
    }
    
    public function create_partner() {
        $this->template->write('title', 'Tạo đối tác mới');
        $this->template->write('desption', 'Tạo đối tác mới');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('partnername', 'Đối tấc', 'trim|required');
        $this->form_validation->set_rules('timemax', 'Số ngày đảo', 'trim|required');
       
        if($this->form_validation->run()==false){
                $this->template->write_view('content', 'user/create_partner','',true);
                //$this->load->view('user/create_partner');
        }
            else
            { 
                    $this->load->model('dashboard_m');
                    $new_partner_insert_data = array(
                            'PARTNERID' => Bin2hex_8(),
                            'PARTNERNAME' => $this->input->post('partnername'),
                            'PARTNERKEY' => Bin2hex_24(),
                            'PARTNERCODE' => Bin2hex_10(),
                            'PSTATUS' => 'A',
                            'CREATE_DATE' =>  '20/12/2013',//date("YmdHis"),
                            'NUMDAYFORREVERT' => $this->input->post('timemax')
                        );
                    if($this->dashboard_m->create_partner($new_partner_insert_data))
                    {                        
                            $data['main_content'] = 'successful';
                            redirect('dashboard/viewAll_partner');
                    }
                    else
                    {
                            $this->template->write_view('content', 'user/create_partner','',true);
                    }
            }
         $this->template->render();
        //$this->load->view('user/create_user');
    }

    function viewAll_partner() {
        $this->template->write('title', 'Thống kê giao dịch');
        $this->template->write('desption', 'Thống kê giao dịch');
        $this->load->model('dashboard_m');
        $data['partners']=$this->dashboard_m->getAll_partner();
        $this->template->write_view('content', 'user/viewAll_partner',$data,true);
        //$this->load->view('user/viewAll_partner',$data);
        $this->template->render();
    }
    
    public function delete_user($user_id){
        $this->load->model('dashboard_m');
        $this->dashboard_m->delete_user($user_id);
        redirect('dashboard/viewAll_user','refresh');
    }
    
    public function delete_partner($partner_id){
        $this->load->model('dashboard_m');
        $this->dashboard_m->delete_partner($partner_id);
        redirect('dashboard/viewAll_partner','refresh');
    }
    
    function triplsDes(){
        $this->load->view('user/test');
    }
    function edit_user($id = NULL){
        $this->template->write('title', 'Sửa tài khoản');
        $this->template->write('desption', 'Sửa tài khoản mới');
        
        if($id != NULL)
        {
            $this->load->model('dashboard_m');
            $data['user']=$this->dashboard_m->getAll_user($id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user', 'user', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Tên', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|min_length[4]|max_length[32]');
            $this->form_validation->set_rules('cpassword', 'Nhập lại mật khẩu', 'trim|required|matches[password]');

            if($this->form_validation->run()==false){
                $this->template->write_view('content', 'user/edit_user',array('data'=>$data),true);    
             //   $this->load->view('user/edit_user',array('data'=>$data));
            }
                else
                { 
                        $this->load->model('dashboard_m');
                        //$data['fromdate'] = date('Y-m-d H:i(worry)', strtotime($data['fromdate']));
                        //$date = 'TO_DATE('.$data['fromdate'].', yyyy-mm-DD HH24:MI:SS)';
                        $new_data = array(
                                'USRNM' => $this->input->post('user'),
                                'ROLE_ID' => $this->input->post('role'),
                                'FULL_NAME' => $this->input->post('lastname'),
                                'EMAIL' => $this->input->post('email'),
                                'PASS_WORD' => md5($this->input->post('password')),
                                'STATUS' => $this->input->post('role'),
                                'CREATE_USR' =>  '8/3/2013',//$date,
                                'MOBILE' => '01674650860'                            
                            );
                       // $this->db->where('USRID', $id);
                        //$this->db->update('TBL_ADMIN', $new_data);

                        if($this->dashboard_m->edit_user($new_data,$id))
                        {         
                                $data['main_content'] = 'successful';
                                redirect('dashboard/viewAll_user');
                        }
                        else
                        {
                                //$this->load->view('user/edit_user');
                        }
                       // $this->load->view('user/edit_user',array('data'=>$data));
                }
            //$this->load->view('user/edit_user',array('data'=>$data));
        }
        else
         $this->template->write_view('content', 'user/edit_user',true);    
         $this->template->render();  
    }
    function edit_partner($id = NULL){      
        $this->template->write('title', 'Chỉnh sửa giao dịch');
        $this->template->write('desption', 'Chỉnh sửa giao dịch');
        if($id != NULL)
        {   
            $this->load->model('dashboard_m'); 
            $data['partner'] = $this->dashboard_m->getAll_partner($id);
            $this->load->library('form_validation');
            $this->form_validation->set_rules('partnername', 'Đối tấc', 'trim|required');
            $this->form_validation->set_rules('timemax', 'Số ngày đảo', 'trim|required');

            if($this->form_validation->run()==false){
                    $this->template->write_view('content', 'user/edit_partner',array('data'=>$data),true);
            }
                else
                { 
                        $this->load->model('dashboard_m');
                        $new_data_update = array(
                                'PARTNERNAME' => $this->input->post('partnername'),
                                'PSTATUS' => 'A',
                                'CREATE_DATE' =>  '20/12/2013',//date("YmdHis"),
                                'NUMDAYFORREVERT' => $this->input->post('timemax')
                            );
                        if($this->dashboard_m->edit_partner($new_data_update,$id))
                        {                        
                                $data['main_content'] = 'successful';
                                redirect('dashboard/viewAll_partner');
                        }
                        else
                        {
                                //$this->load->view('user/create_partner');
                        }
                     //$this->load->view('user/edit_partner',array('data'=>$data));
                }
             //$this->load->view('user/edit_partner',array('data'=>$data));
        }
        else
        $this->template->write_view('content', 'user/edit_partner','',true);
        $this->template->render();
       
    }
    
    function search_partner(){
        $this->template->write('title', 'Tìm kiếm giao dịch');
        $this->template->write('desption', 'Tìm kiếm giao dịch');
        if(isset($_POST['tranid']))
            {
                $this->template->write('title', 'Tìm kiếm giao dịch');
                $this->template->write('desption', 'Tìm kiếm giao dịch');  
                $tranid = $this->input->post('tranid');
                $this->load->model('dashboard_m');
                $data['transaction'] = $this->dashboard_m->search_partner($tranid);
                $this->template->write_view('content', 'user/search_partner',array('data'=>$data),true);
            }
        else 
            $this->template->write_view('content', 'user/search_partner','',true);
            $this->template->render();  
    }
    
     function search_partner_date(){
         
        $data_view = array();
        if(isset($_POST['start_date']) && !empty($_POST['start_date'])){   
               $timestamp_start = strtotime($_POST['start_date']);
               $timestamp_end = strtotime($_POST['end_date']);
               isset($_POST['start_date']) ? $view_data['start_date'] = date('Y-m-d H:i:s', $timestamp_start):$view_data['start_date'] = NULL;
               isset($_POST['end_date']) ? $view_data['end_date'] = date('Y-m-d H:i:s', $timestamp_end): $view_data['end_date'] = NULL;
               $this->load->model('dashboard_m');
               $data_view['transaction'] = $this->dashboard_m->search_partner_date($view_data['start_date'],$view_data['end_date']);
        }
        
        $this->template->write('title', 'Tìm kiếm giao dịch');
        $this->template->write('desption', 'Tìm kiếm giao dịch');
        $this->template->write_view('content', 'user/search_partner_date',array('data'=>$data_view),true);
        $this->template->render();  
     }
     
}
