<?php
class Mupload extends CI_Model{
	protected $_table = "files";
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function insert_file($data){
		$this->db->insert($this->_table,$data);
		return $this->db->insert_id();
	}
	public function get_all_files($file_id =""){
		if($file_id != ""){
			$this->db->where("id",$file_id);
		}
		return $this->db->get($this->_table)->result_array();
	}
        
        public function get_files_pro($file_id =""){
		if($file_id != ""){
			$this->db->where("id_pro",$file_id);
		}
		return $this->db->get($this->_table)->result_array();
	}
	public function delete_file($file_id){
		$file = $this->get_all_files($file_id);
		if($file == ""){
			return FALSE;
		}else{
			$this->db->where("id",$file_id);
			$this->db->delete($this->_table);
			//echo "./upload/" + $file[0]['file_name'];
			unlink("./file/" . $file[0]['file_name']);
                        $thum = explode('.', $file[0]['file_name']);
                        unlink("./file/" . $thum[0].'_thumb.'.$thum[1]);
			return TRUE;
		}		
	}
        
        public function delete_file_pro($file_id){
		$file = $this->get_files_pro($file_id);
		if($file == ""){
			return FALSE;
		}else{
                    if(!empty($file)){
			$this->db->where("id_pro",$file[0]['id_pro']);
			$this->db->delete($this->_table);
                        $count = count($file);
                        for($i= 0; $i < $count; $i ++)
                        {
                            unlink("./file/" . $file[$i]['file_name']);
                            $thum = explode('.', $file[$i]['file_name']);
                            unlink("./file/" . $thum[$i].'_thumb.'.$thum[1]);
                        }    
			return TRUE;
                    }
		}		
	}
        
        
        public function insert_file_slide($data){
		$this->db->insert('slide',$data);
		return $this->db->insert_id();
	}
        
        public function get_files($file_id =""){
		if($file_id != ""){
			$this->db->where("id",$file_id);
		}
		return $this->db->get(slide)->result_array();
	}
        
}