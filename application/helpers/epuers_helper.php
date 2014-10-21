<?php
   
function Bin2hex_24(){
    $key = "passwordDR0wSS@P6660juht";
    $iv = "password";
    $string = md5(microtime() * mktime());
    $text = bin2hex(mcrypt_cbc(MCRYPT_3DES, $key, $string, MCRYPT_ENCRYPT, $iv));
    return substr($text, 0, 24);
}  
function Bin2hex_10(){
    $key = "passwordDR0wSS@P6660juht";
    $iv = "password";
    $string = md5(microtime() * mktime());
    $text = bin2hex(mcrypt_cbc(MCRYPT_3DES, $key, $string, MCRYPT_ENCRYPT, $iv));
    return substr($text, 0, 10);
    
}
function Bin2hex_8(){
    $key = "passwordDR0wSS@P6660juht";
    $iv = "password";
    $string = md5(microtime() * mktime());
    $text = bin2hex(mcrypt_cbc(MCRYPT_3DES, $key, $string, MCRYPT_ENCRYPT, $iv));
    return substr($text, 0, 8);
    
}
function btn_edit ($uri)
{
	return anchor($uri, '<i class="icon-edit"></i>');
}

function btn_delete ($uri)  
{
	return anchor($uri, '<i class="icon-remove"></i>', array(
		'onclick' => "return confirm('Bạn muốn chắc chắn sẽ xóa dữ liệu này đi chứ?');"
	));
}

function category_load(){ 
    $CI = & get_instance(); // to access CI resources, use $CI instead of $this
    $CI->load->library('category_lib');
    $new_nested_set = $CI->category_lib->category_initialize();
    var_dump($new_nested_set);die;
    $data['subs'] = $new_nested_set->getChildOfTree();
    var_dump($data['subs'][0]['id']);die;
    if (isset($data['subs'][0])) {
    $data['sub_menu'] = $new_nested_set->build_menu($data['subs'][0]['id']);
    }
    return $data['sub_menu'];
}
