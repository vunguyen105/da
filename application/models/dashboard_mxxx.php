
<?php

class Dashboard_m extends MY_Model{
    
    protected $_table_name = 'TBL_ADMIN';
    protected $_primary_key = 'TBL_ADMIN.USRID';
    protected $_order_by = 'TBL_ADMIN.USRID desc';
    protected $_select = "TRANSID, REF_TRANSID, TYPE,
        AMOUNT, SOURCE_USER_ID, BONUS_ID, 
        DEST_USER_ID, PARTNERID, STATUS,
        ORG_STATUS,FEE_AMOUNT,TRDT, ID, MEMO, PRODUCTCODE, PRODUCTQLTY, DESTPARTNERID";
    
    function __construct() {
        parent::__construct();
    }

    function create_user($new_member_insert_data) {     
        $this->db->set('USRID','SEQ_TBL_ADMIN.NEXTVAL',FALSE);      
        $this->db->set('CREATE_USR',"TO_DATE('GETDATE()','DD-MM-YYYY HH:II:SS')",FALSE);      
        //$insert= $this->db->insert('TBL_ADMIN', $new_member_insert_data);
        $this->db->set($new_member_insert_data);
        $this->db->insert("TBL_ADMIN");
        $id = $this->db->insert_id();
        return $id;
    }
    
    function create_partner($new_partner_insert_data,$date) {
        //$this->db->set('CREATE_DATE',"TO_DATE('$date','DD-MM-YYYY HH24:MI:SS')",FALSE);    
        $this->db->set('CREATE_DATE',"TO_DATE('GETDATE()','DD-MM-YYYY HH:II:SS')",FALSE);
        //$insert= $this->db->insert('TBL_PARTNERS', $new_partner_insert_data);   
         $this->db->set($new_partner_insert_data);
        $this->db->insert("TBL_PARTNERS");
        $id = $this->db->insert_id();
        return $id;
    }
    
    public function getAll_user($user_id=NULL)
     {
        if($user_id==NULL){
            $query =  $this
                        ->db
                        ->get('TBL_ADMIN');
                return $query->result_array();
        } else {
             $query =$this
                        ->db
                        ->where('TBL_ADMIN.USRID', $user_id)
                        
                        ->get('TBL_ADMIN');
             if($query->num_rows == 1){
                 return $query->result_array();
             }
            else return false;
        }

     }
     
     public function getAll_partner($partner_id=NULL)
     {
        if($partner_id==NULL){
            $query=  $this
                        ->db
                        ->get('TBL_PARTNERS');
                return $query->result_array();
        } else {
            
             $query=$this
                    ->db
                    ->where('TBL_PARTNERS.PARTNERID', $partner_id)
                    
                    ->get('TBL_PARTNERS');
             if($query->num_rows == 1){
                return $query->result_array();
             }
             else return false;
        }
     }
     
    public function delete_user($user_id)
    {
         $delete = $this
                        ->db
                        ->where('TBL_ADMIN.USRID',$user_id)
                        ->delete('TBL_ADMIN');
                return $delete;
    }
    
    public function delete_partner($partner_id){            
         $delete = $this
                        ->db
                        ->where('TBL_PARTNERS.PARTNERID',$partner_id)
                        ->delete('TBL_PARTNERS');
                return $delete;
    }
    function edit_user($new_data,$id) {
          $updata = $this
                         ->db
                         ->where('USRID',$id)
                         ->update('TBL_ADMIN',$new_data);
                 return $updata;
    }
    function edit_partner($new_data,$id) {
          $updata = $this
                         ->db
                         ->where('PARTNERID',$id)
                         ->update('TBL_PARTNERS',$new_data);
                 return $updata;
    }
    
    function search_partner($tranid){
           $search = $this
                         ->db
                         ->select("*")
                         ->where('TRANSID',$tranid)
                         ->get('TBL_TRANSACTIONS');
                 return $search->result_array();
                 
    }
    
    function search_partner_xxx($tranid){
        $sql = "select
        TRANSID, REF_TRANSID, TYPE,
        AMOUNT, SOURCE_USER_ID, BONUS_ID, 
        DEST_USER_ID, PARTNERID, STATUS,
        BAL_BEFORE, BAL_AFTER, ORG_STATUS, FEE_AMOUNT,
        to_char(TRANSDATE,'DD/MM/YYYY HH24:MI:SS') as TRANSDATE,
        TRDT, ID, MEMO, PRODUCTCODE, PRODUCTQLTY, DESTPARTNERID,
        to_char(TERMTXTDATETIME,'DD/MM/YYYY HH24:MI:SS') as TERMTXTDATETIME, 
        to_char(RESPONSEDATE,'DD/MM/YYYY HH24:MI:SS') as RESPONSEDATE,
        from TBL_TRANSACTIONS
        where TRANSID = '$tranid'";
        return $re = $this->db->query($sql);
    }
    
    function search_partner_date($date_from,$date_to,$partnerId,$user){        
            $this->db->select($this->_select);
            $this->db->select("to_char(TRANSDATE,'DD/MM/YYYY HH24:MI:SS') as TRANSDATE", FALSE);
            $this->db->select("to_char(TERMTXTDATETIME,'DD/MM/YYYY HH24:MI:SS') as TERMTXTDATETIME", FALSE);
            $this->db->select("to_char(RESPONSEDATE,'DD/MM/YYYY HH24:MI:SS') as RESPONSEDATE", FALSE);
            if($date_from != NULL)
            $this->db->where("TRANSDATE > TO_DATE('".$date_from."', 'yyyy-mm-DD HH24:MI:SS')");
            if($date_to != NULL)
            $this->db->where("TRANSDATE < TO_DATE('".$date_to."', 'yyyy-mm-DD HH24:MI:SS')");
            if($partnerId != NULL)
            $this->db->where('PARTNERID',$partnerId);
            if($user != NULL)    
            $this->db->like('SOURCE_USER_ID',$user);
            $search = $this->db->get('TBL_TRANSACTIONS');
            return $search;
                 
    }
    
    function getPartner(){
            $partner = $this
                        ->db
                        ->select('PARTNERID,')
                        ->get('TBL_PARTNERS');
                     return $partner->result_array();
    }
    
    function getUserPartner($idPartner) {
             $user_partner = $this
                            ->db
                            ->select('SUBCRIBERID')
                            ->where('PARTNERID',$idPartner)
                            ->get('TBL_USER');
                    return $user_partner->result_array();
    }
    
    function search_partner_date_xxx($date_from,$date_to,$partnerId,$user){
        //var_dump($date_from,$date_to);die;
        
        $sql = "select
        TRANSID, REF_TRANSID, TYPE,
        AMOUNT, SOURCE_USER_ID, BONUS_ID, 
        DEST_USER_ID, PARTNERID, STATUS,
        ORG_STATUS, to_char(TRANSDATE,'DD/MM/YYYY HH24:MI:SS') as TRANSDATE,
        TRDT, ID, MEMO, PRODUCTCODE, PRODUCTQLTY, DESTPARTNERID,
        to_char(TERMTXTDATETIME,'DD/MM/YYYY HH24:MI:SS') as TERMTXTDATETIME, BAL_BEFORE, BAL_AFTER,
        to_char(RESPONSEDATE,'DD/MM/YYYY HH24:MI:SS') as RESPONSEDATE, FEE_AMOUNT";
        $sql= $sql." from TBL_TRANSACTIONS";
         if($date_from != NULL)
                $sql= $sql." where TO_CHAR(TRANSDATE,'YYYYMMDD') >= $date_from";
        if($date_to != NULL)
                $sql= $sql." and TO_CHAR(TRANSDATE,'YYYYMMDD') <= $date_to";
        if($partnerId != NULL)
                $sql= $sql." and PARTNERID = '$partnerId'";
        if($user != NULL)    
                $sql= $sql." and SOURCE_USER_ID = '$user'";
        return $re = $this->db->query($sql);

    }
    function test()
    {
        //$id = array(49,52);
        //$id = 55;
        //echo $id; die;
        //$this->db->where($this->_primary_key, $id);
        //$xxx = parent::get(2,FALSE);
        $xxx = parent::get(NULL,TRUE);
        
        return $xxx;
    }
    
}   