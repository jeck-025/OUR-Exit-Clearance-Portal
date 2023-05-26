<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once 'config.php';

class viewtable extends config{

public function viewRequestTableRegistrarTransfer(){
  $evaluator = evaluatorAssignment();
  $evaluator_name = evaluatorName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' $evaluator ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Pending for Registrar (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
  echo "<th style='width: 100px;'>Actions</th>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  $id = $data["id"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  $guidanceC = $data["guidanceclearance"];
  $guidanceR = $data["guidanceremarks"];
  $deptC = $data["departmentclearance"];
  $deptR = $data["departmentremarks"];
  $acctC = $data["accountingclearance"];
  $acctR = $data["accountingremarks"];
  $regC = $data["registrarclearance"];
  $regR = $data["registrarremarks"];
  echo "<td>
          <button class='btn btn-sm btn-block btn-success d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>
          <a href='viewRegistrar.php?id=$data[id]&type=$data[studentType]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";

  echo "</tr>";
  }

// NOT YET CLEARED FOR REGISTRAR - FOR DISPLAY ONLY
  $sql = "SELECT * FROM `ecle_forms_ug` 
          WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR 
                `departmentclearance` NOT LIKE 'CLEARED' OR
                `guidanceclearance` NOT LIKE 'CLEARED' OR 
                `accountingclearance` NOT LIKE 'CLEARED') 
                AND `registrarclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' $evaluator ORDER BY `dateReq` ASC;";

  $data2= $con->prepare($sql);
  $data2->execute();
  $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result2 as $data2) {
  echo "<tr style='font-size: 13px'>";

  $temp_lname2 = utf8_decode($data2['lname']);
  $lname2 = str_replace('?', 'Ñ', $temp_lname2);
  $temp_fname2 = utf8_decode($data2['fname']);
  $fname2 = str_replace('?', 'Ñ', $temp_fname2);
  $temp_mname2 = utf8_decode($data2['mname']);
  $mname2 = str_replace('?', 'Ñ', $temp_mname2);

  echo "<td>$data2[studentID]</td>";
	echo "<td>$fname2 $mname2 $lname2</td>";
  echo "<td>$data2[course]</td>";
  echo "<td>$data2[dateReq]</td>";
  echo "<td>$data2[referenceID]</td>";
  if($data2["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data2[departmentclearance]</span></td>";
  }elseif($data2["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data2[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data2[departmentclearance]</span></td>";
  }
  if($data2["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data2[guidanceclearance]</span></td>";
  }elseif($data2["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data2[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data2[guidanceclearance]</span></td>";
  }
  if($data2["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data2[libraryclearance]</span></td>";
  }elseif($data2["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data2[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data2[libraryclearance]</span></td>";
  }
  if($data2["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data2[accountingclearance]</span></td>";
  }elseif($data2["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data2[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data2[accountingclearance]</span></td>";
  }
  if($data2["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data2[registrarclearance]</span></td>";
  }elseif($data2["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data2[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data2[registrarclearance]</span></td>";
  }

  $id2 = $data2["id"];
  $studType2 = $data2["studentType"];
  $libraryC2 = $data2["libraryclearance"];
  $libraryR2 = $data2["libraryremarks"];
  $guidanceC2 = $data2["guidanceclearance"];
  $guidanceR2 = $data2["guidanceremarks"];
  $deptC2 = $data2["departmentclearance"];
  $deptR2 = $data2["departmentremarks"];
  $acctC2 = $data2["accountingclearance"];
  $acctR2 = $data2["accountingremarks"];
  $regC2 = $data2["registrarclearance"];
  $regR2 = $data2["registrarremarks"];

  echo "<td>
          <span class 'd-inline-block' tabindex='0' data-bs-toggle='tooltip' title='Not Yet Cleared for Registrar'>
          <button class='btn btn-sm btn-block btn-secondary d-block actions disabled' id='btn' type='button'><i class='fa-solid fa-check'></i> Sign</button>";
  echo   "<button class='btn btn-sm btn-block btn-secondary d-block actions disabled' id='btn' type='button'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>
          </span>  
          <a href='viewRegistrar.php?id=$data2[id]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewRequestTableRegistrarGraduate(){
  $evaluator = evaluatorAssignment();
  $evaluator_name = evaluatorName();
  //echo $evaluator_name;
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' $evaluator ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Pending for Registrar (Graduates)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Library</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  echo "<th style='width: 100px;'>Actions</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr style='font-size: 13px'>";

    // enye conversion
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
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
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

  echo "<td>
          <button class='btn btn-sm btn-block btn-success d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>
          <a href='viewRegistrar.php?id=$data[id]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";

  echo "</tr>";
  }

  // NOT YET CLEARED FOR REGISTRAR - FOR DISPLAY ONLY
  $sql = "SELECT * FROM `ecle_forms` 
          WHERE (`libraryclearance` NOT LIKE 'CLEARED' OR 
                `departmentclearance` NOT LIKE 'CLEARED' OR 
                `accountingclearance` NOT LIKE 'CLEARED') 
                AND `registrarclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' $evaluator ORDER BY `dateReq` ASC;";

  $data2= $con->prepare($sql);
  $data2->execute();
  $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
  foreach ($result2 as $data2) {
  echo "<tr style='font-size: 13px'>";

   // enye conversion
  $temp_lname2 = utf8_decode($data2['lname']);
  $lname2 = str_replace('?', 'Ñ', $temp_lname2);
  $temp_fname2 = utf8_decode($data2['fname']);
  $fname2 = str_replace('?', 'Ñ', $temp_fname2);
  $temp_mname2 = utf8_decode($data2['mname']);
  $mname2 = str_replace('?', 'Ñ', $temp_mname2);

  echo "<td>$data2[studentID]</td>";
  echo "<td>$fname2 $mname2 $lname2</td>";
  echo "<td>$data2[course]</td>";
  echo "<td>$data2[dateReq]</td>";
  echo "<td>$data2[referenceID]</td>";
  if($data2["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data2[libraryclearance]</span></td>";
  }elseif($data2["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data2[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data2[libraryclearance]</span></td>";
  }
  if($data2["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data2[departmentclearance]</span></td>";
  }elseif($data2["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data2[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data2[departmentclearance]</span></td>";
  }
  if($data2["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data2[accountingclearance]</span></td>";
  }elseif($data2["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data2[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data2[accountingclearance]</span></td>";
  }
  if($data2["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data2[registrarclearance]</span></td>";
  }elseif($data2["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data2[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data2[registrarclearance]</span></td>";
  }

  $id2 = $data2["id"];
  $studType2 = $data2["studentType"];
  $libraryC2 = $data2["libraryclearance"];
  $libraryR2 = $data2["libraryremarks"];
  $deptC2 = $data2["departmentclearance"];
  $deptR2 = $data2["departmentremarks"];
  $acctC2 = $data2["accountingclearance"];
  $acctR2 = $data2["accountingremarks"];
  $regC2 = $data2["registrarclearance"];
  $regR2 = $data2["registrarremarks"];

  echo "<td>
          <span class 'd-inline-block' tabindex='0' data-bs-toggle='tooltip' title='Not Yet Cleared for Registrar'>
          <button class='btn btn-sm btn-block btn-secondary d-block actions disabled' id='btn' type='button'><i class='fa-solid fa-check'></i> Sign</button>";
  echo   "<button class='btn btn-sm btn-block btn-secondary d-block actions disabled' id='btn' type='button'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>
          </span>  
          <a href='viewRegistrar.php?id=$data2[id]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewApproveTableRegistrarTransfer(){
  $evaluator = evaluatorAssignment();
  $evaluator_name = evaluatorName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Transfer' AND `expiry` = 'NO' $evaluator ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Cleared by Registrar (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  echo "</tr>";
  }
  echo "</table>";
}

public function viewApproveTableRegistrarGraduate(){
  $evaluator = evaluatorAssignment();
  $evaluator_name = evaluatorName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' $evaluator ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Cleared by Registrar (Graduates)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Library</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr style='font-size: 13px'>";
  echo "<td>$data[studentID]</td>";
  
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
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }

  echo "</tr>";
  }
  echo "</table>";
}

public function viewHoldTableRegistrarTransfer(){
  $evaluator = evaluatorAssignment();
  $evaluator_name = evaluatorName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' $evaluator ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> On-Hold by Registrar (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
  echo "<th style='width: 100px;'>Actions</th>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  $guidanceC = $data["guidanceclearance"];
  $guidanceR = $data["guidanceremarks"];
  $deptC = $data["departmentclearance"];
  $deptR = $data["departmentremarks"];
  $acctC = $data["accountingclearance"];
  $acctR = $data["accountingremarks"];
  $regC = $data["registrarclearance"];
  $regR = $data["registrarremarks"];
  echo "<td>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear </button>
          <a href='viewRegistrar.php?id=$data[id]&type=$data[studentType]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";

  echo "</tr>";
  }
  echo "</table>";
}

public function viewHoldTableRegistrarGraduate(){
  $evaluator = evaluatorAssignment();
  $evaluator_name = evaluatorName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `registrarclearance`='ON HOLD' AND `studentType` = 'Graduate' AND `expiry` = 'NO' $evaluator ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> On-Hold by Registrar (Graduates)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Library</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  echo "<th style='width: 100px;'>Actions</th>";
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
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
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
  echo "<td>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear</button>
          <a href='viewRegistrar.php?id=$data[id]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewRequestTableAccountingTransfer(){
  $acct_asst_name = acct_asstName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `accountingclearance`='PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Pending for Accounting (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
  echo "<th style='width: 100px;'>Actions</th>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  $guidanceC = $data["guidanceclearance"];
  $guidanceR = $data["guidanceremarks"];
  $deptC = $data["departmentclearance"];
  $deptR = $data["departmentremarks"];
  $acctC = $data["accountingclearance"];
  $acctR = $data["accountingremarks"];
  $regC = $data["registrarclearance"];
  $regR = $data["registrarremarks"];
  echo "<td>
          <button class='btn btn-sm btn-block btn-success d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#acctModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#acctHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>
          <a href='viewAccounting.php?id=$data[id]&type=$data[studentType]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewRequestTableAccountingGraduate(){
  $acct_asst_name = acct_asstName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `accountingclearance`='PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Pending for Accounting (Graduates)</h3>";
  echo "<div class='table-responsive'>";
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
  echo "<th style='width: 100px;'>Actions</th>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
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

  echo "<td>
          <button class='btn btn-sm btn-block btn-success d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#acctModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#acctHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>
          <a href='viewAccounting.php?id=$data[id]&type=$data[studentType]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewApproveTableAccountingTransfer(){
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `accountingclearance`='CLEARED' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Cleared by Accounting (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  echo "</tr>";
  }
  echo "</table>";
}

public function viewApproveTableAccountingGraduate(){
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `accountingclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Cleared by Accounting (Graduates)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Library</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
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
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  echo "</tr>";
  }
  echo "</table>";
}

public function viewHoldTableAccountingTransfer(){
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `accountingclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> On-Hold by Accounting (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
  echo "<th style='width: 100px;'>Actions</th>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  $guidanceC = $data["guidanceclearance"];
  $guidanceR = $data["guidanceremarks"];
  $deptC = $data["departmentclearance"];
  $deptR = $data["departmentremarks"];
  $acctC = $data["accountingclearance"];
  $acctR = $data["accountingremarks"];
  $regC = $data["registrarclearance"];
  $regR = $data["registrarremarks"];
  echo "<td>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#acctHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear </button>
          <a href='viewAccounting.php?id=$data[id]&type=$data[studentType]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewHoldTableAccountingGraduate(){
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `accountingclearance`='ON HOLD' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> On-Hold by Accounting (Graduates)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Library</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  echo "<th style='width: 100px;'>Actions</th>";
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
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
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
  echo "<td>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#acctHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear </button>
          <a href='viewAccounting.php?id=$data[id]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewRequestTableDepartmentTransfer(){
  $user = new user();
  $department = $user->data()->colleges;
  $dean_asst_name = dean_asstName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `departmentclearance`='PENDING' AND `school` = '$department' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Pending for $department (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
  echo "<th style='width: 100px;'>Actions</th>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  $guidanceC = $data["guidanceclearance"];
  $guidanceR = $data["guidanceremarks"];
  $deptC = $data["departmentclearance"];
  $deptR = $data["departmentremarks"];
  $acctC = $data["accountingclearance"];
  $acctR = $data["accountingremarks"];
  $regC = $data["registrarclearance"];
  $regR = $data["registrarremarks"];
  echo "<td>
          <button class='btn btn-sm btn-block btn-success d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#deanModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#deanHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>
          <a href='viewDean.php?id=$data[id]&type=$data[studentType]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewRequestTableDepartmentGraduate(){
  $user = new user();
  $department = $user->data()->colleges;
  $dean_asst_name = dean_asstName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `departmentclearance`='PENDING' AND `school` = '$department' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Pending for $department (Graduates)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Library</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  echo "<th style='width: 100px;'>Actions</th>";
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
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
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
  echo "<td>
          <button class='btn btn-sm btn-block btn-success d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#deanModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#deanHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>
          <a href='viewDean.php?id=$data[id]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewApproveTableDepartmentTransfer(){
  $user = new user();
  $department = $user->data()->colleges;
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `departmentclearance`='CLEARED' AND `school` = '$department' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Cleared by $department (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  echo "</tr>";
  }
  echo "</table>";
}

public function viewApproveTableDepartmentGraduate(){
  $user = new user();
  $department = $user->data()->colleges;
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `departmentclearance`='CLEARED' AND `school` = '$department' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Cleared by $department (Graduates)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 13px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Library</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr style='font-size: 12px'>";
  
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
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  echo "</tr>";
  }
  echo "</table>";
}

public function viewHoldTableDepartmentTransfer(){
  $user = new user();
  $department = $user->data()->colleges;
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `departmentclearance`='ON HOLD' AND `school` = '$department' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> On-Hold by $department (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
  echo "<th style='width: 100px;'>Actions</th>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  $guidanceC = $data["guidanceclearance"];
  $guidanceR = $data["guidanceremarks"];
  $deptC = $data["departmentclearance"];
  $deptR = $data["departmentremarks"];
  $acctC = $data["accountingclearance"];
  $acctR = $data["accountingremarks"];
  $regC = $data["registrarclearance"];
  $regR = $data["registrarremarks"];
  echo "<td>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#deanHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear </button>
          <a href='viewDean.php?id=$data[id]&type=Transfer' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewHoldTableDepartmentGraduate(){
  $user = new user();
  $department = $user->data()->colleges;
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `departmentclearance`='ON HOLD' AND `school` = '$department' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> On-Hold by $department (Graduates)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Library</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  echo "<th style='width: 100px;'>Actions</th>";
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
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
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
  echo "<td>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#deanHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear </button>
          <a href='viewDean.php?id=$data[id]' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewRequestTableLibraryTransfer(){
  $libr_asst_name = libr_asstName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `libraryclearance`='PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Pending for Library (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
  echo "<th style='width: 100px;'>Actions</th>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  $guidanceC = $data["guidanceclearance"];
  $guidanceR = $data["guidanceremarks"];
  $deptC = $data["departmentclearance"];
  $deptR = $data["departmentremarks"];
  $acctC = $data["accountingclearance"];
  $acctR = $data["accountingremarks"];
  $regC = $data["registrarclearance"];
  $regR = $data["registrarremarks"];
  echo "<td>
          <button class='btn btn-sm btn-block btn-success d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#librModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#librHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>
          <a href='viewLibrary.php?id=$data[id]&type=$studType' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewRequestTableLibraryGraduate(){
  $libr_asst_name = libr_asstName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `libraryclearance`='PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Pending for Library (Graduates)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Library</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  echo "<th style='width: 100px;'>Actions</th>";
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
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
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
  echo "<td>
          <button class='btn btn-sm btn-block btn-success d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#librModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#librHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>
          <a href='viewLibrary.php?id=$data[id]&type=$studType' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewApproveTableLibraryTransfer(){
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `libraryclearance`='CLEARED' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Cleared by Library (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  echo "</tr>";
  }
  echo "</table>";
}

public function viewApproveTableLibraryGraduate(){
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `libraryclearance`='CLEARED' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Cleared by Library (Graduates)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Library</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr style='font-size: 13px'>";
  echo "<td>$data[studentID]</td>";
  
  $temp_lname = utf8_decode($data['lname']);
  $lname = str_replace('?', 'Ñ', $temp_lname);
  $temp_fname = utf8_decode($data['fname']);
  $fname = str_replace('?', 'Ñ', $temp_fname);
  $temp_mname = utf8_decode($data['mname']);
  $mname = str_replace('?', 'Ñ', $temp_mname);

  echo "<td>$fname $mname $lname</td>";
  echo "<td>$data[course]</td>";
  echo "<td>$data[dateReq]</td>";
  echo "<td>$data[referenceID]</td>";
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  echo "</tr>";
  }
  echo "</table>";
}

public function viewHoldTableLibraryTransfer(){
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `libraryclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> On-Hold by Library (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
  echo "<th style='width: 100px;'>Actions</th>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  $guidanceC = $data["guidanceclearance"];
  $guidanceR = $data["guidanceremarks"];
  $deptC = $data["departmentclearance"];
  $deptR = $data["departmentremarks"];
  $acctC = $data["accountingclearance"];
  $acctR = $data["accountingremarks"];
  $regC = $data["registrarclearance"];
  $regR = $data["registrarremarks"];
  echo "<td>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#librHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear </button>
          <a href='viewLibrary.php?id=$data[id]&type=$studType' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewHoldTableLibraryGraduate(){
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `libraryclearance`='ON HOLD' AND `studentType` = 'Graduate' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> On-Hold by Library (Graduates)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Library</th>";
  echo "<th>Dean's Ofc.</th>";
  echo "<th>Accounting</th>";
  echo "<th>Registrar</th>";
  echo "<th style='width: 100px;'>Actions</th>";
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
 if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["departmentclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[departmentclearance]</span></td>";
  }elseif($data["departmentclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
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
  echo "<td>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#librHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear </button>
          <a href='viewLibrary.php?id=$data[id]&type=$studType' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewRequestTableGuidanceTransfer(){
  $guid_asst_name = guid_asstName();
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `guidanceclearance`='PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Pending for Guidance (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
  echo "<th style='width: 100px;'>Actions</th>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }

  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  $guidanceC = $data["guidanceclearance"];
  $guidanceR = $data["guidanceremarks"];
  $deptC = $data["departmentclearance"];
  $deptR = $data["departmentremarks"];
  $acctC = $data["accountingclearance"];
  $acctR = $data["accountingremarks"];
  $regC = $data["registrarclearance"];
  $regR = $data["registrarremarks"];
  echo "<td>
          <button class='btn btn-sm btn-block btn-success d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#guidModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#guidHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>
          <a href='viewGuidance.php?id=$data[id]&type=$studType' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewHoldTableGuidanceTransfer(){
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `guidanceclearance`='ON HOLD' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> On-Hold by Guidance (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
  echo "<th style='width: 100px;'>Actions</th>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }

  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  $guidanceC = $data["guidanceclearance"];
  $guidanceR = $data["guidanceremarks"];
  $deptC = $data["departmentclearance"];
  $deptR = $data["departmentremarks"];
  $acctC = $data["accountingclearance"];
  $acctR = $data["accountingremarks"];
  $regC = $data["registrarclearance"];
  $regR = $data["registrarremarks"];
  echo "<td>";
  echo   "<button class='btn btn-sm btn-block btn-warning d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#guidHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear </button>
          <a href='viewGuidance.php?id=$data[id]&type=$studType' class='btn my-1 btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
          include "modals.php";
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}

public function viewApproveTableGuidanceTransfer(){
  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug` WHERE `guidanceclearance`='CLEARED' AND `studentType` = 'Transfer' AND `expiry` = 'NO' ORDER BY `dateReq` ASC";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Cleared by Guidance (Transfers)</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
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
    echo "<td class='text-center'><span class='badge bg-warning'>$data[departmentclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[departmentclearance]</span></td>";
  }
  if($data["guidanceclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  }elseif($data["guidanceclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  }
  if($data["libraryclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[libraryclearance]</span></td>";
  }elseif($data["libraryclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[libraryclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[libraryclearance]</span></td>";
  }
  if($data["accountingclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[accountingclearance]</span></td>";
  }elseif($data["accountingclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[accountingclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[accountingclearance]</span></td>";
  }
  if($data["registrarclearance"] === "PENDING"){
    echo "<td class='text-center'><span class='badge bg-secondary'>$data[registrarclearance]</span></td>";
  }elseif($data["registrarclearance"] === "ON HOLD"){
    echo "<td class='text-center'><span class='badge bg-warning'>$data[registrarclearance]</span></td>";
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]</span></td>";
  }
  echo "</tr>";
  }
  echo "</table>";
}

public function viewCountPendingGuidanceTR(){
  $con = $this->con();
  $sql = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `guidanceclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO'";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchColumn();
  return $result;
}

public function viewTotalGuidance(){
  $con = $this->con();
  $sql = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `guidanceclearance` = 'PENDING' AND `expiry` = 'NO'";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchColumn();
  return $result;
}

public function viewReports(){

  echo "<h3 class='text-center'>Reports of all Students</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='reports' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 16px'>";
  echo "<thead class='thead-dark'>";
  echo "<a href='reportsDownload.php' style='font-size: 19px; color:blue'>Export table</a>";

  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms`";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);

  $sql2 = "SHOW columns FROM `ecle_forms`";
  $data2 = $con->prepare($sql2);
  $data2->execute();
  $header = $data2->fetchAll(PDO::FETCH_ASSOC);
  
  foreach($header as $head){
    echo "<th>$head[Field]</th>";
  }
  echo "</thead>";

  foreach($result as $data){
    echo "<tr style='font-size: 12px'>";
    echo "<td>$data[id]</td>";
    echo "<td>$data[lname]</td>";
    echo "<td>$data[fname]</td>";
    echo "<td>$data[mname]</td>";
    echo "<td>$data[semester]</td>";
    echo "<td>$data[sy]</td>";
    echo "<td>$data[dateReq]</td>";
    echo "<td>$data[school]</td>";
    echo "<td>$data[schoolABBR]</td>";
    echo "<td>$data[studentID]</td>";
    echo "<td>$data[email]</td>";
    echo "<td>$data[contact]</td>";
    echo "<td>$data[bday]</td>";
    echo "<td>$data[course]</td>";
    echo "<td>$data[courseABBR]</td>";
    echo "<td>$data[year]</td>";
    echo "<td>$data[transferredSchool]</td>";
    echo "<td>$data[reason]</td>";
    echo "<td>$data[studentType]</td>";
    echo "<td>$data[schoolType]</td>";
    echo "<td>$data[referenceID]</td>";
    echo "<td>$data[libraryclearance]</td>";
    echo "<td>$data[libraryremarks]</td>";
    echo "<td>$data[librarydate]</td>";
    echo "<td>$data[guidanceclearance]</td>";
    echo "<td>$data[departmentclearance]</td>";
    echo "<td>$data[departmentremarks]</td>";
    echo "<td>$data[departmentdate]</td>";
    echo "<td>$data[accountingclearance]</td>";
    echo "<td>$data[accountingremarks]</td>";
    echo "<td>$data[accountingdate]</td>";
    echo "<td>$data[registrarclearance]</td>";
    echo "<td>$data[registrarremarks]</td>";
    echo "<td>$data[registrardate]</td>";
    echo "<td>$data[expiry]</td>";
    echo "</tr>";
  }
  echo "</table>";
}

public function viewTotalRegistrar(){
  evaluatorAssignment();
  $evaluator = evaluatorAssignment();
  $con = $this->con();
  $sql = "SELECT COUNT(*) FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' $evaluator";
  $data= $con->prepare($sql);
  $data->execute();
  $result1 = $data->fetchColumn();

  $sql2 = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' $evaluator";
  $data2= $con->prepare($sql2);
  $data2->execute();
  $result2 = $data2->fetchColumn();

  $total = $result1 + $result2;
  return $total;
}

public function viewCountPendingRegistrarTR(){
  evaluatorAssignment();
  $evaluator = evaluatorAssignment();
  $con = $this->con();
  $sql = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' AND `studentType` = 'Transfer' $evaluator";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchColumn();
  return $result;
}

public function viewCountPendingRegistrarGD(){
  evaluatorAssignment();
  $evaluator = evaluatorAssignment();
  $con = $this->con();
  $sql = "SELECT COUNT(*) FROM `ecle_forms` WHERE `registrarclearance` = 'PENDING' AND `accountingclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `expiry` = 'NO' AND `studentType` = 'Graduate' $evaluator";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchColumn();
  return $result;
}

public function viewTotalAccounting(){
  $con = $this->con();
  $sql = "SELECT COUNT(*) FROM `ecle_forms` WHERE `accountingclearance` = 'PENDING' AND `expiry` = 'NO'";
  $data= $con->prepare($sql);
  $data->execute();
  $result1 = $data->fetchColumn();

  $sql2 = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `accountingclearance` = 'PENDING' AND `expiry` = 'NO'";
  $data2= $con->prepare($sql2);
  $data2->execute();
  $result2= $data2->fetchColumn();

  $total = $result1 + $result2;
  return $total;
}

public function viewCountPendingAccountingTR(){
  $con = $this->con();
  $sql = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `accountingclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO'";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchColumn();
  return $result;
}

public function viewCountPendingAccountingGD(){
  $con = $this->con();
  $sql = "SELECT COUNT(*) FROM `ecle_forms` WHERE `accountingclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO'";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchColumn();
  return $result;
}

public function viewTotalLibrary(){
  $con = $this->con();
  $sql = "SELECT COUNT(*) FROM `ecle_forms` WHERE `libraryclearance` = 'PENDING' AND `expiry` = 'NO'";
  $data= $con->prepare($sql);
  $data->execute();
  $result1 = $data->fetchColumn();

  $sql2 = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `libraryclearance` = 'PENDING' AND `expiry` = 'NO'";
  $data2= $con->prepare($sql2);
  $data2->execute();
  $result2 = $data2->fetchColumn();

  $total = $result1 + $result2;
  return $total;
}

public function viewCountPendingLibraryTR(){
  $con = $this->con();
  $sql = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `libraryclearance` = 'PENDING' AND `studentType` = 'Transfer' AND `expiry` = 'NO'";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchColumn();
  return $result;
}

public function viewCountPendingLibraryGD(){
  $con = $this->con();
  $sql = "SELECT COUNT(*) FROM `ecle_forms` WHERE `libraryclearance` = 'PENDING' AND `studentType` = 'Graduate' AND `expiry` = 'NO'";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchColumn();
  return $result;
}

public function viewTotalDean(){
  $con = $this->con();
  $user = new user();
  $department = $user->data()->username;
  $sql = "SELECT COUNT(*) FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$department' AND `expiry` = 'NO'";
  $data= $con->prepare($sql);
  $data->execute();
  $result1 = $data->fetchColumn();

  $sql2 = "SELECT COUNT(*) FROM `ecle_forms_UG` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$department' AND `expiry` = 'NO'";
  $data2= $con->prepare($sql2);
  $data2->execute();
  $result2 = $data2->fetchColumn();

  $total = $result1 + $result2;

  return $total;
}

public function viewCountPendingDeanTR(){
  $con = $this->con();
  $user = new user();
  $department = $user->data()->username;
  $sql = "SELECT COUNT(*) FROM `ecle_forms_ug` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$department' AND `studentType` = 'Transfer' AND `expiry` = 'NO'";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchColumn();
  return $result;
}

public function viewCountPendingDeanGD(){
  $con = $this->con();
  $user = new user();
  $department = $user->data()->username;
  $sql = "SELECT COUNT(*) FROM `ecle_forms` WHERE `departmentclearance` = 'PENDING' AND `schoolABBR` = '$department' AND `studentType` = 'Graduate' AND `expiry` = 'NO'";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchColumn();
  return $result;
}

public function viewReportsTransfer(){

  echo "<h3 class='text-center'>Reports of all Students</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='reports' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 16px'>";
  echo "<thead class='thead-dark'>";
  echo "<a href='reportsDownload.php' style='font-size: 19px; color:blue'>Export table</a>";

  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms_ug`";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);

  $sql2 = "SHOW columns FROM `ecle_forms_ug`";
  $data2 = $con->prepare($sql2);
  $data2->execute();
  $header = $data2->fetchAll(PDO::FETCH_ASSOC);
  
  foreach($header as $head){
    echo "<th>$head[Field]</th>";
  }
  echo "</thead>";

  foreach($result as $data){
    echo "<tr style='font-size: 12px'>";
    echo "<td>$data[id]</td>";
    echo "<td>$data[lname]</td>";
    echo "<td>$data[fname]</td>";
    echo "<td>$data[mname]</td>";
    echo "<td>$data[semester]</td>";
    echo "<td>$data[sy]</td>";
    echo "<td>$data[dateReq]</td>";
    echo "<td>$data[school]</td>";
    echo "<td>$data[schoolABBR]</td>";
    echo "<td>$data[studentID]</td>";
    echo "<td>$data[email]</td>";
    echo "<td>$data[contact]</td>";
    echo "<td>$data[bday]</td>";
    echo "<td>$data[course]</td>";
    echo "<td>$data[courseABBR]</td>";
    echo "<td>$data[year]</td>";
    echo "<td>$data[transferredSchool]</td>";
    echo "<td>$data[reason]</td>";
    echo "<td>$data[studentType]</td>";
    echo "<td>$data[schoolType]</td>";
    echo "<td>$data[referenceID]</td>";
    echo "<td>$data[libraryclearance]</td>";
    echo "<td>$data[libraryremarks]</td>";
    echo "<td>$data[librarydate]</td>";
    echo "<td>$data[guidanceclearance]</td>";
    echo "<td>$data[guidanceremarks]</td>";
    echo "<td>$data[guidancedate]</td>";
    echo "<td>$data[departmentclearance]</td>";
    echo "<td>$data[departmentremarks]</td>";
    echo "<td>$data[departmentdate]</td>";
    echo "<td>$data[accountingclearance]</td>";
    echo "<td>$data[accountingremarks]</td>";
    echo "<td>$data[accountingdate]</td>";
    echo "<td>$data[registrarclearance]</td>";
    echo "<td>$data[registrarremarks]</td>";
    echo "<td>$data[registrardate]</td>";
    echo "<td>$data[expiry]</td>";
    echo "</tr>";
  }
  echo "</table>";
}
}



// public function viewTransferredSchoolNames() {
//   $con = $this->con();
//   $sql = "SELECT transferredSchool, COUNT(transferredSchool) AS quantity FROM ecle_forms WHERE semester = '2' AND sy = '2022-2023' AND transferredSchool != 'NULL' GROUP BY transferredSchool";
//   $data= $con->prepare($sql);
//   $data->execute();
//   $names[] = array();
//   $result = $data->fetchAll(PDO::FETCH_ASSOC);
//   foreach($result as $row){
//     $names[] = $row['transferredSchool'];
//   }
//   unset($names[0]);
//   return $names;
//   }

// public function viewTransferredSchoolTotal() {
//   $con = $this->con();
//   $sql = "SELECT transferredSchool, COUNT(transferredSchool) AS quantity FROM ecle_forms WHERE semester = '2' AND sy = '2022-2023' AND transferredSchool != '' GROUP BY transferredSchool";
//   $data= $con->prepare($sql);
//   $data->execute();
//   $numbers[] = array();
//   $result = $data->fetchAll(PDO::FETCH_ASSOC);
//   // var_dump($result);
//   // die();
//   foreach($result as $row){
//     $numbers[] = $row['quantity'];
//   }
//   unset($numbers[0]);
//   return $numbers;
//   }

// public function viewReasonNames(){
//   $con = $this->con();
//   $sql = "SELECT reason, COUNT(reason) AS quantity FROM ecle_forms WHERE semester = '2' AND sy = '2022-2023' AND reason != 'NULL' GROUP BY reason";
//   $data= $con->prepare($sql);
//   $data->execute();
//   $reasons[] = array();
//   $result = $data->fetchAll(PDO::FETCH_ASSOC);
//   foreach($result as $row){
//     $reasons[] = $row['reason'];
//   }
//   unset($reasons[0]);
//   return $reasons;
//   }

// public function viewReasonTotal(){
//   $con = $this->con();
//   $sql = "SELECT reason, COUNT(reason) AS quantity FROM ecle_forms WHERE semester = '2' AND sy = '2022-2023' AND reason != 'NULL' GROUP BY reason";
//   $data= $con->prepare($sql);
//   $data->execute();
//   $total[] = array();
//   $result = $data->fetchAll(PDO::FETCH_ASSOC);
//   foreach($result as $row){
//     $total[] = $row['quantity'];
//   }
//   unset($total[0]);
//   return $total;
//   }
?>

