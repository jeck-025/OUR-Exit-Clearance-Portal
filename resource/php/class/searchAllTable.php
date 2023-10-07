<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once 'config.php';

class searchAllTable extends config{

  public function searchTable($key){

  $key = strtoupper($key);

  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `lname` LIKE '%$key%' OR `fname` LIKE '%$key%' OR `mname` LIKE '%$key%' OR `course` LIKE '%$key%'";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> <i class='fa-solid fa-table-list'></i> Search Results for '$key'</h3>";
  echo "<hr>";
  echo "<h5 class='text-center mt-4'><i class='fa-solid fa-graduation-cap'></i> Graduates </h5>";
  echo "<div class='table-responsive pb-3'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Library</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  // echo "<th style='width: 100px;'>Actions</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr style='font-size: 13px'>";

  $temp_lname = utf8_decode($data['lname']);
  $lname = str_replace('?', 'Ñ', $temp_lname);
  $temp_fname = utf8_decode($data['fname']);
  $fname = str_replace('?', 'Ñ', $temp_fname);
  $temp_mname = utf8_decode($data['mname']);
  $mname = str_replace('?', 'Ñ', $temp_mname);

  echo "<td>$data[studentID]</td>";
  echo "<td>$fname $mname $lname</td>";
  echo "<td>$data[course]</td>";
  echo "<td>$data[dateReq]</td>";
  echo "<td>$data[referenceID]</td>";

  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]<br>$data[departmentdate]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]<br>$data[departmentdate]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]<br>$data[librarydate]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]<br>$data[librarydate]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]<br>$data[accountingdate]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]<br>$data[accountingdate]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]<br>$data[registrardate]</span></td>";
  }elseif($data["registrarclearance"] === "REMOVED"){
    echo "<td class='text-center'><span class='badge bg-danger'>$data[registrarclearance]<br>$data[registrardate]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]<br>$data[registrardate]</span></td>";
  }
  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  $deptC = $data["departmentclearance"];
  $deptR = $data["departmentremarks"];
  $acctC = $data["accountingclearance"];
  $acctR = $data["accountingremarks"];
  $regC = $data["registrarclearance"];
  $regR = $data["registrarremarks"];

  // echo "<td>";
  // // echo "<button class='btn btn-sm btn-block btn-success d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
  // // echo "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>";
  // echo "<a href='viewRegistrar.php?id=$data[id]&type=$data[studentType]' class='btn btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
  // echo "<button class='btn btn-sm btn-block btn-danger d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsRemove$id' data-id='$id'><i class='fa-solid fa-trash'></i> Remove </button>";
  //         include "modals.php";
  // echo "</td>";

  echo "</tr>";
  }


  echo "</table></div>";

  $sql0 = "SELECT * FROM `ecle_forms_ug` WHERE `lname` LIKE '%$key%' OR `fname` LIKE '%$key%' OR `mname` LIKE '%$key%'";
  $data0= $con->prepare($sql0);
  $data0->execute();
  $result0 = $data0->fetchAll(PDO::FETCH_ASSOC);
  echo "<hr>";
  echo "<h5 class='text-center mt-4'><i class='fa-solid fa-user'></i> Undergraduates / Transferees</h5>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable2' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Guidance</th>";
  echo "<th>Library</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  // echo "<th style='width: 100px;'>Actions</th>";
  echo "</thead>";
  foreach ($result0 as $data0) {
  echo "<tr style='font-size: 13px'>";

  $temp_lname = utf8_decode($data0['lname']);
  $lname = str_replace('?', 'Ñ', $temp_lname);
  $temp_fname = utf8_decode($data0['fname']);
  $fname = str_replace('?', 'Ñ', $temp_fname);
  $temp_mname = utf8_decode($data0['mname']);
  $mname = str_replace('?', 'Ñ', $temp_mname);

  echo "<td>$data0[studentID]</td>";
  echo "<td>$fname $mname $lname</td>";
  echo "<td>$data0[course]</td>";
  echo "<td>$data0[dateReq]</td>";
  echo "<td>$data0[referenceID]</td>";

  if($data0["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data0[departmentclearance]</span></td>";
  }elseif($data0["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data0[departmentclearance]<br>$data0[departmentdate]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data0[departmentclearance]<br>$data0[departmentdate]</span></td>";
  }
  if($data0["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data0[guidanceclearance]</span></td>";
  }elseif($data0["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data0[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data0[guidanceclearance]</span></td>";
  }
  if($data0["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data0[libraryclearance]</span></td>";
  }elseif($data0["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data0[libraryclearance]<br>$data0[librarydate]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data0[libraryclearance]<br>$data0[librarydate]</span></td>";
  }
  if($data0["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data0[accountingclearance]</span></td>";
  }elseif($data0["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data0[accountingclearance]<br>$data0[accountingdate]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data0[accountingclearance]<br>$data0[accountingdate]</span></td>";
  }
  if($data0["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data0[registrarclearance]</span></td>";
  }elseif($data0["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data0[registrarclearance]<br>$data0[registrardate]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data0[registrarclearance]<br>$data0[registrardate]</span></td>";
  }
  $id = $data0["id"];
  $studType = $data0["studentType"];
  $libraryC = $data0["libraryclearance"];
  $libraryR = $data0["libraryremarks"];
  $deptC = $data0["departmentclearance"];
  $deptR = $data0["departmentremarks"];
  $acctC = $data0["accountingclearance"];
  $acctR = $data0["accountingremarks"];
  $regC = $data0["registrarclearance"];
  $regR = $data0["registrarremarks"];

  // echo "<td>";
  // // echo "<button class='btn btn-sm btn-block btn-success d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
  // // echo "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>";
  // echo "<a href='viewRegistrar.php?id=$data[id]&type=$data[studentType]' class='btn btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
  // echo "<button class='btn btn-sm btn-block btn-danger d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsRemove$id' data-id='$id'><i class='fa-solid fa-trash'></i> Remove </button>";
  //         include "modals.php";
  // echo "</td>";

  echo "</tr>";
  }
  echo "</table></div>";
}

}
?>

