<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once('fpdf.php');
require_once('fpdi/src/autoload.php');

$filename="ADSUARA CHRISTINE C. BSN-STEM1.pdf";

$pdf = new FPDI();
$pdf->AddPage();
$pdf->setSourceFile($filename);
$template = $pdf->importPage(1);
$pdf->useTemplate($template);
// $pdf->Output('D');
$pdf->Output("I");
?>
