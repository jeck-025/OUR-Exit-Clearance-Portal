<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
holdAccounting();
 if($_POST['landing'] == "art"){
    header('Location:acct-req-tr.php');
}elseif($_POST['landing'] == "arg"){
    header('Location:acct-req-gd.php');
}elseif($_POST['landing'] == "aht"){
    header('Location:acct-hld-tr.php');
}elseif($_POST['landing'] == "ahg"){
    header('Location:acct-hld-gd.php');
}else{
    header('Location:accounting.php');
}
?>
