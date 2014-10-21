<?php

class  bill_m extends MY_Model{
    public $table_name = 'bill';
    public $primary_key = 'id';
    public function __construct() {
        parent::__construct();
    }
    function bill_get($user = NULL)//truyen tham so vao thi lay ra sp da dat cua user
                                            //khong truyen thi lay ra tat ca cua cac user
        {
            //var_dump($user);die;
            $this->db->from('bill');
            $this->db->join('product','product.proid = bill.id_pro');
            $this->db->join('users','users.username = bill.user');
            
            if ($user != null){
            $this->db->where ('user',$user);
            }
            $q = $this->db->get();
            if(!empty($q)) return $q;
            else return false;
        }
    
}
?>
