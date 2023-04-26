<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once('fpdf.php');
require_once('fpdi/src/autoload.php');

$filename="applicationtest.pdf";
$lastname="Bolasoc";
$pdf = new FPDI();
$pdf->AddPage();
$pdf->setSourceFile($filename);
$template = $pdf->importPage(1);
$pdf->useTemplate($template);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Helvetica');
$pdf->SetFontSize(5.5);
$pdf->SetXY(47, 45);
$pdf->Write(0, $lastname);
$pdf->Image('signature/signature.png', "135","213", "40","12");
// $pdf->Write(0, date("Y-m-d"));
// $pdf->Output('D');
$pdf->Output('F',$_SERVER["DOCUMENT_ROOT"].'/pdfprototype/'.$filename);
header('Location: index.php');
?>
