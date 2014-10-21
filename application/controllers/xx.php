<?php

class dashboard extends Backend_Controller {

    public $new_nested_set;

    function __construct() {
        parent::__construct();
//        if ($this->is_login() == false)
//            redirect('home/login');
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
                'rgt' => $post['left'],
                'lft' => $post['right'],
            );
            $this->load->library('Nested_set');
            $this->new_nested_set = new Nested_set();
            $this->new_nested_set->setControlParams('nested_set_tree', 'lft', 'rgt', 'id', 'parent_id', 'name');
            $xxx = $this->new_nested_set->deleteNode($node);
            var_dump($xxx);
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

    public function delete_user($user_id) {
        $this->load->model('dashboard_m');
        $xxx = $this->dashboard_m->delete_user($user_id);
        var_dump($xxx);
        die;
        redirect('dashboard/viewAll_user', 'refresh');
    }

    function test() {
        $this->load->library('Nested_set');
        $this->new_nested_set = new Nested_set();
        $this->new_nested_set->setControlParams('nested_set_tree', 'lft', 'rgt', 'id', 'parent_id', 'name');
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

    public function category() {
        if ($this->input->is_ajax_request()) {
            $list = $this->input->post('tmp');
            $this->load->library('Nested_set');
            $this->new_nested_set = new Nested_set();
            $this->new_nested_set->setControlParams('nested_set_tree', 'lft', 'rgt', 'id', 'parent_id', 'name');
            $nodes = $this->new_nested_set->getNodeFromId(1);
            $root_nodes1 = $this->new_nested_set->getSubTree($nodes);
            $item_old = $this->new_nested_set->Item_List($nodes['parent_id'], $root_nodes1); //print_r($item_old);exit;
            $root_nodes = $this->new_nested_set->getSubTree_int($nodes);
            $parents_old = $root_nodes['parents'];
            $list_item_parent = json_decode($list, true);
            $parents_new = $this->multiarray_children($list_item_parent[0]["children"], $list_item_parent[0]["id"]);
            $item_new = $this->multiarray_values($list_item_parent, 'id'); //print_r($khac);exit;
            $khac = $this->compare($item_old, $item_new); // var_dump($khac);die;
            if ($khac != false) {
                $parents_compare = $this->parents_compare($parents_old, $parents_new, $khac, $item_new);
                //var_dump($parents_compare);die;
                $update = $this->update_cat($parents_compare);
                //print_r($update);die;
                $nodes = $this->new_nested_set->getNodeFromId($update['id']); //print_r($nodes);die;
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
                $tuan = $this->children_compare($parents_old, $parents_new, $item_old);
                //var_dump($tuan);die;

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
        }
        $this->template->add_title('Quản lý thư mục');
        $this->template->write('title', 'Quản lý thư mục');
        $this->template->write('desption', 'Quản lý thư mục');
        $this->load->library('Nested_set');
        $this->new_nested_set = new Nested_set();
        $this->new_nested_set->setControlParams('nested_set_tree', 'lft', 'rgt', 'id', 'parent_id', 'name');
        $nodes = array(
            'id' => 9,
            'rgt' => 19,
            'lft' => 18,
            'parent_id' => 0
        );
        $target = array(
            'id' => 8,
            'rgt' => 3,
            'lft' => 2,
            'parent_id' => 3
        );
        //$this->new_nested_set->insertNewChild($nodes,$extrafields = array('name' =>'Tuấn Con'));die;
        //$this->new_nested_set->insertNewTree($extrafields = array('name' =>'Tuấn'));die;
        //var_dump($this->new_nested_set->deleteNode($nodes));die;
        //$this->new_nested_set->setNodeAsFirstChild($nodes,$target);
        // $this->new_nested_set->setNodeAsNextSibling($nodes,$target);
        //$this->new_nested_set->insertNewChild($nodes,$extrafields = array('name' => 'Nguyên 3'));
        //$this->new_nested_set->insertNewTree();
        $me = $this->new_nested_set->getRootNodes();
        //echo count($me);die;
        $nodes = $this->new_nested_set->getNodeFromId(1);
        // $nodes2 = $this->new_nested_set->getNodeFromId(9);
        //var_dump($nodes);die;
        //$level = $this->new_nested_set->getNodeLevel($nodes);
        //var_dump($level);die;
        $root_nodes1 = $this->new_nested_set->getSubTree($nodes);
        //$root_nodes2 = $this->new_nested_set->getSubTree($nodes2);
//        echo "<pre>";
//        var_dump($root_nodes1);
//        die;
        // echo "<pre>"; var_dump($root_nodes1);die;
        $class = array('ol' => 'dd-list', 'li' => 'dd-item', 'div' => 'dd-handle');
        $data['menu'] = $this->new_nested_set->Menu_Node_Bootstrap($nodes, $root_nodes1, $class);
        //$data['menu'] = $this->new_nested_set->Menu_Bootstrap(1, $root_nodes1, $class);
//        echo "<pre>";
//        var_dump($this->new_nested_set->Item_List(2, $root_nodes1));
//        die;
        //$data['menu2'] = $this->new_nested_set->Menu_Node_Bootstrap($nodes2, $root_nodes2, $class);
        //var_dump($data['menu']);die;
        $this->template->write_view('content', 'category/view_category', $data, true);
        $this->template->render();
    }

    function multiarray_values($ar, $key = 'id') {
        $values = array();
        foreach ($ar as $k => $v) {
            if ($k === $key) {
                $values[] = $v;
            }
            if (is_array($ar[$k]))
                $values = array_merge($values, $this->multiarray_values($ar[$k], $key));
        }
        return $values;
    }

    function multiarray_children($temps, $id) {
        $children = array();
        //if($temps)
        foreach ($temps as $k => $v) {
            $children[$id][] = $v['id'];
        }
        foreach ($temps as $k => $v) {
            if (isset($v["children"])) {
                $children = $children + $this->multiarray_children($v["children"], $v['id']);
            }
        }
        return $children;
    }

    /*
     * so sánh 2 mảng item (so sánh từ trên xuống) lấy ra vi trí đã di chuyển 
     */

    public function compare($array_old, $array_new) {
        for ($i = 0; $i < count($array_old); $i++) {
            $old = $array_old[$i];
            $new = $array_new[$i];
            if ($new != $old) {
                $return = array(
                    'old' => $old,
                    'new' => $new,
                    'i' => $i + 1,
                );
                //                var_dump($return);die;
                return $return;
            }
        }
        return FALSE;
    }

    /*
     * lấy ra giá trị node mẹ (key và value) của node mới dc di chuyển
     */

    public function parents_compare($array_old, $array_new, $khac, $items) {
        foreach ($array_old as $key => $value) {
            $k = array_search($khac['old'], $value);
            $h = array_search($khac['new'], $value);
            if (isset($k) && $k !== FALSE) {
                $parent_odl1 = $key;
            }
            if (isset($h) && $h !== FALSE) {
                $parent_new1 = $key;
            }
        }
        foreach ($array_new as $key => $value) {
            $k = array_search($khac['old'], $value);
            $h = array_search($khac['new'], $value);
            if (isset($k) && $k !== FALSE) {
                $parent_odl2 = $key;
            }
            if (isset($h) && $h !== FALSE) {
                $parent_new2 = $key;
            }
        }
        $item = null;
        if ($parent_new1 == $parent_new2)
            $item = $khac['old'];
        if ($parent_odl1 == $parent_odl2)
            $item = $khac['new'];
        if (($parent_new1 == $parent_new2) && ($parent_odl1 == $parent_odl2)) {//echo 'xxx';die;
            $k_old = array_search($khac['old'], $items);
            $k_new = array_search($khac['new'], $items);
            $item = ($k_old > $k_new) ? $khac['old'] : $khac['new'];
        }
        foreach ($array_new as $key => $value) {
            foreach ($value as $k => $v) {
                if ($item == $v)
                    return array(
                        'key' => $key,
                        'value' => $value,
                        'id' => $item
                    );
            }
        }
    }

    public function update_cat($parents_compare) {
        $return = array();
        if (count($parents_compare['value']) == 1) {
            $return =
                    array(
                        'id' => $parents_compare['id'],
                        'parents' => $parents_compare['key']
            );
        }

        if (count($parents_compare['value']) > 1) {
            foreach ($parents_compare['value'] as $key => $value) {
                if (($parents_compare['id'] == $value) && ((int) $key == 0)) {
                    $return =
                            array(
                                'id' => $parents_compare['id'],
                                'parents' => $parents_compare['key']
                    );
                }
                if (($parents_compare['id'] == $value) && ((int) $key > 0)) {
                    $return =
                            array(
                                'id' => $parents_compare['id'],
                                'next' => $parents_compare['value'][$key - 1]
                    );
                }
            }
        }
        return $return;
    }

    /*
     * Trường hợp 2 mảng item ko thay đổi. So sánh 2 mảng children 
     * return : node đã được kéo đi, và kéo đi là cắt đi hay thêm vào node mới
     */

    public function children_compare($array_old, $array_new, $item_old) {
        foreach ($array_old as $key => $value) {
            if (isset($array_new[$key]) && (count($array_old[$key]) != count($array_new[$key]))) {
                $old = $this->array_compare($array_old[$key]);
                $new = $this->array_compare($array_new[$key]);
                if (count($old) > count($new))
                    $khac = array_diff($old, $new);
                else
                    $khac = array_diff($new, $old);
                $khac = $this->array_compare($khac);
                // var_dump($khac);die;
                $k = array();
                $parent_n = array();
                if (count($array_old[$key]) > count($array_new[$key])) {
                    //var_dump($array_new);die;
                    foreach ($array_new as $key => $value) {
                        //var_dump($khac['0']);
                        $k = array_search($khac['0'], $value);
                        if (isset($k) && $k !== FALSE) {
                            $parent_n = $key;
                        }
                    }
                    // var_dump($parent_n);die;
                    if (count($array_new[$parent_n]) > 1) {
                        $k_next = array_search($khac['0'], $array_new[$parent_n]) - 1;
                        //    var_dump($k_next);die;
                        $return = array(
                            'id' => $khac,
                            'next' => $array_new[$parent_n][$k_next]
                        );
                    } else { //echo "hic";die;
                        $return = array(
                            'id' => $khac,
                            'parent' => $parent_n
                        );
                    }
                } else {
                    foreach ($array_new as $key => $value) {
                        //var_dump($khac['0']);
                        $k = array_search($khac['0'], $value);
                        if (isset($k) && $k !== FALSE) {
                            $parent_n = $key;
                        }
                    }
                    $k_next = array_search($khac['0'], $array_new[$parent_n]) - 1;
                    //var_dump($array_new[$parent_n][0],$khac['0']);die;

                    $return = array(
                        'id' => $khac,
                        'next' => $array_new[$parent_n][$k_next]
                    );
                }
            }
        } //var_dump($return);die;
        return $return;
    }

    /*
     * lấy ra dạng mảng [1,2,3,4,5]
     */

    public function array_compare($array) {
        $array_new = array();
        foreach ($array as $key => $value) {
            $array_new[] = $value;
        }
        return $array_new;
    }

    public function testxxx() {
        $this->template->write_view('content', 'users/testxxx', '', true);
        $this->template->render();
    }

}