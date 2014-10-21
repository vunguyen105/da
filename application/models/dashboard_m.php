
<?php

class Dashboard_m extends MY_Model
{
    
    protected $_table_name = 'users';
	protected $_order_by = 'username';
	public $rules = array(
		'username' => array(
			'field' => 'username',
			'label' => 'Tài khoản',
			'rules' => 'trim|required|callback_checkuser|xss_clean'
		),
		'firstname' => array(
			'field' => 'firstname',
			'label' => 'Họ',
			'rules' => 'trim|required'
		),
                'lastname' => array(
			'field' => 'lastname',
			'label' => 'Tên',
			'rules' => 'trim|required'
		),
                'password' => array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|matches[cpassword]'
		),
		'cpassword' => array(
			'field' => 'cpassword',
			'label' => 'Confirm password',
			'rules' => 'trim|matches[password]'
		),
	);
	public $rules_admin = array(
		'username' => array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'trim|required|xss_clean'
		),
		'email' => array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'trim|required|valid_email|callback__unique_email|xss_clean'
		),
		'password' => array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|matches[password_confirm]'
		),
		'password_confirm' => array(
			'field' => 'password_confirm',
			'label' => 'Confirm password',
			'rules' => 'trim|matches[password]'
		),
	);
    
    function __construct() {
        parent::__construct();
    }

    function create_user($new_member_insert_data) {     
        $insert= $this->db->insert('user', $new_member_insert_data);
        return $insert;
    	}   
    
    public function get($user_id=NULL)
        {
        if($user_id==NULL){
            $query =  $this
                        ->db
                        ->get('user');
                return $query->result_array();
        } else {
                $query =$this
                           ->db
                           ->where('id', $user_id)

                           ->get('user');
                if($query->num_rows == 1){
                    return $query->result_array();
                }
               else return false;
           }
        }


        public function get_user($user)
        {
                $query =$this
                           ->db
                           ->where('user_name', $user)

                           ->get('user');
                if($query->num_rows == 1){
                    return $query->result_array();
                }
               else return false;
        }

        public function edit($new_data,$id)
        {
            $updata = $this
                            ->db
                            ->where('id',$id)
                            ->update('user',$new_data);
             return $updata;
        }

        public function delete($user_id)
        {
             $delete = $this
                            ->db
                            ->where('id',$user_id)
                            ->delete('user');
                    return $delete;
        }

        function create($new_member_insert_data) {
        $insert= $this->db->insert('user', $new_member_insert_data);
        return $insert;
    	}

	    function update($new_member_insert_data)
	    {
	    	$updata = $this
                         ->db
                         ->where('user_name',$this->session->userdata['user'])
                         ->update('user',$new_member_insert_data);
                 return $updata;
	    }
     function verify_user($username,$password){

        $this->db->from('users');
        $this->db->where('username',$username);
        $this->db->where('password',md5($password));
        $q = $this->db->get()->result();
        if(!empty($q)) return $q[0];
        else return false;
    }
}