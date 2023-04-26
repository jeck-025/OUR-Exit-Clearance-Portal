<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
holdRegistrar();
 if($_POST['landing'] == "rrt"){
    header('Location:regs-req-tr.php');
}elseif($_POST['landing'] == "rrg"){
    header('Location:regs-req-gd.php');
}elseif($_POST['landing'] == "rht"){
    header('Location:regs-hld-tr.php');
}elseif($_POST['landing'] == "rhg"){
    header('Location:regs-hld-gd.php');
}else{
    header('Location:registrar.php');
}
?>
