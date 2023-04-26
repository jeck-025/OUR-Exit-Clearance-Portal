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



// $conn = new mysqli($localhost, $username, $password, $dbname);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

$sql = "SELECT * FROM `ecle_forms` WHERE `referenceID` = '$referenceID'";
$data1 = $con-> prepare($sql);
$result = $data1->execute();

$sql2 = "SELECT `signature` FROM `tbl_accounts` WHERE `username` = 'REGISTRAR'";
$data2 = $con-> prepare($sql2);
$result2 = $data2->execute();


$sql3 = "SELECT `signature` FROM `tbl_accounts` WHERE `username` = 'ACCOUNTING'";
$data3 = $con-> prepare($sql3);
$result3 = $data3->execute();

while($data = $result->fetch_assoc()) {
    $registrar = "";
    $filename="EXIT_CLEARANCE.pdf";
    $college = $data['school'];
    $course = $data['course'];

    $data2 = $result2->fetch_assoc();
    $registrar = $data2['signature'];

    $data3 = $result3->fetch_assoc();
    $accounting = $data3['signature'];

    $sql4 = "SELECT * FROM `tbl_accounts` WHERE `colleges` = '$college'";
    $result4 = $conn->query($sql4);
    $data4 = $result4->fetch_assoc();
    $dean = $data4['name'];

    $pdf = new FPDI();
    $pdf->AddPage();
    $pdf->setSourceFile($filename);
    $template = $pdf->importPage(1);
    $pdf->useTemplate($template);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Helvetica');
    $pdf->SetFontSize(7);

    $pdf->SetXY(27, 40);
    $pdf->Write(0, $data['lname']);
    $pdf->SetXY(54, 40);
    $pdf->Write(0, $data['fname']);
    $pdf->SetXY(93, 40);
    $pdf->Write(0, $data['mname']);
    $pdf->SetXY(132, 40);
    $pdf->Write(0, substr($data['fname'],0,1).substr($data['mname'],0,1).substr($data['lname'],0,1)."(SGD)");
    $pdf->SetXY(170, 40);
    $pdf->Write(0, date('Y-m-d',strtotime($data['dateReq'])));

    $pdf->SetXY(12, 49);
    $pdf->MultiCell(34,2,$college,0,"L");
    $pdf->SetXY(52, 52);
    $pdf->Write(0, $data['studentID']);
    $pdf->SetXY(85, 52);
    $pdf->Write(0, $data['email']);
    $pdf->SetXY(130, 52);
    $pdf->Write(0, $data['contact']);

    $pdf->SetXY(13, 61);
    $pdf->MultiCell(65,2,$course,0,"L");
    $pdf->SetXY(88, 63);
    $pdf->Write(0, $data['year']);

    $pdf->SetXY(145, 80);
    $pdf->Write(0, $dean."(SGD)");

    // Signature accounting
    $pdf->Image('signatures/'.$accounting, "135","84", "50","14");

    // Signature Registrar
    $pdf->Image('signatures/'.$registrar, "135","97", "50","14");
    $pdf->Output('D', "EXIT_CLEARANCE_$data[lname] $data[fname].pdf");
}

?>