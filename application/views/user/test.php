<?php

    $ng = Bin2hex_8();
    echo $ng;
    $key = "1asswordDR0wSS@P6660juht";
    $iv = "password";
    $string = md5(microtime() * mktime());
    $text = substr($string, 0, 24);
    $r = random_string('1asswordDR0wSS@P6660juht', 24);
    //echo bin2hex(mcrypt_cbc(MCRYPT_3DES, $key, $text, MCRYPT_ENCRYPT, $iv));
    btn_delete($uri);
    
    