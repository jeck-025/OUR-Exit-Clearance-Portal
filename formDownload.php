<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once ('pdfprototype/fpdi/src/autoload.php');
require_once ('pdfprototype/fpdf.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/config.php';


// $localhost = "127.0.0.1";
// $username = "root";
// $password = "";
$dbname = "ceumnlre_ecle";
$referenceID = $_GET['referenceID'];
$config = new config;
$con = $config->con();

if($_GET['type'] == "Transfer"){
    $table = "ecle_forms_ug";
}else{
    $table = "ecle_forms";
}

// $conn = new mysqli($localhost, $username, $password, $dbname);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

$sql = "SELECT * FROM `$table` WHERE `referenceID` = '$referenceID'";
$data1 = $con->prepare($sql);
$data1->execute();
$rows1 = $data1->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT `signature` FROM `tbl_accounts` WHERE `username` = 'REGISTRAR'";
$data2 = $con-> prepare($sql2);
$data2->execute();
$rows2 = $data2->fetchAll(PDO::FETCH_ASSOC);

$sql3 = "SELECT `signature` FROM `tbl_accounts` WHERE `username` = 'ACCOUNTING'";
$data3 = $con-> prepare($sql3);
$data3->execute();
$rows3 = $data3->fetchAll(PDO::FETCH_ASSOC);

$registrar = "";
$filename="EXIT_CLEARANCE.pdf";
$college = $rows1[0]['school'];
$course = $rows1[0]['course'];

$registrar = $rows2[0]['signature'];

$accounting = $rows3[0]['signature'];

$sql4 = "SELECT * FROM `tbl_accounts` WHERE `colleges` = '$college'";
$data4 = $con->query($sql4);
$data4->execute();
$rows4 = $data4->fetchAll(PDO::FETCH_ASSOC);

    $dean = $rows4[0]['name'];
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
    $pdf->Write(0, substr($rows1[0]['fname'],0,1).substr($rows1[0]['mname'],0,1).substr($rows1[0]['lname'],0,1)."(SGD)");
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

    $pdf->SetXY(145, 80);
    $pdf->Write(0, $dean." .(SGD)");
    
    // $pdf->SetXY(180, 112);
    // $pdf->Write(0, "(".$rows1[0]['registrar_sra'].")");

    // Signature accounting
    $pdf->Image('signatures/'.$accounting, "135","84", "50","14");

    // Signature Registrar
    $pdf->Image('signatures/'.$registrar, "135","100", "50","14");
    $pdf->Output('D', "EXIT_CLEARANCE_$lname$fname.pdf");


?>