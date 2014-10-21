<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends Backend_Controller
{
    public function __construct() {
        parent::__construct();
       //echo FCPATH . APPPATH . 'third_party/ckfinder/ckfinder.php';die;
        //echo FCPATH . 'ckeditor/ckeditor.php';
        //echo  APPPATH.'third_party/ckfinder/ckfinder.php';die;
        
    }

    public function index()
    {
        $data = array();
        $this->load->helper(array('url', 'editor_helper'));
        $data['ckediter'] = $this->ckeditor->replace("demo", editerGetEnConfig());
        $data['ckediter2'] = $this->ckeditor->replace("demo2", editerGetDefaultConfig());
        $this->load->view('welcome_message', $data);
    }

}