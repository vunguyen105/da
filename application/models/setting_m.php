<?php

class Setting_m extends MY_Model {
    
    public $table_name = 'setting';
    public $primary_key = 'id';

    public function __construct() {
        parent::__construct();
    }
    
    public function test()
    {
        $re = $this->db->get('product');
        return $re->result_array();
    }
    
    public function get_page($slug = NULL)//lay ra danh muc menu dau tien
    {
        if($slug != NULL)
        {    
            $get = $this
                    ->db
                    ->from('page')
                    ->join('category','page.id = category.page_id')
                    ->where('page.slug = ',$slug)
                    ->where('category.level',1)
                    ->get();
                return $get->result_array();
        }
        else
        {
            $get = $this
                    ->db
                    ->get('page');
                return $get->result_array();
        }
    }    
    
    public function get_cat($id)
    {
         $get = $this
                    ->db
                    ->where('page_id',$id)
                    ->get('category');
                return $get->result_array();
    }        
    
   
//    
//    function get_cat_item($slug)
//    {
//        $get = $this
//                    ->db
//                    ->where('slug',$slug)
//                    ->get('category')
//                    ->result_array();
//            //var_dump((int)$get[0]['id']);die;
//            $cat = $this->get_cat_parents((int)$get[0]['id']);
//            return $cat;
//    }
    
//    private function get_cat_parents($parents)
//    {
//        $get = $this
//                    ->db
//                    ->where('parents',$parents)
//                    ->get('category');
//                return $get->result_array();
//    }
    
    function get_pro($slug)
    {
        $get = $this
                    ->db
                    ->from('product')
                    ->join('category','product.category_id = category.id')
                    ->where('category.slug = ',$slug)
                    ->where('category.level',1)
                    ->get();
                return $get->result_array();
    }
    
    function getpro($id)
    {
         $get = $this
                    ->db
                    ->where('proid',$id)
                    ->get('product');
                return $get->result_array();
    }
    
    
    /*
     * 
     */
     function getcat($slug)//lay ra cac category trong page
    {
        $get = $this
                    ->db
                    ->from('page')
                    ->join('category','page.id = category.page_id')
                    ->where('page.slug = ',$slug)
                    ->where('category.statuts', 1)//status =1 la dc hien thi
                    ->get();
                return $get->result_array();
            
    }
    
    
    
    public function getpage($slug = NULL)//lay ra cac page
    {
        if($slug != NULL)
        {    
            $get = $this
                    ->db
                    ->from('page')
                    ->where('page.slug = ',$slug)
                    ->get();
                return $get->result_array();
        }
        else
        {
            $get = $this
                    ->db
                    ->get('page');
                return $get->result_array();
        }
    }
    
    function get_img_pro($id_pro)//lay ra tat ca cac anh cua 1 sp
    {
        $get = $this
                    ->db
                    ->from('files')
                    ->where('id_pro = ',$id_pro)
                    ->get();
                return $get->result_array();
    }
    function get_img_slide()//lay tat ca cac anh dc lam slide
    {
        $get = $this
                    ->db
                    ->from('slide')
                    ->where('stt',1)
                    ->get();
                return $get->result_array();
    }
    function delete_slide($id)
    {
        $delete = $this
                            ->db
                            ->where('id',$id)
                            ->delete('slide');
                    return $delete;
    }
    function get_pro_price($limit = 9,$start = 0)//lay ra cac sp dang dc giam gia
    {
         $get = $this
                    ->db
                    ->from('product')
                    ->select('product.*, category.*,page.name as page_name, page.slug as page_slug')
                    ->where('discounts is not null')
                    ->join('category','product.category_id = category.id')
                    ->where('product.status',1)
                    ->limit($limit,$start)
                    ->join('page','page.id = category.page_id') 
                    ->get();
                return $get->result_array();
    }
    
    function get_pro_new_count()//lay ra tat ca sp
    {
         $get = $this
                    ->db
                    ->from('product')
                    ->select('product.*, category.*,page.name as page_name, page.slug as page_slug')
                    ->join('category','product.category_id = category.id')
                    ->where('product.status',1)
                    ->join('page','page.id = category.page_id')
                    ->order_by('product.create_on', 'DESC');
                    return  $row = $get->count_all_results();
    }
    function get_pro_new($limit = 12,$start = 0)//lay ra sp moi
    {
         $get = $this
                    ->db
                    ->from('product')
                   ->select('product.*, category.*,page.name as page_name, page.slug as page_slug')
                    ->join('category','product.category_id = category.id')
                    ->where('product.status',1)
                    ->join('page','page.id = category.page_id')
                    ->order_by('product.create_on', 'DESC')
                    ->limit($limit,$start)
                    ->get();
                return $get->result_array();
    }
    
    function get_pro_top($limit = 20)//lay ra mang ID sp dang ban chay (sp hot)
    {
          // $this->db->select('id_pro, count( user ) AS count_row');
           //$this->db->from('bid');
           //$this->db->group_by("id_pro");
           //$this->db->order_by("count_row", "desc");
           //$this->db->limit($limit);
           //return $q = $this->db->get()->result_array();
        $get = $this
                ->db
                ->select('id_pro, count( user ) AS count_row')
                ->from('bid')
                ->group_by("id_pro")
                ->order_by("count_row", "desc")
                ->limit($limit)
                ->get();
          return $get->result_array();

    }
    function get_pro_top_detail()
    {
           $this->db->select('id_pro, count( user ) AS count_row');
           $this->db->from('bid');  
           $this->db->group_by("id_pro"); 
           $this->db->order_by("count_row", "desc");
           return $q = $this->db->get()->result_array();
    }
    function get_top($id,$limit = 9,$start = 0)//lay ra sp dang dc ban chay tu mang ID tren
    {
                //var_dump($id,$limit,$start);die;
           $get = $this->db
                    ->from('product')
                    ->select('product.*, category.name as category_name,category.description as category_description, category.slug as category_slug,page.name as page_name, page.slug as page_slug')
                    ->join('category','product.category_id = category.id')
                    ->where('product.status',1)
                    ->where_in('product.proid',$id)
                    ->limit($limit,$start)
                    ->join('page','page.id = category.page_id')
                    ->get();
                return $get->result_array();
    }
    
    function get_pro_on_page($slug,$limit = 9,$start = 0)
    {
        $get = $this->db
                    ->from('product')
                    ->select('product.*, category.name as category_name,category.description as category_description, category.slug as category_slug,page.name as page_name, page.slug as page_slug')
                    ->join('category','product.category_id = category.id')
                    ->where('product.status',1)
                    ->where('page.slug',$slug)
                    ->limit($limit, $start)
                    ->join('page','page.id = category.page_id')
                    ->get();
                return $get->result_array();
                
    }
    
    
    function get_pro_top_count_page($slug,$limit = 9,$start = 0)//lay ra tat ca sp nam trong 1 page
                                                                //1 page co the co nhieu category
    {
        $get = $this->db
                    ->from('product')
                    ->select('product.*, category.name as category_name,category.description as category_description, category.slug as category_slug,page.name as page_name, page.slug as page_slug')
                    ->join('category','product.category_id = category.id')
                    ->where('product.status',1)
                    ->where('page.slug',$slug)
                    ->limit($limit, $start)
                    ->join('page','page.id = category.page_id')
                    ->get();
                return $get->result_array();
                
    }
    function get_top_count()//dem so luong sp nam trong 1 page
    {
        
        
           $get = $this->db
                    ->from('product')
                    ->where('product.status',1);
                return $get->count_all_results();
    }
    
    
    function top_count($id)//dem so luong sp dang ban chay
    {$get = $this->db
                    ->from('product')
                    ->select('product.*, category.name as category_name,category.description as category_description, category.slug as category_slug,page.name as page_name, page.slug as page_slug')
                    ->join('category','product.category_id = category.id')
                    ->where('product.status',1)
                    ->where_in('product.proid',$id)
                    //->limit($limit,$start)
                    ->join('page','page.id = category.page_id');
                    return $get->count_all_results();
    }
    
    function get_pro_count_page($slug)
    {
        $get = $this->db
                    ->from('product')
                    ->select('product.*, category.*,page.name as page_name, page.slug as page_slug')
                    ->join('category','product.category_id = category.id')
                    ->where('product.status',1)
                    ->join('page','page.id = category.page_id')
                    ->where('page.slug',$slug);
                return $get->count_all_results();
                
    }
     function get_pro_lienquan($id,$cat)//tim sp trong cung 1 category->cac sp lien quan den nhau
    {
        $get = $this->db
                    ->from('product')
                    ->select('product.*, category.name as category_name,category.description as category_description, category.slug as category_slug,page.name as page_name, page.slug as page_slug')
                    ->join('category','product.category_id = category.id')
                    ->join('page','page.id = category.page_id')
                    ->where('product.status',1)
                    ->where('product.proid <>',$id)                    
                    //->where('product.proid',$id)
                    ->where('category.slug',$cat)
                    ->get();    
                return $get->result_array();
                
    }
    
    function updata_setting($new_data)//update lai so dien thoai dia chi.....
    {          
             $updata = $this
                            ->db
                            ->where('id',1)
                            ->update('setting',$new_data);
             return $updata;
    }
    
    function info()//lay ra nhung thong tin da update o tren
    {
        $get = $this
                    ->db
                    ->get('setting');
                return $get->result_array();
    }
    
}
?>
