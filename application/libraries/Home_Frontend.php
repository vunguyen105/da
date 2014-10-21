<?php 

class Home_Frontend extends Home_Controller {
    function __construct() {

        parent::__construct();

        $this->load->library('category_lib');
        $this->new_nested_set = $this->category_lib->category_initialize();
        //$data['menu'] = $this->new_nested_set->build_menu_frontend(1);
        //var_dump($data['menu']);die;

        $data = array(
            'blog_title' => 'My Blog Title',
            'blog_heading' => 'My Blog Heading'
        );
        
        //$data = array();
        $this->load->library('template');
        $this->template->set_template('home');
        $this->template->add_doctype();

        //$this->template->parse_view('footer','backend/dashboard/footer',$data);

        $this->template->parse_view('footer','frontend/shop/footer',$data);
        $this->template->parse_view('home_page','home_frontend/shop/home_page',$data);
        
        //$this->template->parse_view('sidebar','frontend/shop/sidebar',$data);
        $this->template->parse_view('header_nav','frontend/shop/header_nav',$data);
        //$this->template->write_view('header_nav', 'frontend/shop/header_nav', $data, true);
        //$this->template->write_view($region, $view_file, $view_data, $overwrite = FALSE)
    }
    function is_login(){
        $is_logged = $this->session->userdata('is_logged');
        if(isset($is_logged) && $is_logged == true)
            return true;
        else
            return false;
    }
}
