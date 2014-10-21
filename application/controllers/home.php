<?php

class home extends Frontend_Controller{
    public function __construct() {
        parent::__construct();
        //$this->load->helper("security");
        //$alias_pro = xss_clean($this->uri->segment(1, ''));
       // $this->load->model('Home_m');
        //$this->load->helper("text");
        //$data['page'] = $this->Home_m->get_page();
        //$this->template->write_view('header_nav', 'home/header',$data,true);
        //$this->page($alias_pro);
    }
    
    public function index()
    {
        echo 1;die;
        //$data['slide'] = $this->Home_m->get_img_slide();
        //var_dump($data['slide']);
        redirect('Site');
    }
    /*
     * KHÔNG XÓA
     */
//    public function trang_phuc($cat = NULL,$sex = NULL)
//    {
//        if($sex == 'men')
//            echo 'men';
//        if($sex == 'women')
//            echo 'women';
        
//        $alias = xss_clean($this->uri->segment(1, ''));        
//        $alias_pro = xss_clean($this->uri->segment(3, ''));
//        $data['cats'] = $this->Home_m->get_page($alias); 
//        if(($alias_pro) != '')
//        {
//            $id_pro = explode('-',$alias_pro);
//            $id = $id_pro[0];
//            $data['pro'] = $this->Home_m->getpro($id); 
//            $this->template->write_view('main', 'home/main_detail',$data,true);
//        }   
//        else {
//            $slug_pro = xss_clean($this->uri->segment(2, ''));
//            $data['pros'] = $this->Home_m->get_pro($slug_pro); 
//            $this->template->write_view('main', 'home/main',$data,true);
//        }
//         $this->template->write_view('sidebar', 'home/sidebar',$data,true);      
//        $this->template->render();
//    }
              
    public function test(){   
        $this->load->model('home_m');
        $this->home_m->test($id);
        $this->load->view('users/view');
    }          
    
    
    public function page($page = NULL,$cat = NULL,$alias_pro = NULL)
    {
        $page = xss_clean($this->uri->segment(3, ''));
        if(empty($page)) 
        {
            $this->index();
        }
        else 
        {
            $cat = xss_clean($this->uri->segment(4, ''));
            //echo $;
            $data['page'] = $this->Home_m->getpage($page);            
            $data['pro_page'] = $this->Home_m->get_pro_on_page($page);
            $data['pro_new'] = $this->Home_m->get_pro_new(4);
            $data['pro_top'] = $this->Home_m->get_pro_top();
           // var_dump($data['page']);
            foreach ($data['pro_top'] as $key => $value)
            {
               $data['id'][] = $value['id_pro'];
            }
            if(!empty($data['id']))
            {
                $data['top'] = $this->Home_m->get_top($data['id'],4);
            }   
            if(!empty($data['page']))
            $title = $data['page'][0]['name'];
                
                        //var_dump($data['top']);die;
            if($data['pro_page']){
                $data['imgs'] = $this->Home_m->get_img_pro($data['pro_page'][0]['proid']);
                $this->load->library('pagination'); 
                $this->load->model('Product_m');
                $config['base_url'] = base_url('home/page/'.$this->uri->segment(3, '').'/'.$cat.'?'); // xác định trang phân trang 
                $config['total_rows'] = $this->Home_m->get_pro_count_page($page);
                //var_dump($config['total_rows']);
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
                $config['uri_segment'] = 5; // xác định segment chứa page number 
                $config['page_query_string'] = TRUE;
                $data['create_links1'] = $this->pagination->create_links();
                $this->pagination->initialize($config);               
                //var_dump($data['create_links']);
                //$data['total_page'] = $this->Product_m->get_total_product($cat);
                //var_dump($config['total_rows']);
                $offset= '';
                if(isset($_GET['per_page'])) $offset = $_GET['per_page'];
                $data['pro_page'] = $this->Home_m->get_pro_on_page($page,$config['per_page'],$offset);
                }
            $data['cats'] = $this->Home_m->getcat($page); 
           // var_dump($data['cats']);
            if(isset($cat) && !empty($data['cats']))
            {
                if($this->uri->segment(4, ''))
                $title = $title.' - '.get_cat_name($cat);
                //$data['pros'] = $this->Home_m->get_pro($cat); 
                $product = xss_clean($this->uri->segment(5, ''));
                /*
                 * phân trang
                 */
                $this->load->library('pagination'); 
                $this->load->model('Product_m');
                $config['base_url'] = base_url('home/page/'.$this->uri->segment(3, '').'/'.$this->uri->segment(4, '').'?'); // xác định trang phân trang 
                $data['count'] = $config['total_rows'] = $this->Product_m->get_total_product($cat);
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
                $config['uri_segment'] = 6; // xác định segment chứa page number 
                $config['page_query_string'] = TRUE;
                $data['create_links'] = $this->pagination->create_links();
                //$this->pagination->initialize($config);
                //var_dump($this->pagination->create_links());
                //$data['total_page'] = $this->Product_m->get_total_product($cat);
                //var_dump($data['total_page']);
                $offset= '';
                if(isset($_GET['per_page'])) $offset = $_GET['per_page'];
                $data['pros'] = $this->Product_m->get_pro_page($cat,$config['per_page'],$offset);
                //var_dump($data['pros']);
                if(!empty($data['pros']) && !empty($product))
                {
                    $id_pro = explode('-',$alias_pro);
                    $id = $id_pro[0];
                    $data['pro'] = $this->Home_m->getpro($id); 
                    if($data['pro'])
                    {
                        $data['image'] = $this->Home_m->get_img_pro($data['pro'][0]['proid']); 
                        //var_dump($data['pro']);
                        $data['pro_detail'] = $this->Home_m->get_pro_lienquan($id,$cat);
                        //echo "<pre>";var_dump($data['pro_detail']);
                    }   
                    
                    $this->template->write_view('main', 'home/main_detail',$data,true);
                }
               
                else
                {
                    $this->template->write_view('main', 'home/main',$data,true);
                }
                
            }   
            else {
                $this->template->write_view('main', 'home/main',$data,true);
            }
            //$this->template->write_view('sidebar', 'home/sidebar',$data,true);      
            if(isset($title)) $this->template->add_title($title); 
            $this->template->render();
        }
        
    }
    
    function shop()
    {
        if($this->input->is_ajax_request()){
            $data =  $this->input->post();
            $this->load->model('Products_model');

                    $product = $this->Products_model->get((int)$this->input->post('id'));
                    if($product)
                    {
                        if(!$check_cart = check_cart($this->input->post('id')))
                        {//echo 1;
                                $insert = array(
                                        'id' => $this->input->post('id'),
                                        'qty' => $this->input->post('value'),
                                        'price' => $product->price,
                                        'name' => strtolower(convert_vi_to_en($product->pro_name))
                                );		
                                $this->cart->insert($insert);
                                //echo "dddđ";
                                $this->load->view('home/ajax_cart');   
                        }
                        else { //echo 2;
                            
                            $this->cart->update(array(
                                    'rowid' => $check_cart['rowid'],
                                    'qty' => $this->input->post('value') + $check_cart['qty'] 
                            ));
//                             $insert = array(
//                                        'id' => $this->input->post('id'),
//                                        'qty' => $this->input->post('value'),
//                                        'price' => $product->price,
//                                        'name' => strtolower(convert_vi_to_en($product->pro_name))
//                                );		
//                                $this->cart->insert($insert);
                                //echo "dddđ";
                                $this->load->view('home/ajax_cart');  
                        }
                    }   
        }
        else header("Location: " . base_url());
    }
    
    function remove() {
	if($this->input->is_ajax_request()){
            //var_dump($this->input->post('id'));
		$this->cart->update(array(
			'rowid' => $this->input->post('id'),
			'qty' => 0
		));
                $this->load->view('home/ajax_cart');
		
	}
        else header("Location: " . base_url());
    }
    
    function show()
    {
       if($this->input->is_ajax_request()){
            $this->load->view('home/show');
       }
       else header("Location: " . base_url());
    }
}