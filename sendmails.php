<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
sendmailLibrary();
sendmailDean();
sendmailAccounting();
header('Location:adminconfig.php');

?>