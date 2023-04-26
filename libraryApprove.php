<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
approveLibrary();
if($_GET['landing'] == "lrt"){
    header('Location:libr-req-tr.php');
}elseif($_GET['landing'] == "lrg"){
    header('Location:libr-req-gd.php');
}elseif($_GET['landing'] == "lht"){
    header('Location:libr-hld-tr.php');
}elseif($_GET['landing'] == "lhg"){
    header('Location:libr-hld-gd.php');
}else{
    header('Location:library.php');
}
?>