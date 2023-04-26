<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
approveRegistrar();
if($_GET['landing'] == "rrt"){
    header('Location:regs-req-tr.php');
}elseif($_GET['landing'] == "rrg"){
    header('Location:regs-req-gd.php');
}elseif($_GET['landing'] == "rht"){
    header('Location:regs-hld-tr.php');
}elseif($_GET['landing'] == "rhg"){
    header('Location:regs-hld-gd.php');
}else{
    header('Location:registrar.php');
}
?>