<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
approveAccounting();
if($_GET['landing'] == "art"){
    header('Location:acct-req-tr.php');
}elseif($_GET['landing'] == "arg"){
    header('Location:acct-req-gd.php');
}elseif($_GET['landing'] == "aht"){
    header('Location:acct-hld-tr.php');
}elseif($_GET['landing'] == "ahg"){
    header('Location:acct-hld-gd.php');
}else{
    header('Location:accounting.php');
}
?>