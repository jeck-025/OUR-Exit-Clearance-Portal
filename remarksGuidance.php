<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
holdGuidance();
 if($_POST['landing'] == "grt"){
    header('Location:guid-req-tr.php');
}elseif($_POST['landing'] == "ght"){
    header('Location:guid-hld-tr.php');
}else{
    header('Location:guidance.php');
}
?>
