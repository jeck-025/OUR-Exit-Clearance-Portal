<?php
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

require_once ('pdfprototype/fpdi/src/autoload.php');
require_once ('pdfprototype/fpdf.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/config.php';

$dbname = "ceumnlre_ecle";
$config = new config;
$con = $config->con();

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Reports.csv');

if(isset($_GET['g_submit'])){
    if(!empty($_GET['r_semester']) && !empty($_GET['r_sy']))
    {
        // download specific semester
        $sql = "SELECT * FROM `ecle_forms` WHERE `sy` = '$_GET[r_sy]' AND `semester` = '$_GET[r_semester]' ";
        $data1 = $con->prepare($sql);
        $data1->execute();
        $rows1 = $data1->fetchAll(PDO::FETCH_ASSOC);

    }else{
        // download all
        $sql = "SELECT * FROM `ecle_forms`";
        $data1 = $con->prepare($sql);
        $data1->execute();
        $rows1 = $data1->fetchAll(PDO::FETCH_ASSOC);
    }

    $sql2 = "SHOW COLUMNS FROM `ecle_forms`";
    $data2 = $con-> prepare($sql2);
    $data2->execute();
    $rows2 = $data2->fetchAll(PDO::FETCH_ASSOC);
    $heads[] = array();

}elseif(isset($_GET['u_submit'])){
    if(!empty($_GET['r_semester']) && !empty($_GET['r_sy']))
    {
        // download specific semester
        $sql = "SELECT * FROM `ecle_forms_ug` WHERE `sy` = '$_GET[r_sy]' AND `semester` = '$_GET[r_semester]' ";
        $data1 = $con->prepare($sql);
        $data1->execute();
        $rows1 = $data1->fetchAll(PDO::FETCH_ASSOC);

    }else{
        // download all
        $sql = "SELECT * FROM `ecle_forms_ug`";
        $data1 = $con->prepare($sql);
        $data1->execute();
        $rows1 = $data1->fetchAll(PDO::FETCH_ASSOC);
    }

    $sql2 = "SHOW COLUMNS FROM `ecle_forms_ug`";
    $data2 = $con-> prepare($sql2);
    $data2->execute();
    $rows2 = $data2->fetchAll(PDO::FETCH_ASSOC);
    $heads[] = array();

}else{
    echo "Error";
    die();
}

$output = fopen('php://output', 'w');

foreach($rows2 as $head){
$heads[] = $head['Field'];
}

unset($heads[0]);
fputcsv($output, $heads);

foreach($rows1 as $row){
fputcsv($output, $row);
}

?>