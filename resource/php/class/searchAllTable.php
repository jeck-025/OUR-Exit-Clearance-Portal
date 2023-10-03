<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once 'config.php';

class searchAllTable extends config{

  public function searchTable($key){

  $key = strtoupper($key);

  $con = $this->con();
  $sql = "SELECT * FROM `ecle_forms` WHERE `lname` LIKE '%$key%' OR `fname` LIKE '%$key%' OR `mname` LIKE '%$key%'";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> <i class='fa-solid fa-table-list'></i> Search Results for '$key'</h3>";
  echo "<hr>";
  echo "<h5 class='text-center mt-4'><i class='fa-solid fa-graduation-cap'></i> Graduates </h5>";
  echo "<div class='table-responsive border border-info pb-3'>";
  echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%' style='font-size: 12px'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Student Number</th>";
  echo "<th style='width: 250px;'>Student Name</th>";
  echo "<th>Course</th>";
  echo "<th>Date Requested</th>";
  echo "<th>Reference ID</th>";
  echo "<th>Dean's Ofc.</th>";
  // echo "<th>Guidance</th>";
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
  // if($data["guidanceclearance"] === "PENDING"){
  //   echo "<td class='text-center'><span class='badge bg-secondary'>$data[guidanceclearance]</span></td>";
  // }elseif($data["guidanceclearance"] === "ON HOLD"){
  //   echo "<td class='text-center'><span class='badge bg-warning'>$data[guidanceclearance]</span></td>";
  // }else {
  //   echo "<td class='text-center'><span class='badge bg-success'>$data[guidanceclearance]</span></td>";
  // }
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
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]<br>$data[registrardate]</span></td>";
  }
  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  // $guidanceC = $data["guidanceclearance"];
  // $guidanceR = $data["guidanceremarks"];
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

// // NOT YET CLEARED FOR REGISTRAR - FOR DISPLAY ONLY
//   $sql0 = $eval->evaluatorAssignment2UGPD();
//   $data2= $con->prepare($sql0);
//   $data2->execute();
//   $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
//   foreach ($result2 as $data2) {
//   echo "<tr style='font-size: 13px'>";

//   $temp_lname2 = utf8_decode($data2['lname']);
//   $lname2 = str_replace('?', 'Ñ', $temp_lname2);
//   $temp_fname2 = utf8_decode($data2['fname']);
//   $fname2 = str_replace('?', 'Ñ', $temp_fname2);
//   $temp_mname2 = utf8_decode($data2['mname']);
//   $mname2 = str_replace('?', 'Ñ', $temp_mname2);

//   echo "<td>$data2[studentID]</td>";
// 	echo "<td>$fname2 $mname2 $lname2</td>";
//   echo "<td>$data2[course]</td>";
//   echo "<td>$data2[dateReq]</td>";
//   echo "<td>$data2[referenceID]</td>";
//   if($data2["departmentclearance"] === "PENDING"){
//     echo "<td class='text-center'><span class='badge bg-secondary'>$data2[departmentclearance]</span></td>";
//   }elseif($data2["departmentclearance"] === "ON HOLD"){
//     echo "<td class='text-center'><span class='badge bg-warning'>$data2[departmentclearance]</span></td>";
//   }else {
//     echo "<td class='text-center'><span class='badge bg-success'>$data2[departmentclearance]</span></td>";
//   }
//   if($data2["guidanceclearance"] === "PENDING"){
//     echo "<td class='text-center'><span class='badge bg-secondary'>$data2[guidanceclearance]</span></td>";
//   }elseif($data2["guidanceclearance"] === "ON HOLD"){
//     echo "<td class='text-center'><span class='badge bg-warning'>$data2[guidanceclearance]</span></td>";
//   }else {
//     echo "<td class='text-center'><span class='badge bg-success'>$data2[guidanceclearance]</span></td>";
//   }
//   if($data2["libraryclearance"] === "PENDING"){
//     echo "<td class='text-center'><span class='badge bg-secondary'>$data2[libraryclearance]</span></td>";
//   }elseif($data2["libraryclearance"] === "ON HOLD"){
//     echo "<td class='text-center'><span class='badge bg-warning'>$data2[libraryclearance]</span></td>";
//   }else {
//     echo "<td class='text-center'><span class='badge bg-success'>$data2[libraryclearance]</span></td>";
//   }
//   if($data2["accountingclearance"] === "PENDING"){
//     echo "<td class='text-center'><span class='badge bg-secondary'>$data2[accountingclearance]</span></td>";
//   }elseif($data2["accountingclearance"] === "ON HOLD"){
//     echo "<td class='text-center'><span class='badge bg-warning'>$data2[accountingclearance]</span></td>";
//   }else {
//     echo "<td class='text-center'><span class='badge bg-success'>$data2[accountingclearance]</span></td>";
//   }
//   if($data2["registrarclearance"] === "PENDING"){
//     echo "<td class='text-center'><span class='badge bg-secondary'>$data2[registrarclearance]</span></td>";
//   }elseif($data2["registrarclearance"] === "ON HOLD"){
//     echo "<td class='text-center'><span class='badge bg-warning'>$data2[registrarclearance]</span></td>";
//   }else {
//     echo "<td class='text-center'><span class='badge bg-success'>$data2[registrarclearance]</span></td>";
//   }

//   $id2 = $data2["id"];
//   $studType2 = $data2["studentType"];
//   $libraryC2 = $data2["libraryclearance"];
//   $libraryR2 = $data2["libraryremarks"];
//   $guidanceC2 = $data2["guidanceclearance"];
//   $guidanceR2 = $data2["guidanceremarks"];
//   $deptC2 = $data2["departmentclearance"];
//   $deptR2 = $data2["departmentremarks"];
//   $acctC2 = $data2["accountingclearance"];
//   $acctR2 = $data2["accountingremarks"];
//   $regC2 = $data2["registrarclearance"];
//   $regR2 = $data2["registrarremarks"];

//   echo "<td>";
//   echo "<span class 'd-inline-block' tabindex='0' data-bs-toggle='tooltip' title='Not Yet Cleared for Registrar'>";
//   // echo "<button class='btn btn-sm btn-block btn-secondary d-block actions disabled' id='btn' type='button'><i class='fa-solid fa-check'></i> Sign</button>";
//   // echo "<button class='btn btn-sm btn-block btn-secondary d-block actions disabled' id='btn' type='button'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>";
//   echo "</span>";
//   echo "<a href='viewRegistrar.php?id=$data2[id]&type=$data2[studentType]' class='btn btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
//   echo "<button class='btn btn-sm btn-block btn-danger d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsRemove$id2' data-id='$id2'><i class='fa-solid fa-trash'></i> Remove </button>";
//       include "modals-ext.php";
//   echo "</td>";
//   echo "</tr>";
//   }
  echo "</table></div>";

    $sql = "SELECT * FROM `ecle_forms_ug` WHERE `lname` LIKE '%$key%' OR `fname` LIKE '%$key%' OR `mname` LIKE '%$key%'";
  $data= $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  // echo "<h3 class='text-center'> Search Results for '$key'</h3>";
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
  }else {
    echo "<td class='text-center'><span class='badge bg-success'>$data[registrarclearance]<br>$data[registrardate]</span></td>";
  }
  $id = $data["id"];
  $studType = $data["studentType"];
  $libraryC = $data["libraryclearance"];
  $libraryR = $data["libraryremarks"];
  // $guidanceC = $data["guidanceclearance"];
  // $guidanceR = $data["guidanceremarks"];
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

// // NOT YET CLEARED FOR REGISTRAR - FOR DISPLAY ONLY
//   $sql0 = $eval->evaluatorAssignment2UGPD();
//   $data2= $con->prepare($sql0);
//   $data2->execute();
//   $result2 = $data2->fetchAll(PDO::FETCH_ASSOC);
//   foreach ($result2 as $data2) {
//   echo "<tr style='font-size: 13px'>";

//   $temp_lname2 = utf8_decode($data2['lname']);
//   $lname2 = str_replace('?', 'Ñ', $temp_lname2);
//   $temp_fname2 = utf8_decode($data2['fname']);
//   $fname2 = str_replace('?', 'Ñ', $temp_fname2);
//   $temp_mname2 = utf8_decode($data2['mname']);
//   $mname2 = str_replace('?', 'Ñ', $temp_mname2);

//   echo "<td>$data2[studentID]</td>";
// 	echo "<td>$fname2 $mname2 $lname2</td>";
//   echo "<td>$data2[course]</td>";
//   echo "<td>$data2[dateReq]</td>";
//   echo "<td>$data2[referenceID]</td>";
//   if($data2["departmentclearance"] === "PENDING"){
//     echo "<td class='text-center'><span class='badge bg-secondary'>$data2[departmentclearance]</span></td>";
//   }elseif($data2["departmentclearance"] === "ON HOLD"){
//     echo "<td class='text-center'><span class='badge bg-warning'>$data2[departmentclearance]</span></td>";
//   }else {
//     echo "<td class='text-center'><span class='badge bg-success'>$data2[departmentclearance]</span></td>";
//   }
//   if($data2["guidanceclearance"] === "PENDING"){
//     echo "<td class='text-center'><span class='badge bg-secondary'>$data2[guidanceclearance]</span></td>";
//   }elseif($data2["guidanceclearance"] === "ON HOLD"){
//     echo "<td class='text-center'><span class='badge bg-warning'>$data2[guidanceclearance]</span></td>";
//   }else {
//     echo "<td class='text-center'><span class='badge bg-success'>$data2[guidanceclearance]</span></td>";
//   }
//   if($data2["libraryclearance"] === "PENDING"){
//     echo "<td class='text-center'><span class='badge bg-secondary'>$data2[libraryclearance]</span></td>";
//   }elseif($data2["libraryclearance"] === "ON HOLD"){
//     echo "<td class='text-center'><span class='badge bg-warning'>$data2[libraryclearance]</span></td>";
//   }else {
//     echo "<td class='text-center'><span class='badge bg-success'>$data2[libraryclearance]</span></td>";
//   }
//   if($data2["accountingclearance"] === "PENDING"){
//     echo "<td class='text-center'><span class='badge bg-secondary'>$data2[accountingclearance]</span></td>";
//   }elseif($data2["accountingclearance"] === "ON HOLD"){
//     echo "<td class='text-center'><span class='badge bg-warning'>$data2[accountingclearance]</span></td>";
//   }else {
//     echo "<td class='text-center'><span class='badge bg-success'>$data2[accountingclearance]</span></td>";
//   }
//   if($data2["registrarclearance"] === "PENDING"){
//     echo "<td class='text-center'><span class='badge bg-secondary'>$data2[registrarclearance]</span></td>";
//   }elseif($data2["registrarclearance"] === "ON HOLD"){
//     echo "<td class='text-center'><span class='badge bg-warning'>$data2[registrarclearance]</span></td>";
//   }else {
//     echo "<td class='text-center'><span class='badge bg-success'>$data2[registrarclearance]</span></td>";
//   }

//   $id2 = $data2["id"];
//   $studType2 = $data2["studentType"];
//   $libraryC2 = $data2["libraryclearance"];
//   $libraryR2 = $data2["libraryremarks"];
//   $guidanceC2 = $data2["guidanceclearance"];
//   $guidanceR2 = $data2["guidanceremarks"];
//   $deptC2 = $data2["departmentclearance"];
//   $deptR2 = $data2["departmentremarks"];
//   $acctC2 = $data2["accountingclearance"];
//   $acctR2 = $data2["accountingremarks"];
//   $regC2 = $data2["registrarclearance"];
//   $regR2 = $data2["registrarremarks"];

//   echo "<td>";
//   echo "<span class 'd-inline-block' tabindex='0' data-bs-toggle='tooltip' title='Not Yet Cleared for Registrar'>";
//   // echo "<button class='btn btn-sm btn-block btn-secondary d-block actions disabled' id='btn' type='button'><i class='fa-solid fa-check'></i> Sign</button>";
//   // echo "<button class='btn btn-sm btn-block btn-secondary d-block actions disabled' id='btn' type='button'><i class='fa-solid fa-triangle-exclamation'></i> Hold</button>";
//   echo "</span>";
//   echo "<a href='viewRegistrar.php?id=$data2[id]&type=$data2[studentType]' class='btn btn-sm d-block btn-info actions' data-toggle='tooltip' data-placement='top' title='View info'><i class='fa-solid fa-eye'></i> Info</a>";
//   echo "<button class='btn btn-sm btn-block btn-danger d-block actions' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsRemove$id2' data-id='$id2'><i class='fa-solid fa-trash'></i> Remove </button>";
//       include "modals-ext.php";
//   echo "</td>";
//   echo "</tr>";
//   }
  echo "</table></div>";
}

}
?>

