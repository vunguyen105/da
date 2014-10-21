<?php

class dashboard extends Backend_Controller {

    public $new_nested_set;

    function __construct() {
        parent::__construct();
        if ($this->is_login() == false)
            redirect('home/login');
    }

    public function index() {
        $this->load->driver('cache');
        $this->template->add_title('Dashboard');
        //$this->load->model('bid_m');
        //$data['users'] = $this->bid_m->get();
        //var_dump($users);die;
        //$this->cache->file->save("bid",$data['users'],100);
        //$user = $this->cache->file->get("bid");
        //var_dump($user[3]);die;
        //$id_bidxx = $this->cache->get_metadata('bid');
        //var_dump($id_bidxx);die;
        //echo json_encode($user);die;
        //var_dump($user);
        //$this->output->set_header('Content-type: application/json');
        //$this->output->set_output(json_encode($data['users']));die;
        $this->template->write_view('content', 'users/view_user', '', true);
        $this->template->render();
    }

    public function user() {
        $this->template->add_title('Thống kê tài khoản');
        $this->template->write('title', 'Thống kê tài khoản');
        $this->template->write('desption', 'Thống kê tài khoản');
        $this->load->model('user_m');
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "dashboard/user?";
        $config['per_page'] = PERPAGA;
        if ($this->input->is_ajax_request()) {
            $data['start'] = ($this->input->get('page') == FALSE) ? 0 : (int) $this->input->get('page');
            $data['count'] = $config['total_rows'] = $this->user_m->get(FALSE, TRUE);
            $this->user_m->set_start($data['start']);
            $data['users'] = $this->user_m->get();
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $ajax = $this->load->view('users/user_ajax_index', $data, true);
            echo $ajax;
        } else {
            $data['count'] = $config['total_rows'] = $this->user_m->get(FALSE, TRUE);
            //$data['start'] = 0;
            $this->user_m->set_start();
            $data['users'] = $this->user_m->get();
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $this->template->write_view('content', 'users/view', $data, true);
            $this->template->render();
        }
    }

    public function edit_user($id) {
        if ($id) {
            $this->data['user'] = $this->user_m->get($id);
            $this->template->add_title('Sửa tài khoản');
            $this->template->write('title', '');
            $this->template->write('desption', 'Sửa tài khoản');

            count($this->data['user']) || $this->data['errors'][] = 'User could not be found';
            $this->template->write_view('content', 'users/edit', $this->data, true);
            $this->template->render();
        } else {
            redirect('dashboard');
        }
    }

    public function create_user() {
        if (!$this->input->is_ajax_request()) {
            $rules = $this->user_m->rules_create;
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == true) {
                //die('XXXXXXXXXXX');
                $this->load->model('dashboard_m');
                $date = date('d-m-Y H:i:s');
                // $date = date('d-m-Y H:i:s', strtotime($today));
                //$data['fromdate'] = date('Y-m-d H:i(worry)', strtotime($data['fromdate']));
                //$date = 'TO_DATE('.$data['fromdate'].', yyyy-mm-DD HH24:MI:SS)';
                $new_member_insert_data = array(
                    'USRNM' => $this->input->post('user'),
                    'ROLE_ID' => $this->input->post('role'),
                    'FULL_NAME' => $this->input->post('lastname'),
                    'EMAIL' => $this->input->post('email'),
                    'PASS_WORD' => md5($this->input->post('password')),
                    'STATUS' => $this->input->post('role'),
                        //'CREATE_USR' =>  $date,
                        //'MOBILE' => '01674650860'                            
                );
                if ($this->dashboard_m->create_user($new_member_insert_data, $date)) {
                    $data['main_content'] = 'successful';
                    redirect('dashboard/viewAll_user');
                } else {
                    redirect('dashboard/create_user', 'refresh');
                }
            }
            //echo validation_errors();die;
            //echo "<pre>"; var_dump(form_error('email','',''));die;
            //echo var_dump(form_error_json('lastname'));
            //if(form_error_json('lastname') == null) echo  "hahahaha";
            echo (form_error_json('password'));
            echo (form_error_json());
            //echo (form_error_json('user'));
            //echo (form_error_json('cpassword'));
            //die;
//            echo json_encode(form_error_json('lastname'));
//            echo json_encode(form_error_json('password'));
//            echo json_encode(form_error_json('email'));
//            echo json_encode(form_error_json('user'));
//            echo json_encode(form_error_json('cpassword'));die;
            //echo validation_errors('<div class="alert alert-error">','</div>');
            //echo 'xxx';
            //die;
        }

        $this->template->write('title', 'Tạo tài khoản mới');
        $this->template->write('desption', 'Tạo tài khoản mới');
        $data['tuan'] = 'xxxx';
        $this->template->add_title('Tạo Tài Khoản');
        $this->template->write_view('content', 'users/create_user', $data, true);
        //$this->load->view('users/create_user',$data);
        $this->template->render();
    }

    public function create_partner() {
        $this->template->write('title', 'Tạo partner mới');
        $this->template->write('desption', 'Tạo partner mới');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('partnername', 'Đối tấc', 'trim|required');
        $this->form_validation->set_rules('timemax', 'Thời hạn đảo', 'trim|required|numeric|is_natural]');
        $this->form_validation->set_rules('Idpartner', 'Mã Đối tấc', 'trim|required|callback_checkIdpartner');

        if ($this->form_validation->run() == false) {
            $this->template->write_view('content', 'user/create_partner', '', true);
            //$this->load->view('user/create_partner');
        } else {
            $this->load->model('dashboard_m');
            $date = date('d-m-Y H:i:s');
            //$date = date('d-m-Y H:i:s', strtotime($today));
            $this->load->model('dashboard_m');
            $new_partner_insert_data = array(
                'PARTNERID' => $this->input->post('Idpartner'),
                'PARTNERNAME' => $this->input->post('partnername'),
                'PARTNERKEY' => Bin2hex_24(),
                'PARTNERCODE' => Bin2hex_10(),
                'PSTATUS' => 'A',
                //'HASH_PWD' => $this->input->post('mk'),
                //'CREATE_DATE' =>  "to_date('2003/05/03 21:02:44', 'yyyy/mm/dd hh24:mi:ss')",
                'NUMDAYFORREVERT' => $this->input->post('timemax')
            );
            if ($this->dashboard_m->create_partner($new_partner_insert_data, $date)) {
                $data['main_content'] = 'successful';
                redirect('dashboard/viewAll_partner');
            } else {
                $this->template->write_view('content', 'user/create_partner', '', true);
            }
        }
        $this->template->render();
        //$this->load->view('user/create_user');
    }

    public function delete_user($user_id) {
        $this->load->model('dashboard_m');
        $xxx = $this->dashboard_m->delete_user($user_id);
        var_dump($xxx);
        die;
        redirect('dashboard/viewAll_user', 'refresh');
    }

    public function delete_partner($partner_id) {
        $this->load->model('dashboard_m');
        $xxx = $this->dashboard_m->delete_partner($partner_id);
        var_dump($xxx);
        die;
        redirect('dashboard/viewAll_partner', 'refresh');
    }

    function test() {
        //$this->load->model('category_m');
        // $xxx = $this->category_m->hix(); echo "<br>";
        //$this->load->model('test_m');
        //$aaa = $this->test_m->my_model_method2();
        //$this->load->library('Nested_set');
        $this->load->library('Nested_set');
        $this->new_nested_set = new Nested_set();
        $this->new_nested_set->setControlParams('nested_set_tree','lft','rgt','id','parent_id','name');
        $nodes =  array(
            'id'=> 1,
            'rgt' =>  15,
            'lft' => 0
            );
        // load memu
        $root_nodes1 = $this->new_nested_set->getSubTree($nodes);    
        $root_nodes2 = $this->new_nested_set->buildMenu(1, $root_nodes1);  
        
        
        
        //$root_nodes2 = $this->new_nested_set->getSubTreeAsHTML($nodes);  
        //$root_nodes2 = $this->new_nested_set->getTreeAsHTML();
        //$root_nodes2 = $this->new_nested_set->getPath($nodes);
        //$root_nodes2 = $this->new_nested_set->getSubTreeAsHTML($nodes);   
        //$root_nodes1 = $this->new_nested_set->getAncestor($nodes);     
       // echo "<pre>";
                echo ($root_nodes2);die;
        
        //$xx  = $this->nested_set->tests();echo $xx;
//       $this->new_nested_set->setControlParams('nested_menu','lft','rgt','id','parents','name');
  //      $this->nested_set->setControlParams('nested_set_tree');
        // $this->new_nested_set->setControlParams('nested_set_tree2');
        // $this->new_nested_set->setControlParams('nested_set_tree');
        //$root_nodes1 = $this->new_nested_set->getNodeFromId(4);
//        $this->new_nested_set->appendNewChild($parentNode = array(
//            'id'=> 8,
//            'rgt' =>  9,
//            'lft' => 8,
//        ),$extrafields = array('name'=>'nguyen'));
        // $this->nested_set->setControlParams('nested_set_tree2');
        //$root_nodes2 = $this->nested_set->getRootNodes();
        //echo "<pre>";var_dump($root_nodes1);
    }

    function edit_user2($id = NULL) {
        $this->template->write('title', 'Sửa tài khoản');
        $this->template->write('desption', 'Sửa tài khoản mới');

        if ($id != NULL) {
            $this->load->model('dashboard_m');
            $data['user'] = $this->dashboard_m->getAll_user((int) ($id));

            $this->load->library('form_validation');
            $this->form_validation->set_rules('user', 'user', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Tên', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Mật khẩu', 'trim|required|min_length[4]|max_length[32]');
            $this->form_validation->set_rules('cpassword', 'Nhập lại mật khẩu', 'trim|required|matches[password]');

            if ($this->form_validation->run() == false) {
                $this->template->write_view('content', 'user/edit_user', array('data' => $data), true);
                //   $this->load->view('user/edit_user',array('data'=>$data));
            } else {
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
                    'MOBILE' => '01674650860'
                );
                // $this->db->where('USRID', $id);
                //$this->db->update('TBL_ADMIN', $new_data);

                if ($this->dashboard_m->edit_user($new_data, $id)) {
                    $data['main_content'] = 'successful';
                    redirect('dashboard/viewAll_user');
                } else {
                    //$this->load->view('user/edit_user');
                }
                // $this->load->view('user/edit_user',array('data'=>$data));
            }
            //$this->load->view('user/edit_user',array('data'=>$data));
        }
        else
            $this->template->write_view('content', 'user/edit_user', true);
        $this->template->render();
    }

    function edit_partner($id = NULL) {
        $data = array();

        $this->template->write('title', 'Chỉnh sửa Partner');
        $this->template->write('desption', 'Chỉnh sửa Partner');
        //var_dump($id);
        if ($id != NULL) {
            $this->load->model('dashboard_m');
            $data['partner'] = $this->dashboard_m->getAll_partner($id);
            //var_dump($data['partner']); die();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('partnername', 'Đối tấc', 'trim|required');
            $this->form_validation->set_rules('timemax', 'Số ngày đảo', 'trim|required');

            if ($this->form_validation->run() == false) {
                $this->template->write_view('content', 'user/edit_partner', array('data' => $data), true);
            } else {
                if (isset($_POST['partnername'])) {
                    (isset($_POST['code']) && $_POST['code'] == 'on') ? $code = Bin2hex_8() : $code = NULL;
                    (isset($_POST['key']) && $_POST['key'] == 'on') ? $key = Bin2hex_24() : $key = NULL;
                    //var_dump($this->input->post('statut')); die;
                }
                $this->load->model('dashboard_m');
                $new_data_update = array(
                    'PARTNERNAME' => $this->input->post('partnername'),
                    'PSTATUS' => 'A',
                    'NUMDAYFORREVERT' => $this->input->post('timemax'),
                    'PSTATUS' => $this->input->post('statut'),
                );
                if ($code != NULL)
                    $new_data_update['PARTNERCODE'] = $code;
                if ($key != NULL)
                    $new_data_update['PARTNERKEY'] = $key;
                //var_dump($new_data_update);die();
                if ($this->dashboard_m->edit_partner($new_data_update, $id)) {
                    $data['main_content'] = 'successful';
                    redirect('dashboard/viewAll_partner');
                } else {
                    //$this->load->view('user/create_partner');
                }
                //$this->load->view('user/edit_partner',array('data'=>$data));
            }
            //$this->load->view('user/edit_partner',array('data'=>$data));
        }
        else
            $this->template->write_view('content', 'user/edit_partner', '', true);
        $this->template->render();
    }

    function search_partner() {
        $this->template->write('title', 'Tìm kiếm giao dịch');
        $this->template->write('desption', 'Tìm kiếm giao dịch');
        if (isset($_POST['tranid'])) {
            $tranid = $this->input->post('tranid');
            $this->load->model('dashboard_m');
            $data['transaction'] = $this->dashboard_m->search_partner_xxx($tranid);
            $this->template->write_view('content', 'user/search_partner', array('data' => $data), true);
        }
        else
            $this->template->write_view('content', 'user/search_partner', '', true);
        $this->template->render();
    }

    function search_partner_date() {
//         $today = date('d-m-Y');
//        $stop_date = date('Y-m-d H:i:s', strtotime($today . ' + 1 day'));
//        echo $today.'<br/>';
//        echo $stop_date.'<br/>';;
        $data_view = array();
        $this->load->model('dashboard_m');
        $data_view['partner'] = $this->dashboard_m->getPartner();
        if (isset($_POST['start_date']) && !empty($_POST['start_date'])) {
            $timestamp_start = strtotime($_POST['start_date']);
            $timestamp_end = strtotime($_POST['end_date'] . ' + 1 day');
            isset($_POST['start_date']) ? $view_data['start_date'] = date('Ymd', $timestamp_start) : $view_data['start_date'] = NULL;
            isset($_POST['end_date']) ? $view_data['end_date'] = date('Ymd', $timestamp_end) : $view_data['end_date'] = NULL;
            (isset($_POST['partnerId']) && $_POST['partnerId'] != '') ? $partnerId = $_POST['partnerId'] : $partnerId = NULL;
            (isset($_POST['source_user_id']) && $_POST['source_user_id'] != '') ? $user = $_POST['source_user_id'] : $user = NULL;
            //var_dump($view_data['end_date']);
            //$id_p = 'EPAY1111';
            //$data_view['user_partner'] =$this->dashboard_m->getUserPartner($id_p);
            //var_dump($data_view['user_partner']);
            $data_view['transaction'] = $this->dashboard_m->search_partner_date($view_data['start_date'], $view_data['end_date'], $partnerId, $user);
            //var_dump($data_view['transaction']); die();
        }

        $this->template->write('title', 'Tìm kiếm giao dịch');
        $this->template->write('desption', 'Tìm kiếm giao dịch');
        $this->template->write_view('content', 'user/search_partner_date', array('data' => $data_view), true);
        $this->template->render();
    }

    function checkIdpartner($id) {
        $this->load->database();
        $this->db->from('TBL_PARTNERS');
        $this->db->where('PARTNERID', $id);
        $q = $this->db->get()->result();
        if (!empty($q)) {
            $this->form_validation->set_message('checkIdpartner', 'Trùng mã đối tác vui lòng nhập lại');
            return false;
        }
        return true;
    }

    function _checkuser($user) {
        $this->load->database();
        $this->db->from('TBL_ADMIN');
        $this->db->where('USRNM', $user);
        $q = $this->db->get()->result();
        if (!empty($q)) {
            $this->form_validation->set_message('checkuser', 'Tài khoản đã tồn tại!');
            return false;
        }
        return true;
    }

    function _checkemail($email) {
        $this->load->database();
        $this->db->from('TBL_ADMIN');
        $this->db->where('EMAIL', $email);
        $q = $this->db->get()->result();
        if (!empty($q)) {
            $this->form_validation->set_message('_checkemail', 'Email đã được đăng ký!');
            return false;
        }
        return true;
    }

}