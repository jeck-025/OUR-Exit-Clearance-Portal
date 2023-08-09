<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
sendmailLibrary();
//sendmailDean();
sendmailAccounting();
//sendmailGuidance();
sendmailRegistrar();
sendmailSAM();
sendmailDENT();
sendmailELAMS();
sendmailGRADSCH();
sendmailMEDTECH();
sendmailMEDICINE();
sendmailNURSING();
sendmailNHM();
sendmailOPTO();
sendmailPHARM();
sendmailSCITECH();
//header('Location:adminconfig.php');

?>