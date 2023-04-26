<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
approveDepartment();

if($_GET['landing'] == "drt"){
    header('Location:dean-req-tr.php');
}elseif($_GET['landing'] == "drg"){
    header('Location:dean-req-gd.php');
}elseif($_GET['landing'] == "dht"){
    header('Location:dean-hld-tr.php');
}elseif($_GET['landing'] == "dhg"){
    header('Location:dean-hld-gd.php');
}else{
    header('Location:dean.php');
}
?>