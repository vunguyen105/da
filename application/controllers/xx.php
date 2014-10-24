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








MỞ ĐẦU

T
rong sự phát triển nhanh như vũ bão của xã hội công nghệ thông tin hiện nay, số lượng thông tin ngày càng nhiều và trở nên quá tải đối với tất cả chúng ta khiến cho việc tìm kiếm trở nên khó khăn và sự chính xác của thông tin cũng bị ảnh hưởng rất nhiều. Trong khi đó, nhu cầu cập nhật, giải trí và tìm kiếm thông tin của xã hội ngày càng cao – đặc biệt là đối với thông tin giải trí về game, đòi hỏi phải có sự chính xác, nhanh chóng và kịp thời của những thông tin củng là điều tất yếu và cần thiết nhất .
Chính vì nguyên nhân đã nêu trên, em xin chọn đề tài nghiên cứu “Xây Dựng Website Tin Tức Giải Trí Về Game Trên Nền Tảng Codeigniter Framework”, nhằm mục đích góp một phần công sức nhỏ bé của mình trong việc chọn lọc và cập nhật các thông tin giải trí chính xác và nhanh chóng, giúp cho việc tìm kiếm và cập nhật thông tin của những người có nhu cầu về lĩnh vực tin tức giải trí về game không còn gặp khó khăn nữa.
Đề tài này được nghiên cứu và xây dựng trong phạm vi nhà trường kết hợp với các nhu cầu thực tiễn của xã hội. Phương pháp nghiên cứu đề tài là tự nghiên cứu,  thông qua các tài liệu tham khảo trên internet và tài liệu giấy. 
Về phần nội dung của đề tài nghiên cứu này, sẽ có ba phần chính là: giới thiệu về Framework, tiếp theo là cách cài đặt - sử dụng Framework củng như giới thiệu về website và các vấn đề liên quan khác. Cuối cùng, là phần tài liệu tham khảo và các hướng phát triển đề tài trong tương lai. 
 
LỜI CẢM ƠN

Trong quá trình nghiên cứu và xây dựng đề tài, có rất nhiều trở ngại và khó khăn gặp phải như: tìm hiểu thực tế, nhu cầu thực sự của xã hội, tìm hiểu framework, các tài liệu liên quan,..,và còn rất nhiều khó khăn khác.
Chính vì thế đề tài nghiên cứu chưa được hoàn thiện như mong muốn được, nhưng nhờ sự trợ giúp nhiệt tình và cụ thể của giáo viên hướng dẫn, các tài liệu nghiên cứu được đăng tải tải trên internet nên đề tài đã trở nên hoàn thiện đến mức cao nhất có thể. Em xin cám ơn chân thành đến giáo viên hướng dẫn và những người đã giúp đỡ, góp ý cho đề tài nghiên cứu này.
 
NHẬN XÉT
CỦA GIÁO VIÊN HƯỚNG DẪN

…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
NHẬN XÉT
CỦA GIÁO VIÊN PHẢN BIỆN

…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
…………………………………………………………………………………………….
MỤC LỤC

Phần 1 : Giới thiệu về Codeigniter Framework……………………………...............1
1.1	Giới thiệu chung về Codeigniter Framework……………………….……………1
1.1.1 Codeigniter Framework là gì ?.................................................................................1
1.2 Tại sao phải sử dụng Codeigniter Framework……………………………...........2 
Phần 2 : Giới thiệu về website……………………………............................................3
2.1 Giới thiệu chung về website…………………………………………………..........3
2.2 Các chức năng chính của website…………………………………………………3
2.2.1 Chức năng của người dùng (user)…………………………………………………3
2.2.2 Chức năng của người quản trị (administrator)…………………………….………3
2.3 Các bước cài đặt Codeigniter Framework…………………………..…………...4
2.3.1 Cài đặt server giả lập localhost…………………………………………..………..4
2.3.2 Cài đặt Codeigniter Framework………………………………………………….11
2.4 Mô hình cơ sở dữ liệu của website……………………...……...……..………….12
2.4.1 Mô hình quan hệ thực thể (ERD)………………….……………………..………12
2.4.2 Mô hình vật lý (LPD)…………………...………………………………………..14
2.4.3 Mô hình User – Case…………………………………………………..…………16
2.4.3.1 Mô hình User – Case của người dùng………….………………………………16
2.4.3.2 Mô hình User – Case của người quản trị…………………………....…………16
2.5 Một số giao diện chính của website…………………………………..………….17
2.5.1 Giao diện của người dùng (user)…………………………………………………17
2.5.2 Giao diện của người quản trị (administrator)…………………………………….21
Phần 3 : Hướng phát triển đề tài…………………………………………………….24 
3.1 Những điều đã đạt được trong đề tài……………………………………………24
3.2 Hướng phát triển đề tài trong tương lai………………………………………....24
3.3 Tài liệu tham khảo sưu tầm…...…….………....……………………..………….24
Tài liệu tham khảo………….......................………………………………………….25 


 
DANH MỤC CÁC HÌNH, BẢNG BIỂU VÀ SƠ ĐỒ

Hình 1.1 Logo của Codeigniter Framework…............................…………………….....2
Hình 2.1 Cửa sổ cài đặt Wampserver bước 2.1.………………..........……………….....5
Hình 2.2 Cửa sổ cài đặt Wampserver bước 2.2….…......................………………….....6
Hình 2.3 Cửa sổ cài đặt Wampserver bước 2.3.…………………..........…………….....6
Hình 2.4 Cửa sổ cài đặt Wampserver bước 2.4……….………………..........……….....7
Hình 2.5 Cửa sổ cài đặt Wampserver bước 2.5…….…………………………......….....7
Hình 2.6 Cửa sổ cài đặt Wampserver bước 2.6….……………………...………............8
Hình 2.7 Cửa sổ cài đặt Wampserver bước 2.7.……………………………...................8
Hình 2.8 Cửa sổ cài đặt Wampserver bước 2.8.…………………………………...........9
Hình 2.9 Cửa sổ cài đặt Wampserver bước 2.9….………………………………….......9
Hình 2.10 Thay đổi port của Apache….........……………………………………….....10
Hình 2.11 Màn hình mặc định khi khởi động Wampserver…...…………………….....10
Hình 2.12 Copy thư mục đề tài vào C:/wamp/www……..………………………….....11
Hình 2.13 Chọn module có tên là rewrite_module………....……………………….....11
Hình 2.14 Giao diện trang chủ…………….......................………………………….....11
Hình 2.15 Mô hình ERD của website……………………………………………….....12
Hình 2.16 Mô hình LPD của website……………………………………………….....15
Hình 2.17 Mô hìn User-Case của user……….......………………………………….....16
Hình 2.18 Mô hìn User-Case của administrator……........………………………….....16
Hình 2.19 Giao diện trang chủ của website…………...…………………………….....17
Hình 2.20 Giao diện trang  tin tức mới cập nhật………………....………………….....18
Hình 2.21 Giao diện trang  đăng ký thành viên….………………………………….....19
Hình 2.22 Giao diện trang đăng nhập……………………………………………….....19
Hình 2.23 Giao diện trang thư viện hình ảnh............……………………………….....20
Hình 2.24 Giao diện trang flash game hay………………………………………….....20
Hình 2.25 Giao diện trang quản trị website………….......………………………….....21
Hình 2.26 Giao diện trang quản lý slide show…………….......…………………….....22
Hình 2.27 Giao diện trang thêm mới slide show……...…………………………….....22
Hình 2.28 Giao diện trang sửa thông tin slide show……..………………………….....22
Hình 2.29 Thông báo về việc xóa slide show……....................…………………….....23




