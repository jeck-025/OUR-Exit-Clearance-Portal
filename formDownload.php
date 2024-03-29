<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once ('pdfprototype/fpdi/src/autoload.php');
require_once ('pdfprototype/fpdf.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/config.php';

$dbname = "ceumnlre_ecle";
$referenceID = $_GET['referenceID'];
$config = new config;
$con = $config->con();

if($_GET['type'] == "Transfer"){
    $table = "ecle_forms_ug";
}else{
    $table = "ecle_forms";
}

$sql = "SELECT * FROM `$table` WHERE `referenceID` = '$referenceID'";
$data1 = $con->prepare($sql);
$data1->execute();
$rows1 = $data1->fetchAll(PDO::FETCH_ASSOC);
$reg_name = $rows1[0]['reg_id'];
$accountingsig = $rows1[0]['acct_asst'];

if(!empty($reg_name)){
    $sql2 = "SELECT `signature` FROM `tbl_accounts` WHERE `id` = '$reg_name'";
}else{
    $sql2 = "SELECT `signature` FROM `tbl_accounts` WHERE `username` = 'REGISTRAR'";
}

$data2 = $con-> prepare($sql2);
$data2->execute();
$rows2 = $data2->fetchAll(PDO::FETCH_ASSOC);
$registrar = $rows2[0]['signature'];

$sql3 = "SELECT * FROM `tbl_accounts` WHERE `username` = '$accountingsig'";
$data3 = $con-> prepare($sql3);
$data3->execute();
$rows3 = $data3->fetchAll(PDO::FETCH_ASSOC);

$filename="EXIT_CLEARANCE.pdf";
$college = $rows1[0]['school'];
$course = $rows1[0]['course'];

$accounting = $rows3[0]['signature'];

if(empty($rows1[0]['dean_id'])){ //execute old code without dean_id
    $sql4 = "SELECT * FROM `collegeschool` WHERE `college_school` = '$college' AND `state` = 'active'";
    $data4 = $con->query($sql4);
    $data4->execute();
    $rows4 = $data4->fetchAll(PDO::FETCH_ASSOC);
    $dean = $rows4[0]['dean'];
}else{ // execute new code with dean_id
    $dean_id = $rows1[0]['dean_id'];
    $sql4 = "SELECT * FROM `collegeschool` WHERE `id` = '$dean_id' AND `state` = 'active'";
    $data4 = $con->query($sql4);
    $data4->execute();
    $rows4 = $data4->fetchAll(PDO::FETCH_ASSOC);
    $dean = $rows4[0]['dean'];
}

    $lname = $rows1[0]['lname'];
    $fname = $rows1[0]['fname'];

    $pdf = new FPDI();
    $pdf->AddPage();
    $pdf->setSourceFile($filename);
    $template = $pdf->importPage(1);
    $pdf->useTemplate($template);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Helvetica');
    $pdf->SetFontSize(7);

    $pdf->SetXY(27, 40);
    $pdf->Write(0, $rows1[0]['lname']);
    $pdf->SetXY(54, 40);
    $pdf->Write(0, $rows1[0]['fname']);
    $pdf->SetXY(93, 40);
    $pdf->Write(0, $rows1[0]['mname']);
    $pdf->SetXY(132, 40);
    $pdf->Write(0, "(SGD.) ".strtoupper(substr($rows1[0]['fname'],0,1).substr($rows1[0]['mname'],0,1).substr($rows1[0]['lname'],0,1)));
    $pdf->SetXY(170, 40);
    $pdf->Write(0, date('Y-m-d',strtotime($rows1[0]['dateReq'])));

    $pdf->SetXY(12, 49);
    $pdf->MultiCell(34,2,$college,0,"L");
    $pdf->SetXY(52, 52);
    $pdf->Write(0, $rows1[0]['studentID']);
    $pdf->SetXY(85, 52);
    $pdf->Write(0, $rows1[0]['email']);
    $pdf->SetXY(130, 52);
    $pdf->Write(0, $rows1[0]['contact']);

    $pdf->SetXY(13, 61);
    $pdf->MultiCell(65,2,$course,0,"L");
    $pdf->SetXY(88, 63);
    $pdf->Write(0, $rows1[0]['year']);

    $pdf->SetXY(140, 80);
    $pdf->Write(0, "(SGD.) ".strtoupper($dean));
    
    $pdf->SetXY(170, 86);
    $pdf->Write(0, "(".strtoupper($rows1[0]['dean_asst']).")");
    
    $pdf->SetXY(176, 112);
    $pdf->Write(0, "(".$rows1[0]['registrar_sra'].")");

    // Signature accounting
    $pdf->Image('signatures/'.$accounting, "135","84", "50","14");

    // Signature Registrar
    $pdf->Image('signatures/'.$registrar, "135","100", "50","14");
    $pdf->Output('D', "EXIT_CLEARANCE_$lname$fname.pdf");


?>