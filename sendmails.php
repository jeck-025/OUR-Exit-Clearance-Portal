<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
sendmailLibrary();
sendmailDean();
sendmailAccounting();
sendmailGuidance();
header('Location:adminconfig.php');

?>