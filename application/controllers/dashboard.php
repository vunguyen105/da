<?php

class dashboard extends Backend_Controller {

    public $new_nested_set;

    function __construct() {
        parent::__construct();
//        if ($this->is_login() == false)
//            redirect('home/login');
        $this->load->library('session');
        $this->load->library('category_lib');
        $this->new_nested_set = $this->category_lib->category_initialize();
    }

    public function category_update() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $nodes = array(
                'id' => $post['id'],
                'rgt' => $post['right'],
                'lft' => $post['left']
            );
            $name = array('name' => $post['name']);
            $this->load->model('category_m');
            $return = $this->category_m->save($name, TRUE, FALSE, $nodes);
            die;
        }
    }

    public function index() {
        //echo base_url();die;
        $DB2 = $this->load->database('forum', TRUE);
        //$sql = 'SELECT *  FROM user';
        $query = $DB2->get("user");
        $q = $query->result_array(); 
       // $xxx = $DB2->query($sql);
        var_dump($q);die;
        $this->template->add_title('Dashboard');
        $this->template->write_view('content', 'users/view_user', '', true);
        $this->template->render();
    }

    public function category_del() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $node = array(
                'id' => $post['id'],
                'rgt' => $post['right'],
                'lft' => $post['left'],
            );
            $this->new_nested_set->deleteNode($node);
            $menu = $this->new_nested_set->build_menu($post['menu_id']);
            echo $menu;
        }
    }

    public function category_add() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $nodes = array(
                'id' => $post['id'],
                'rgt' => $post['left'],
                'lft' => $post['right'],
                    //'parent_id' => 0
            );
            $return = $this->new_nested_set->appendNewChild($nodes, array('name' => $post['name']));
            $menu = $this->new_nested_set->build_menu($post['menu_id']);
            echo $menu;
            die;
        }
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
            //echo "<pre>";     var_dump($data['users']);die;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $ajax = $this->load->view('user/user_ajax_index', $data, true);
            echo $ajax;
        } else {
            $data['count'] = $config['total_rows'] = $this->user_m->get(FALSE, TRUE);
            //echo "<pre>";     var_dump($data['count']);die;
            //$data['start'] = 0;
            $this->user_m->set_start();
            $data['users'] = $this->user_m->get(); //echo "<pre>";     var_dump($data['users']);die;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $this->template->write_view('content', 'user/view', $data, true);
            $this->template->render();
        }
    }

    public function userxxx() {
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
            //var_dump($data['count']);die;
            //$data['start'] = 0;
            $this->user_m->set_start();
            $data['users'] = $this->user_m->get();
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $this->template->write_view('content', 'users/view', $data, true);
            $this->template->render();
        }
    }

    function test() {
        $nodes = $this->new_nested_set->getNodeFromId(1);
//        $nodes = array(
//            'id' => 1,
//            'rgt' => 15,
//            'lft' => 0
//        );
        // load memu
        $root_nodes1 = $this->new_nested_set->getSubTree($nodes);
        $root_nodes2 = $this->new_nested_set->buildMenu(1, $root_nodes1);

        //$root_nodes2 = $this->new_nested_set->getSubTreeAsHTML($nodes);
        //$root_nodes2 = $this->new_nested_set->getTreeAsHTML();
        //$root_nodes2 = $this->new_nested_set->getPath($nodes);
        //$root_nodes2 = $this->new_nested_set->getSubTreeAsHTML($nodes);
        //$root_nodes1 = $this->new_nested_set->getAncestor($nodes);
        // echo "<pre>";
        echo ($root_nodes2);
        die;

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

    public function category_move() {
        if ($this->input->is_ajax_request()) {
            $list = $this->input->post('tmp');
            $id_menu = (int) $this->input->post('id_menu');
            $nodes = $this->new_nested_set->getNodeFromId($id_menu);
            $root_nodes1 = $this->new_nested_set->getSubTree($nodes);
            $item_old = $this->new_nested_set->Item_List_Node($id_menu, $root_nodes1);
            $root_nodes = $this->new_nested_set->getSubTree_int($nodes);
            $parents_old = $root_nodes['parents'];
            $list_item_parent = json_decode($list, true);
            $parents_new = $this->category_lib->multiarray_children($list_item_parent, $id_menu);
            $item_new = $this->category_lib->multiarray_values($list_item_parent, 'id');
            $khac = $this->category_lib->compare($item_old, $item_new);
            if ($khac != false) {
                $parents_compare = $this->category_lib->parents_compare($parents_old, $parents_new, $khac, $item_new);
                $update = $this->category_lib->update_cat($parents_compare);
                $nodes = $this->new_nested_set->getNodeFromId($update['id']);
                if (isset($update['parents'])) {
                    $target = $this->new_nested_set->getNodeFromId($update['parents']);
                    $this->new_nested_set->setNodeAsFirstChild($nodes, $target);
                }
                if (isset($update['next'])) {
                    $target = $this->new_nested_set->getNodeFromId($update['next']);
                    $this->new_nested_set->setNodeAsNextSibling($nodes, $target);
                }
            } else {
                unset($parents_old['0']);
                $tuan = $this->category_lib->children_compare($parents_old, $parents_new, $item_old);
                if (isset($tuan["parent"])) {
                    $nodes = $this->new_nested_set->getNodeFromId($tuan["id"]['0']);
                    $target = $this->new_nested_set->getNodeFromId($tuan["parent"]);
                    $this->new_nested_set->setNodeAsFirstChild($nodes, $target);
                }
                if (isset($tuan["next"])) {
                    $nodes = $this->new_nested_set->getNodeFromId($tuan["id"]['0']);
                    $target = $this->new_nested_set->getNodeFromId($tuan["next"]);
                    $this->new_nested_set->setNodeAsNextSibling($nodes, $target);
                }
            }
            $nodes = $this->new_nested_set->getNodeFromId($id_menu);
            $root_nodes1 = $this->new_nested_set->getSubTree($nodes);
            $class = array('ol' => 'dd-list', 'li' => 'dd-item', 'div' => 'dd-handle');
            $data['menu'] = $this->new_nested_set->Menu_Bootstrap($id_menu, $root_nodes1, $class);
            echo $data['menu'];
            die;
        }
    }

    public function category() {
        $this->template->add_title('Quản lý thư mục');
        $this->template->write('title', 'Quản lý thư mục');
        $this->template->write('desption', 'Quản lý thư mục');
        $data['subs'] = $this->new_nested_set->getChildOfTree();
        //var_dump($data['subs'][0]['id']);die;
        if (isset($data['subs'][0])) {
            $data['sub_menu'] = $this->new_nested_set->build_menu($data['subs'][0]['id']);
        }
        //var_dump($data['subs']);die;
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
        $this->template->write_view('content', 'category/view_category', $data, true);
        $this->template->render();
    }

    public function testxxx() {
        $data['subs'] = $this->new_nested_set->getChildOfTree();
        var_dump($data['subs']);die;
        if (isset($data['subs'][0])) {
            $data['sub_menu'] = $this->new_nested_set->build_menu($data['subs'][0]['id']);
        }
        $this->template->write_view('content', 'users/testxxx', '', true);
        $this->template->render();
    }

    public function menu_new() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $sub_menu = $this->new_nested_set->getRootNodes();
            $return = $this->new_nested_set->insertNewTree(array('name' => $post['name']));
            $data['subs'] = $this->new_nested_set->build_sub_menu();
            echo $data['subs'];
            die;
        }
    }

    public function create_user() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $insert = array(
                'username' => $post['username'],
                'password' => md5($post['password']),
                'firstname' => $post['firstname'],
                'lastname' => $post['lastname'],
                'email' => $post['email'],
                'address' => $post['address'],
            );
            $this->load->model('user_m');
            $return = $this->user_m->save($insert);
            if ($return != FALSE)
                echo json_encode(array('stt' => true));
            else
                echo json_encode(array('stt' => FALSE));
        }
    }

    public function edit_user() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $insert = array(
                'name' => $post['lastname'],
                'username' => $post['user'],
            );
            $this->load->model('user_m');
            // $return = $this->user_m->save($insert);
            if ($return != FALSE)
                echo json_encode(array('stt' => true));
            else
                echo json_encode(array('stt' => FALSE));
        }
    }

    public function user_edit() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $update = array(
                'username' => $post['username'],
                'password' => md5($post['password']),
                'firstname' => $post['firstname'],
                'lastname' => $post['lastname'],
                'email' => $post['email'],
                'address' => $post['address'],
            );
            $id = (int) $post['id'];
            //var_dump($id);die;
            $this->load->model('user_m');
            $return = $this->user_m->save($update, $id, FALSE);
            //var_dump($return);die;
            if ($return != FALSE) {
                $user_update = $this->user_m->get($return);
                echo json_encode($user_update);
                die;
            } else
                echo json_encode(array('stt' => FALSE));
        }
    }

    public function create_userxxx() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $insert = array(
                'name' => $post['lastname'],
                'username' => $post['user'],
            );
            $this->load->model('user_m');
            $return = $this->user_m->save($insert);
            if ($return != FALSE)
                echo json_encode(array('stt' => true));
            else
                echo json_encode(array('stt' => FALSE));
        }
    }

    public function edit_userxxx() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $insert = array(
                'name' => $post['lastname'],
                'username' => $post['user'],
            );
            $this->load->model('user_m');
            // $return = $this->user_m->save($insert);
            if ($return != FALSE)
                echo json_encode(array('stt' => true));
            else
                echo json_encode(array('stt' => FALSE));
        }
    }

    public function user_del() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('user_m');
            $id = $this->input->post('id');
            $return = $this->user_m->delete($id);
            if ($return) {
                $post = $this->input->post();
                //echo "<pre>";var_dump($post);die;
                $this->load->library('pagination');
                $config['per_page'] = PERPAGA;
                $start = (((int)($this->input->post('page')) - 1) * (int) (PERPAGA))+1;
                $config['base_url'] = base_url() . "dashboard/user_del?";
                $data['count'] = $config['total_rows'] = $this->user_m->get(FALSE, TRUE);
                $this->user_m->set_start($start);
                $data['users'] = $this->user_m->get();
                $this->pagination->initialize($config);
                $data['pagination'] = $this->pagination->create_links();
                $ajax = $this->load->view('users/user_ajax_index', $data, true);
                echo $ajax;
            }
        }
    }

    public function user_editxxxx() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $update = array(
                'name' => $post['lastname'],
                'username' => $post['user'],
            );
            $id = (int) $post['id'];
            $this->load->model('user_m');
            $return = $this->user_m->save($update, $id, FALSE);
            if ($return != FALSE) {
                $user_update = $this->user_m->get($return);
                echo json_encode($user_update);
                die;
            } else
                echo json_encode(array('stt' => FALSE));
        }
    }

    public function category_load_menu() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post(); //var_dump($post);die;
            $menu = $this->new_nested_set->build_menu($post['id']);
            //            var_dump($menu);die;
            echo $menu;
            die;
        }
    }

    public function category_load() {
        if ($this->input->is_ajax_request()) {
            $data['subs'] = $this->new_nested_set->build_sub_menu();
            echo $data['subs'];
            die;
        }
    }

    public function children_new() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $data = array(
                'name' => $post['name']
            );
            $nodes = array(
                'id' => (int) $post['id'],
                'rgt' => (int) $post['right'],
                'lft' => (int) $post['left']
            );
            $node = $this->new_nested_set->appendNewChild($nodes, $data);
            $menu = $this->new_nested_set->build_menu($post['id']);
            echo $menu;
            die;
        }
    }

    public function menu_del() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $node = array(
                'id' => $post['id'],
                'rgt' => $post['right'],
                'lft' => $post['left'],
            );
            $this->new_nested_set->deleteNode($node);
            $data['subs'] = $this->new_nested_set->build_sub_menu();
            echo $data['subs'];
            die;
        }
    }

    public function product_create() {
        if ($this->input->is_ajax_request()) {
            //var_dump($_POST);die;
            $post = $this->input->post();
            $pro = array(
                'pro_name' => $post['title'],
                'price' => $post['price'],
                'discounts' => $post['discounts'],
                'baohanh' => $post['baohanh'],
                'description' => $post['descr'],
                'technique' => $post['technique'],
                'cat_id' => $post['cat'],
                'qty' => $post['qty'],
            );
            $this->load->model('product_m');
            $this->db->select_max('proid');
            $id_max = $this->product_m->get();
            //  var_dump($id_max);die;
            if (!empty($post['imgs'])) {
                $image = array();
                foreach ($post['imgs'] as $key => $value) {
                    $img = array(
                        'file_name' => $value,
                        'id_pro' => (int) $id_max[0]['id'],
                    );
                    $image[] = $img;
                }
                $this->load->model('files_m');
                $this->files_m->save($image, FALSE, TRUE);
            }
            $this->product_m->save($pro);
        } else {
            $data = array();
            $this->template->add_title('Quản lý sản phẩm');
            $this->template->write('title', 'Quản lý sản phẩm');
            $this->template->write('desption', 'Quản lý sản phẩm');
            $this->load->helper(array('url', 'editor_helper'));
            $this->load->model('category_m');
            $this->db->order_by('id');
            $this->db->where('parent_id <>', 0);
            $data['cats'] = $this->category_m->get();
            $data['ckediter'] = $this->ckeditor->replace("demo", editerGetEnConfig());
            $data['ckediter1'] = $this->ckeditor->replace("demo1", editerGetEnConfig());
//        $data['ckediter2'] = $this->ckeditor->replace("demo2", editerGetDefaultConfig());
            $this->template->write_view('content', 'product/pro_create', $data, true);
            $this->template->render();
        }
    }

    function product_edit($id) {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $this->load->model('product_m');
            //var_dump($id);die;
            //echo $_POST['id'];die;
            if ($id != NULL) {
                $data['pros'] = $this->product_m->get((int) ($id));
            }
            //echo '<pre>'; var_dump($data['pros']);die;
            $rules = $this->product_m->rules;
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == false) {
                $this->template->write_view('content', 'product/pro_edit', $data, true);
            } else {
                $post = $this->input->post();
                $pro = array(
                    'pro_name' => $post['title'],
                    'price' => $post['price'],
                    'discounts' => $post['discounts'],
                    'baohanh' => $post['baohanh'],
                    'description' => $post['descr'],
                    'technique' => $post['technique'],
                    'cat_id' => $post['cat'],
                    'qty' => $post['qty'],
                );
                if ($this->product_m->save($pro)) {
                    $data['main_content'] = 'successful';
                    redirect('dashboard/product');
                } else {
                    $this->template->write_view('content', 'product/pro_edit', $data, true);
                }
            }
        } else {
            $this->load->model('product_m');
            $data['product'] = $this->product_m->get($id);
            if (!empty($data['product'])) {
                $this->load->model('files_m');
                $data['imgs'] = $this->files_m->get_by('id_pro', $data['product']['proid']);
                //echo '<pre>' ;var_dump($data['imgs']);die;
            }
            $this->template->add_title('Sửa sản phẩm');
            $this->template->write('title', 'Quản lý sản phẩm');
            $this->template->write('desption', 'Quản lý sản phẩm');
            $this->load->helper(array('url', 'editor_helper'));
            $data['ckediter'] = $this->ckeditor->replace("demo", editerGetEnConfig());
            $data['ckediter1'] = $this->ckeditor->replace("demo1", editerGetEnConfig());
            $this->template->write_view('content', 'product/pro_edit', $data, true);
            $this->template->render();
        }
    }
    public function slide_edit($id){
        if($this->input->is_ajax_request()){
            $post = $this->input->post();
            var_dump($post['file_name'][0]);die;
            $slide = array(
                'title' => $post['title'],
                'file_name' => $post['file_name'][0],
                'status' => $post['status'],
            );
            $this->load->model('slide_m');
            $this->slide_m->save($slide);
            redirect('dashboar/slide');
            
        }
        else{
            $this->load->model('slide_m');
            $data['slide'] = $this->slide_m->get($id);
            $this->template->add_title('Sửa slide');
            $this->template->write('title','');
            $this->template->write('desption','Sửa sản phẩm');
            $this->load->helper(array('url','editor_helper'));
            $this->template->write_view('content','slide/slide_edit',$data,TRUE);
            $this->template->render();
            
        }
        
    }
    public function slide_del(){
        if($this->input->is_ajax_request()){
            $post = $this->input->post();
            //var_dump($post);die;
            $this->load->model('slide_m');
            $return =    $this->slide_m->delete($post['id']);
            if($return){
                $this->load->library('pagination');
                $config['base_url'] = base_url()."dashboar/slide_del";
                $config['per_page'] = PERPAGA;
                $config['total_rows'] = $this->slide_m->get(FALSE,TRUE);
                $data['start'] = ($this->input->get('page') == FALSE ) ? 0 : (int)($this->input->get('page'));
                $data['count'] = $config['total_rows'];
                $this->slide_m->set_start($data['start']);
                $data['slide'] = $this->slide_m->get();
                $this->pagination->initialize($config);
                $data['pagination'] = $this->pagination->create_links();
                $ajax = $this->load->view('slide/view',$data, true);
                echo $ajax;
                
            }
            
                   
        }
    }

    public function product() {
        $this->template->add_title('Thống kê sản phẩm');
        $this->template->write('title', 'Thống kê sản phẩm');
        $this->template->write('desption', 'Thống kê sản phẩm');
        $this->load->model('product_m');
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "dashboard/product?";
        $config['per_page'] = PERPAGA;
        if ($this->input->is_ajax_request()) {
            $this->load->model('category_m');
            $this->db->order_by('id');
            $this->db->where('parent_id <>', 0);
            $data['cats'] = $this->category_m->get();
            $data['start'] = ($this->input->get('page') == FALSE) ? 0 : (int) $this->input->get('page');
            $data['count'] = $config['total_rows'] = $this->product_m->get(FALSE, TRUE);
            $this->product_m->set_start($data['start']);
            $data['products'] = $this->product_m->get();
            //echo "<pre>";     var_dump($data['users']);die;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $ajax = $this->load->view('product/view', $data, true);
            echo $ajax;
        } else {
            $data['count'] = $config['total_rows'] = $this->product_m->get(FALSE, TRUE);
            $this->load->model('category_m');
            $this->db->order_by('id');
            $this->db->where('parent_id <>', 0);
            $data['cats'] = $this->category_m->get();
            //echo "<pre>";     var_dump($data['cats']);die;
            //$data['start'] = 0;
            $this->product_m->set_start();
            $data['products'] = $this->product_m->get(); //echo "<pre>";     var_dump($data['users']);die;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $this->template->write_view('content', 'product/view', $data, true);
            $this->template->render();
        }
    }

    public function product_del() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('product_m');
            $id = $this->input->post('id');
            //var_dump($id);die;
            $r = $this->product_m->delete($id);
            if ($r) {
                $this->load->model('files_m');
                //$this->db->where('id_pro',$id);
                //var_dump($id);die;
                $return = $this->files_m->delete_by('id', $id);
                var_dump($return);
                die;
            }
            //var_dump($return);die;
            if ($return) {
                $this->load->model('category_m');
                $this->db->order_by('id');
                $this->db->where('parent_id <>', 0);
                $data['cats'] = $this->category_m->get();
                $this->load->library('pagination');
                $config['per_page'] = PERPAGA;
                $start = ((int) $this->input->post('page') - 1) * (int) PERPAGA;
                $config['base_url'] = base_url() . "dashboard/pro_del?";
                $data['count'] = $config['total_rows'] = $this->product_m->get(FALSE, TRUE);
                $this->product_m->set_start($start);
                $data['products'] = $this->product_m->get();
                $this->pagination->initialize($config);
                $data['pagination'] = $this->pagination->create_links();
                //echo'<pre>';                var_dump($data);die;
                $ajax = $this->load->view('product/view', $data, true);
                echo $ajax;
            }
        }
    }

    //hàm trả về các file đã upload dc lưu trong database
    public function files() {
        $this->load->model("mupload");
        $data['files'] = $this->mupload->get_all_files();
        $this->load->view("files", $data);
    }

    //hàm xử lý việc upload file và xuất thông báo dưới dạng json
    public function upload_file() {
        $status = "";
        $msg = "";
        $post = $this->input->post();
        $tit = $this->input->post("title");
        //var_dump($tit);die;
        if ($tit == NULL) {
            $status = "error";
            $msg = "Please enter your title";
        }
        if ($status != "error") {
            $config['upload_path'] = '.upload';
            $config['allowed_types'] = 'gif|jpg|png|doc|txt';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = TRUE;
            $this->load->library("upload", $config);
            //var_dump($post['imgs']);die;
            //$info = array("file_name" => $post['imgs'],
            //          "title" => $_POST['title']);
            if (!$a = $this->upload->do_upload()) {
                var_dump($a);
                echo 'xxxxxxxxxx';
                $status = "error";
                $msg = $this->upload->display_errors('<p>', '</p>');
                echo $msg;
            } else {
                $this->load->model("mupload");
                $data = $this->upload->data();
                $info = array("file_name" => $post['imgs'],
                    "title" => $_POST['title']);
                $fid = $this->mupload->insert_file($info);
                if ($fid) {
                    $status = "Success";
                    $msg = "File successfully uploaded";
                } else {
                    $status = "error";
                    $msg = "File uploaded fail! PLease try again!";
                }
            }
        }
        Echo json_encode(array("status" => $status,
            "msg" => $msg));
    }

    //hàm xử lý xóa file upload
    public function delete_files($file_id) {
        $this->load->model("mupload");
        if ($this->mupload->delete_file($file_id)) {
            $status = 'success';
            $msg = 'File successfully deleted';
        } else {
            $status = 'error';
            $msg = 'Có chuyện gì đó không ổn đang xảy ra!';
        }
        Echo json_encode(array('status' => $status, 'msg' => $msg));
    }

//    public function upload_file(){
//                if ($this->input->is_ajax_request()){
//                                //var_dump($_POST);
//                                //var_dump($_POST['id']);
//                                //die;
//                                $status='';
//                                $msg='';
//				$config['upload_path'] = './file';
//				$config['allowed_types'] = 'gif|jpg|png|doc|txt';
//				$config['max_size']  = 1024 * 8;
//				$config['encrypt_name'] = TRUE;
//				$this->load->library("upload",$config);
//				if(!$this->upload->do_upload('imgs')){
//					$msg = $this->upload->display_errors('<p>','</p>');
//					echo $msg;
//				}else{
//                                    //var_dump($count);die;
//					$this->load->model("mupload");
//					$data = $this->upload->data();
//					$info = array(
//                                            "file_name" => $post['imgs'],
//                                            //"id_pro" => $_POST['id'],
//                                                      );
//                                        //echo "<pre>";var_dump($info);die;
//					$fid = $this->mupload->insert_file($info);
//					if($fid){
//                                                $this->resize($data['file_name']);
//						$status = "Success";
//						$msg = "Tải ảnh thành công";
//					}else{
//						$status = "error";
//						$msg = "Có chuyện gì đó không ổn đang xảy ra!";
//					}
//			}
//			echo json_encode(array("status" => $status, "msg" => $msg));
//	}
//        else {
//            $data = array();
//            $this->template->add_title('Quản lý sản phẩm');
//            $this->template->write('title', 'Quản lý sản phẩm');
//            $this->template->write('desption', 'Quản lý sản phẩm');
//            $this->load->helper(array('url', 'editor_helper'));
//            $this->load->model('category_m');
//            $this->db->order_by('id');
//            $data['cats'] = $this->category_m->get();
//            $data['ckediter'] = $this->ckeditor->replace("demo", editerGetEnConfig());
////        $data['ckediter2'] = $this->ckeditor->replace("demo2", editerGetDefaultConfig());
//            $this->template->write_view('content', 'welcome_message', $data, true);
//            $this->template->render();
//        }
//    }

    public function news_create() {
        if ($this->input->is_ajax_request()) {
            //var_dump($_POST);die;
            $post = $this->input->post();
//            echo '<pre>';            var_dump($post);die;
            $news = array(
                'name' => $post['title'],
                'description' => $post['descr'],
                'page_id' => $post['page'],
            );
//            echo '<pre>';            var_dump($news);die;
            $this->load->model('news_m');
            $this->news_m->save($news);
        } else {
            $data = array();
            $this->template->add_title('Quản lý tin tức');
            $this->template->write('title', 'Quản lý tin tức');
            $this->template->write('desption', 'Quản lý tin tức');
            $this->load->helper(array('url', 'editor_helper'));
            $this->load->model('pages_m');
            $this->db->order_by('id');
            //$this->db->where('parent_id <>',0);
            $data['pages'] = $this->pages_m->get();
            //echo '<pre>';var_dump($data['pages']);die;
            $data['ckediter'] = $this->ckeditor->replace("demo", editerGetEnConfig());
//        $data['ckediter2'] = $this->ckeditor->replace("demo2", editerGetDefaultConfig());
            $this->template->write_view('content', 'news/news_create', $data, true);
            $this->template->render();
        }
    }

    public function news() {
        $this->template->add_title('Thống kê tin tức');
        $this->template->write('title', 'Thống kê tin tức');
        $this->template->write('desption', 'Thống kê tin tức');
        $this->load->model('news_m');
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "dashboard/news?";
        $config['per_page'] = PERPAGA;
        if ($this->input->is_ajax_request()) {
            $data['start'] = ($this->input->get('page') == FALSE) ? 0 : (int) $this->input->get('page');
            $data['count'] = $config['total_rows'] = $this->user_m->get(FALSE, TRUE);
            $this->user_m->set_start($data['start']);
            $data['users'] = $this->user_m->get();
            //echo "<pre>";     var_dump($data['users']);die;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $ajax = $this->load->view('user/user_ajax_index', $data, true);
            echo $ajax;
        } else {
            $data['count'] = $config['total_rows'] = $this->news_m->get(FALSE, TRUE);
            //echo "<pre>";     var_dump($data['count']);die;
            //$data['start'] = 0;

            $this->load->model('pages_m');
            $data['pages'] = $this->pages_m->get();
            //echo "<pre>";     var_dump($page);die;
            $this->news_m->set_start();
            $this->load->model('news_m');
            $data['news'] = $this->news_m
                    //->join('pages','page.id = news.page_id')   
                    ->get();
            //echo "<pre>";     var_dump($page);die;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $this->template->write_view('content', 'news/view', $data, true);
            $this->template->render();
        }
    }

    public function news_del() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('news_m');
            $id = $this->input->post('id');
            //var_dump($id);die;
            $return = $this->news_m->delete($id);
            if ($return) {
                $this->load->library('pagination');
                $config['per_page'] = PERPAGA;
                $start = ((int) $this->input->post('page') - 1) * (int) PERPAGA;
                $config['base_url'] = base_url() . "dashboard/news_del?";
                $data['count'] = $config['total_rows'] = $this->news_m->get(FALSE, TRUE);
                $this->news_m->set_start($start);
                $data['news'] = $this->news_m->get();
                $this->pagination->initialize($config);
                $data['pagination'] = $this->pagination->create_links();
                //echo'<pre>';                var_dump($data);die;
                $ajax = $this->load->view('news/view', $data, true);
                echo $ajax;
            }
        }
    }

    public function pages() {
        $this->template->add_title('Thống kê trang');
        $this->template->write('title', 'Thống kê trang');
        $this->template->write('desption', 'Thống kê trang');
        $this->load->model('pages_m');
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "dashboard/pages?";
        $config['per_page'] = PERPAGA;
        if ($this->input->is_ajax_request()) {
            $data['start'] = ($this->input->get('page') == FALSE) ? 0 : (int) $this->input->get('page');
            $data['count'] = $config['total_rows'] = $this->pages_m->get(FALSE, TRUE);
            //echo "<pre>";     var_dump($data['count']);die;
            $this->pages_m->set_start($data['start']);
            $data['pages'] = $this->pages_m->get();
//            echo "<pre>";     var_dump($data['pages']);die;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $ajax = $this->load->view('pages/view', $data, true);
            echo $ajax;
        } else {
            $data['count'] = $config['total_rows'] = $this->pages_m->get(FALSE, TRUE);
            //echo "<pre>";     var_dump($data['count']);die;
            //$data['start'] = 0;
            $this->pages_m->set_start();
            $data['pages'] = $this->pages_m->get(); //echo "<pre>";     var_dump($data['pages']);die;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $this->template->write_view('content', 'pages/view', $data, true);
            $this->template->render();
        }
    }

    public function create_page() {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $insert = array(
                'name' => $post['name'],
                'description' => $post['descr'],
            );
            $this->load->model('pages_m');
            $return = $this->pages_m->save($insert);
            if ($return != FALSE)
                echo json_encode(array('stt' => true));
            else
                echo json_encode(array('stt' => FALSE));
        }
    }

    public function page_del() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('pages_m');
            $id = $this->input->post('id');
            //var_dump($id);die;
            $return = $this->pages_m->delete($id);
            //var_dump($return);die;
            if ($return) {
                $this->load->library('pagination');
                $config['per_page'] = PERPAGA;
                $start = ((int) $this->input->post('page') - 1) * (int) PERPAGA;

                $config['base_url'] = base_url() . "dashboard/page_del?";
                $data['count'] = $config['total_rows'] = $this->pages_m->get(FALSE, TRUE);
                $this->pages_m->set_start($start);
                $data['pages'] = $this->pages_m->get();
                $this->pagination->initialize($config);
                $data['pagination'] = $this->pagination->create_links();
                $ajax = $this->load->view('pages/view', $data, true);
                echo $ajax;
            }
        }
    }

    public function slide_create() {
        if ($this->input->is_ajax_request()) {
            //var_dump($_POST);die;
            $post = $this->input->post();
            $a = $post['file_name'];
//          var_dump($a);die;
            foreach ($a as $key => $value) {
//              var_dump($value);die;
                $slide = array(
                    'title' => $post['title'],
                    'file_name' => $value,
                    'status' => $post['status'],
                );

                //echo '<pre>';            var_dump($a);die;
//            echo '<pre>';            var_dump($news);die;
                $this->load->model('slide_m');
                $this->slide_m->save($slide);
            };
        } else {
            $data = array();
            $this->template->add_title('Tạo slide');
            $this->template->write('title', '');
            $this->template->write('desption', 'Tạo slide');
            $this->load->helper(array('url', 'editor_helper'));
            //$this->load->model('slide_m');
            //$this->db->order_by('id');
            //$this->db->where('parent_id <>',0);
            //$data['slide'] = $this->slide_m->get();
            //echo '<pre>';var_dump($data['pages']);die;
            //$data['ckediter'] = $this->ckeditor->replace("demo", editerGetEnConfig());
//        $data['ckediter2'] = $this->ckeditor->replace("demo2", editerGetDefaultConfig());
            $this->template->write_view('content', 'slide/slide_create', $data, true);
            $this->template->render();
        }
    }
    public function slide(){
        $this->template->add_title('Thống kê slide');
        $this->template->write('title', 'Thống kê slide');
        $this->template->write('desption', 'Thống kê slide');
        $this->load->model('slide_m');
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "dashboard/slide?";
        $config['per_page'] = PERPAGA;
        if ($this->input->is_ajax_request()) {
            $data['start'] = ($this->input->get('page') == FALSE) ? 0 : (int) $this->input->get('page');
            //echo "<pre>";     var_dump($data['start']);die;
            $data['count'] = $config['total_rows'] = $this->slide_m->get(FALSE, TRUE);
            $this->slide_m->set_start($data['start']);
            $data['slide'] = $this->slide_m->get();
            //echo "<pre>";     var_dump($data['users']);die;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $ajax = $this->load->view('slide/user_ajax_index', $data, true);
            echo $ajax;
        } else {
            $data['count'] = $config['total_rows'] = $this->slide_m->get(FALSE, TRUE);
            //echo "<pre>";     var_dump($data['count']);die;
            //$data['start'] = 0;

//            $this->load->model('pages_m');
  //          $data['pages'] = $this->pages_m->get();
            //echo "<pre>";     var_dump($page);die;
            $this->slide_m->set_start();
            $this->load->model('slide_m');
            $data['slide'] = $this->slide_m
                    //->join('pages','page.id = news.page_id')   
                    ->get();
            //echo "<pre>";     var_dump($data['slide']);die;
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $this->template->write_view('content', 'slide/view', $data, true);
            $this->template->render();
        }
    }
    public function setting(){
        $this->template->write('title', 'Thiết lập website');
        $this->template->write('desption', 'Thiết lập ');
        $this->template->add_title('Thiết lập website');
        $this->load->model('setting_m');
        if($this->input->is_ajax_request()){
            $post = $this->input->post();
            $this->load->model('setting_m');
            $this->setting_m->save($post,$post['id']);
            //$this->template->write_view('content','setting/create_home',$post,true );
        }
        else{
        $data = array();
        $this->load->helper(array('url', 'editor_helper'));
        $data['ckediter'] = $this->ckeditor->replace("demo", editerGetEnConfig());
        $data['ckediter1'] = $this->ckeditor->replace("demo1", editerGetEnConfig());
        $data['info'] =  $this->setting_m->get();
//        echo "<pre>";var_dump($data['info']);die;
        
            $this->template->write_view('content', 'setting/create_home',$data,true);
            $this->template->render(); 
        }
    }
    public function useronline(){
        
    }
    public function bill($user = NULL) {
        $this->template->write('title', '');
        $this->template->write('desption', 'Thống kê đơn hàng');
        $this->template->add_title('Thống kê');
        $this->load->model('bill_m');
        $data['bill'] = $this->bill_m->get();
        foreach ($data['bill'] as $key => $value){  
        $this->load->model('user_m');
        $data['user'] = $this->user_m->get_by('username',$value['user']);
        $this->load->model('product_m');
        $data['pro'] = $this->product_m->get_by('proid',$value['id_pro']);
        }
        $this->template->write_view('content','bill/view',$data,true);
        $this->template->render();
    }
}
