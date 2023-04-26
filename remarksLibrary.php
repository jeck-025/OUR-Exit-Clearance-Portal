<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
holdLibrary();
 if($_POST['landing'] == "lrt"){
    header('Location:libr-req-tr.php');
}elseif($_POST['landing'] == "lrg"){
    header('Location:libr-req-gd.php');
}elseif($_POST['landing'] == "lht"){
    header('Location:libr-hld-tr.php');
}elseif($_POST['landing'] == "lhg"){
    header('Location:libr-hld-gd.php');
}else{
    header('Location:library.php');
}
?>
