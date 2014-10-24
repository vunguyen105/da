<?php
class Tag extends Backend_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function view(){
        $this->template->add_title('Tag');
        $this->template->write('title', 'Tag');
        $this->template->write('desption', 'Tag');
        $this->load->model('tags_m');
        $this->tags_m->set_start(0,2);
        $data['tags'] = $this->tags_m->get();
        //$this->user_m->get_user();
        echo "<pre>";var_dump($data['tags']);die;
        $this->template->write_view('content', 'dashboard/tag_view', $data, true);
        $this->template->render();
        echo "cccc";
    }
}
