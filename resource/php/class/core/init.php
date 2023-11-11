<?php
date_default_timezone_set('Asia/Manila');
session_start();
$GLOBALS['config'] = array(
    'mysql'=>array(
        // hostinger
        //  'local' => '109.106.254.187',
        //  'username' =>'ceumnlre_root',
        //  'password' =>'Eg5c272klko5',
        //  'db'=>'ceumnlre_ecle'

        //localhost
        'host' => '127.0.0.1:3306',
        'username' =>'root',
        'password' =>'',
        'db'=>'ceumnlre_ecle'

    ),
    'remember'=>array(
        'cookie_name' => 'hash',
        'cookie_expiry' =>604800
    ),
    'session'=>array(
        'session_name' =>'user',
        'token_name' =>'token'
    )
);

spl_autoload_register(function($class){
    require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/'.$class.'.php';

});
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/functions/sanitize.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/functions/funct.php';
if(Cookie::exists(Conf::get('remember/cookie_name')) && !Session::exists(Conf::get('session/session_name'))){
    $hash = Cookie::get(Conf::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('user_session', array('hash','=',$hash));

    if($hashCheck->count()){
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}
 ?>
