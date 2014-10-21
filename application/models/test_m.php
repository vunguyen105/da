<?php

class  test_m extends CI_Model{
    public $otherdb2;
    public function __construct() {
        parent::__construct();
        $this->otherdb2 = $this->load->database('otherdb', TRUE);
    }
    
     function my_model_method2() {//echo '222';
        $query = $this->otherdb2->get('countries');
        var_dump($query);
    }
}
?>
