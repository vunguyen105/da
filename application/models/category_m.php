<?php

class category_m extends MY_Model {

    public $table_name = 'nested_set_tree';
    public $primary_key = 'id';

    public function __construct() {
        parent::__construct();
    }

//    function my_model_method() {
//        $otherdb = $this->load->database('otherdb', TRUE);        var_dump($otherdb);die;
//
//        $query = $otherdb->select('author,description')->get('7maru_comas');
//        var_dump($query);
//    }
//    
//    function my_model_method2() {
//        $otherdb = $this->load->database();        var_dump($otherdb);die;
//
//        $query = $otherdb->select('author,slug')->get('brands');
//        var_dump($query);
//    }
//    
//    public function hix(){
//        //$this->Nested_set->test();
//    }
}

?>
