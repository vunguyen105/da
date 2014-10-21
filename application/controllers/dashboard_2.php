<?php

class dashboard extends Backend_Controller {

    public $new_nested_set;

    function __construct() {
        parent::__construct();
//        if ($this->is_login() == false)
//            redirect('home/login');
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

    public function user_del() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('user_m');
            $id = $this->input->post('id');
            $return = $this->user_m->delete($id);
            if ($return) {
                $this->load->library('pagination');
                $config['per_page'] = PERPAGA;
                $start = ((int) $this->input->post('page') - 1) * (int) PERPAGA;
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

    public function user_edit() {
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
            }
            else
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
        $data = array();
        $this->template->add_title('Quản lý sản phẩm');
        $this->template->write('title', 'Quản lý sản phẩm');
        $this->template->write('desption', 'Quản lý sản phẩm');
        $this->load->helper(array('url', 'editor_helper'));
        $this->load->model('category_m');
        $this->db->order_by('id');
        $data['cats'] = $this->category_m->get();
        //var_dump($data['cats']);die;
        $data['ckediter'] = $this->ckeditor->replace("demo", editerGetEnConfig());
//        $data['ckediter2'] = $this->ckeditor->replace("demo2", editerGetDefaultConfig());
        $this->template->write_view('content', 'welcome_message', $data, true);
        $this->template->render();


        $anh;// nhieu anh
        $pro;// tieu de, thu muc, noi dung
    }

}