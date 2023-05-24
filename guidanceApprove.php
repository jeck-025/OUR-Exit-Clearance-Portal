<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
approveGuidance();
if($_GET['landing'] == "grt"){
    header('Location:guid-req-tr.php');
}elseif($_GET['landing'] == "ght"){
    header('Location:guid-hld-tr.php');
}else{
    header('Location:guidance.php');
}
?>