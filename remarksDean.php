<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
holdDepartment();
 if($_POST['landing'] == "drt"){
    header('Location:dean-req-tr.php');
}elseif($_POST['landing'] == "drg"){
    header('Location:dean-req-gd.php');
}elseif($_POST['landing'] == "dht"){
    header('Location:dean-hld-tr.php');
}elseif($_POST['landing'] == "dhg"){
    header('Location:dean-hld-gd.php');
}else{
    header('Location:dean.php');
}
?>
