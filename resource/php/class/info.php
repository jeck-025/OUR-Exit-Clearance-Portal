 <?php

class info extends config{
    public $id, $type;

    public function __construct($id = NULL, $type = NULL){
        $this->id = $id;
        $this->type = $type;
    }

    public function infoAccounting(){
        $con = $this->con();
        if($this->type == "Graduate"){
          $sql = "SELECT * FROM `ecle_forms` WHERE `id` = '$this->id'";
        }else{
          $sql = "SELECT * FROM `ecle_forms_ug` WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

          $id = $result[0]["id"];                 // PK
          $studID = $result[0]["studentID"];      // index
          $refID = $result[0]["referenceID"];
          $temp_lname = utf8_decode($result[0]["lname"]);
          $lname = str_replace('?', 'Ñ', $temp_lname);
          $temp_fname = utf8_decode($result[0]["fname"]);
          $fname = str_replace('?', 'Ñ', $temp_fname);
          $temp_mname = utf8_decode($result[0]["mname"]);
          $mname = str_replace('?', 'Ñ', $temp_mname);
          $sy = $result[0]["sy"];
          $sem = $result[0]["semester"];
          $rawDateReq = $result[0]["dateReq"];
          $school = $result[0]["school"];
          $schoolABBR = $result[0]["schoolABBR"];
          $email = $result[0]["email"];
          $contact = $result[0]["contact"];
          $rawBday = $result[0]["bday"];
          $course = $result[0]["course"];
          $courseABBR = $result[0]["courseABBR"];
          $year = $result[0]["year"];
          $tSchool = $result[0]["transferredSchool"];
          $tReason = $result[0]["reason"];
          $studType = $result[0]["studentType"];
          $schType = $result[0]["schoolType"];
          $libraryC = $result[0]["libraryclearance"];
          $libraryR = $result[0]["libraryremarks"];
          $rawLibraryD = $result[0]["librarydate"];
          $deptC = $result[0]["departmentclearance"];
          $deptR = $result[0]["departmentremarks"];
          $rawDeptD = $result[0]["departmentdate"];
          $acctC = $result[0]["accountingclearance"];
          $acctR = $result[0]["accountingremarks"];
          $rawAcctD = $result[0]["accountingdate"];
          $regC = $result[0]["registrarclearance"];
          $regR = $result[0]["registrarremarks"];
          $rawRegD = $result[0]["registrardate"];
          $acct_asst_name = acct_asstName();

          if($studType == "Transfer"){
            $guidanceC = $result[0]["guidanceclearance"];
            $guidanceR = $result[0]["guidanceremarks"];
            $rawGuidanceD = $result[0]["guidancedate"];
            $attachedID = $result[0]["file_validID"];
            $attachedLTR = $result[0]["file_letter"];
          }

        // DATE CONVERSIONS -------------------------------------------------------------------------------------------------
          if(!empty($rawBday)){                             
            $rawBday0 = strtr($rawBday, '-', '-');              
            $conv_bday = strtotime($rawBday0);                     
            $dispBday = date('F d, Y', $conv_bday);
          }

          if(!empty($rawDateReq)){                             
            $rawDateReq0 = strtr($rawDateReq, '-', '-');              
            $conv_dateReq = strtotime($rawDateReq0);                     
            $dispDateReq = date('M d, Y', $conv_dateReq);
          }

          if(!empty($rawLibraryD)){                             
            $rawLibraryD0 = strtr($rawLibraryD, '-', '-');              
            $conv_LibraryD = strtotime($rawLibraryD0);                     
            $dispLibraryD = date('M d, Y', $conv_LibraryD);
          }
          else{
            $dispLibraryD = "";
          }

          if(!empty($rawDeptD)){                             
            $rawDeptD0 = strtr($rawDeptD, '-', '-');              
            $conv_DeptD = strtotime($rawDeptD0);                     
            $dispDeptD = date('M d, Y', $conv_DeptD);
          }
          else{
            $dispDeptD = "";
          }

          if(!empty($rawAcctD)){                             
            $rawAcctD0 = strtr($rawAcctD, '-', '-');              
            $conv_AcctD = strtotime($rawAcctD0);                     
            $dispAcctD = date('M d, Y', $conv_AcctD);
          }
          else{
            $dispAcctD = "";
          }

          if(!empty($rawRegD)){                             
            $rawRegD0 = strtr($rawRegD, '-', '-');              
            $conv_RegD = strtotime($rawRegD0);                     
            $dispRegD = date('M d, Y', $conv_RegD);
          }
          else{
            $dispRegD = "";
          }

          if($studType == "Transfer"){
            if(!empty($rawGuidanceD)){                             
              $rawGuidanceD0 = strtr($rawGuidanceD, '-', '-');              
              $conv_GuidanceD = strtotime($rawGuidanceD0);                     
              $dispGuidanceD = date('M d, Y', $conv_GuidanceD);
            }
            else{
              $dispGuidanceD = "";
            }
          }

          // STATUS ICONS -------------------------------------------------------------------------------------------------
          if($libraryC == "CLEARED"){
            $iconClassL = "staticon-approved";
            $iconLibrary = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($libraryC == "ON HOLD"){
            $iconClassL = "staticon-hold";
            $iconLibrary = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassL = "staticon-pending";
            $iconLibrary = "<i class='fa-regular fa-circle'></i>";
          }

          if($deptC == "CLEARED"){
            $iconClassD = "staticon-approved";
            $iconDept = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($deptC == "ON HOLD"){
            $iconClassD = "staticon-hold";
            $iconDept = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassD = "staticon-pending";
            $iconDept = "<i class='fa-regular fa-circle'></i>";
          }

          if($acctC == "CLEARED"){
            $iconClassA = "staticon-approved";
            $iconAcct = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($acctC == "ON HOLD"){
            $iconClassA = "staticon-hold";
            $iconAcct = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassA = "staticon-pending";
            $iconAcct = "<i class='fa-regular fa-circle'></i>";
          }

          if($regC == "CLEARED"){
            $iconClassR = "staticon-approved";
            $iconReg = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($regC == "ON HOLD"){
            $iconClassR = "staticon-hold";
            $iconReg = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassR = "staticon-pending";
            $iconReg = "<i class='fa-regular fa-circle'></i>";
          }

          if($studType == "Transfer"){
            if($guidanceC == "CLEARED"){
              $iconClassG = "staticon-approved";
              $iconGuidance = "<i class='fa-solid fa-circle-check'></i>";
            }
            elseif($guidanceC == "ON HOLD"){
              $iconClassG = "staticon-hold";
              $iconGuidance = "<i class='fa-solid fa-triangle-exclamation'></i>";
            }
            else{
              $iconClassG = "staticon-pending";
              $iconGuidance = "<i class='fa-regular fa-circle'></i>";
            }
          }

        // HOLD REMARKS -------------------------------------------------------------------------------------------------
        if(!empty($libraryR)){
          $dispLibraryR = "Library Department: <b class='remarks'> $libraryR </b><br>";
        }
        else{
          $dispLibraryR = "<i class='remarks'>No remarks from Library Department </i><br>";
        }
        
        if(!empty($deptR)){
          $dispDeptR = "Dean's Office: <b class='remarks'> $deptR </b><br>";
        }
        else{
          $dispDeptR = "<i class='remarks'> No remarks from the Dean's Office </i><br>";
        }

        if(!empty($acctR)){
          $dispAcctR = "Accounting Department: <b class='remarks'> $acctR </b><br>";
        }
        else{
          $dispAcctR = "<i class='remarks'>No remarks from the Accounting Department</i><br>";
        }

        if(!empty($regR)){
          $dispRegR = "Office of the University Registrar: <b class='remarks'> $regR </b><br>";
        }
        else{
          $dispRegR = "<i class='remarks'>No remarks from the Office of the University Registrar</i><br>";
        }
        
        if($studType == "Transfer"){
          if(!empty($guidanceR)){
            $dispGuidanceR = "Guidance Department: <b class='remarks'> $guidanceR </b><br>";
          }
          else{
            $dispGuidanceR = "<i class='remarks'>No remarks from Guidance Department </i><br>";
          }
        }
        
        // URL Redirect -------------------------------------------------------------------------------------------------
        if($acctC == "PENDING"){
          $urlA = 'req';
        }
        elseif($acctC == "ON HOLD"){
          $urlA = "hld";
        }
        elseif($acctC == "CLEARED"){
          $urlA = "app";
        }
        else{
          //do nothing
        }
        
        if($studType == "Graduate"){
          $urlB = 'gd';
        }
        elseif($studType == "Transfer"){
          $urlB = "tr";
        }
        else{
          //do nothing
        }
          
        echo "<h3 class='text-center'><i class='fas fa-user-circle'></i> <u> Student Information </u> </h3>";
          
        echo "<div class='table-responsive pt-4 col-12'>";
          echo "<div class='row pb-2 shadow p-3 mb-5 bg-white rounded'>";
            echo "<div class='col col-7'>";
              echo "<table class='table table-borderless' width='100%'>";
                echo "<tr>
                      <td class='desc-studID'><b>$studID</b></td>
                      </td>";
                echo "<tr class='bottomborder'>
                      <td class='value pt-0'>$lname, $fname $mname</td>
                      </tr>";
                echo "<tr><td class='desc pt-2'>School: <b>$school</b></td></tr>";
                echo "<tr><td class='desc'>Course: <b>$course</b></td></tr>";
                echo "<tr><td class='desc'>School Year & Sem: <b>SY$sy-$sem</b></td></tr>";
                echo "<tr><td class='desc'>Student Type: <b>$studType</b></td></tr>";
                echo "<tr><td class='desc'>Email Address: <b>$email</b></td></tr>";
                echo "<tr><td class='desc'>Contact Number: <b>$contact</b></td></tr>";
                echo "<tr><td class='desc'>Birthdate: <b>$dispBday</b></td></tr>";
                echo "<tr><td class='desc'><hr></td></tr>";
                if($studType == "Transfer"){
                  echo "<tr><td class='desc'>Reason for Transferring: <b>$tReason</b></tr></td>";
                  if($tSchool == "Abroad"){
                    echo "<tr><td class='desc'><b>Planning to continue studies Abroad.</b></tr></td>";
                  }
                  else{
                    echo "<tr><td class='desc'>Possible School Transferring to: <b>$tSchool</b></tr></td>";
                  }
                }
                else{
                  // do nothing
                }
                
              echo "</table>";
            echo "</div>";

            echo "<div class='col col-5'>";
              echo "<p class=caption>Clearance Details</p>";
                echo "<table class='table table-borderless' width='100%'>";
                  echo "<tr><td class='desc'>Reference #: <b>$refID</b></td></tr>";
                  echo "<tr><td class='desc'>Date Requested: <b>$dispDateReq</b></td></tr>";
                echo "</table>";

                echo "<p class=caption>Actions</p>";
                echo "<table class='table table-borderless' width='100%'>";
                  echo "<tr><td>";
                  
                  if($acctC == "PENDING"){
                    echo "<button class='btn btn-sm btn-block btn-success d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#acctModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
                  }

                  if($acctC == "ON HOLD"){
                    echo"<button class='btn btn-sm btn-block btn-warning d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#acctHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear</button>";
                  }else{
                    echo"<button class='btn btn-sm btn-block btn-warning d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#acctHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold Clearance</button>";
                  }

                  if($studType == "Transfer"){
                    echo "<a href='resource/uploads/ids/$attachedID' class='btn btn-primary btn-sm btn-block d-block' target='_blank'><i class='fa-solid fa-id-card'></i> View Attached ID</a>";
                    echo "<a href='resource/uploads/letters/$attachedLTR' class='btn btn-primary btn-sm btn-block d-block' target='_blank'><i class='fa-solid fa-envelope'></i> View Letter of Intent for Exit</a>";
                  }
                          
                  echo "<a href='acct-$urlA-$urlB.php' class='btn btn-info btn-sm my-2 d-block ' data-toggle='tooltip' data-placement='top' title='Back'><i class='fa-solid fa-arrow-left'></i> Back </a>";
                        include "modals.php";
                  echo "</tr></td>";
                echo "</table>";
            echo "</div>";
          echo "</div>";

          echo "<div class='row'>";
            echo "<div class='col col-7'>";
              echo "<p class=caption>Clearance Status</p>";
                echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded' width='100%'>";
                    echo "<th class='stathead'>Dean's Office</th>";
                    echo "<th> </th>";

                    if($studType == "Transfer"){
                      echo "<th class='stathead'>Guidance Office</th>";
                      echo "<th> </th>";
                    }

                    echo "<th class='stathead'>Library</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Accounting</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Registrar</th>";
                    echo "<tr>";
                      echo "<td class='$iconClassD'>$iconDept</td>";
                      echo "<td class='$iconClassD'>∙∙∙</td>";

                      if($studType == "Transfer"){
                        echo "<td class='$iconClassG'>$iconGuidance</td>";
                        echo "<td class='$iconClassG'>∙∙∙</td>";
                      }

                      echo "<td class='$iconClassL'>$iconLibrary</td>";
                      echo "<td class='$iconClassL'>∙∙∙</td>";
                      echo "<td class='$iconClassA'>$iconAcct</td>";
                      echo "<td class='$iconClassA'>∙∙∙</td>";
                      echo "<td class='$iconClassR'>$iconReg</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td class='statcap'>$dispDeptD</td>";
                      echo "<td></td>";

                      if($studType == "Transfer"){
                        echo "<td class='statcap'>$dispGuidanceD</td>";
                        echo "<td></td>";

                      }
                      echo "<td class='statcap'>$dispLibraryD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispAcctD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispRegD</td>";
                    echo "</tr>";
                  echo "</table>";

            echo "</div>";

            echo "<div class='col col-5'>";
              echo "<p class=caption>Remarks</p>";
                echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded' width='100%'>";
                  echo "<tr>";
                    echo "<td>$dispDeptR</td>";
                  echo "</tr>";

                      if($studType == "Transfer"){
                          echo "<td>$dispGuidanceR</td>";
                        echo "</tr>";
                      }

                    echo "<td >$dispLibraryR</td>";
                  echo "</tr>";
                    echo "<td>$dispAcctR</td>";
                  echo "</tr>";
                    echo "<td>$dispRegR</td>";
                  echo "</tr>";
                echo "</table>";
            echo "</div>";
          echo "</div>";
      }

    public function infoGuidance(){
      $con = $this->con();
      $sql = "SELECT * FROM `ecle_forms_ug` WHERE `id` = '$this->id'";
      $data = $con->prepare($sql);
      $data->execute();
      $result = $data->fetchAll(PDO::FETCH_ASSOC);

        $id = $result[0]["id"];                 // PK
        $studID = $result[0]["studentID"];      // index
        $refID = $result[0]["referenceID"];
        $temp_lname = utf8_decode($result[0]["lname"]);
        $lname = str_replace('?', 'Ñ', $temp_lname);
        $temp_fname = utf8_decode($result[0]["fname"]);
        $fname = str_replace('?', 'Ñ', $temp_fname);
        $temp_mname = utf8_decode($result[0]["mname"]);
        $mname = str_replace('?', 'Ñ', $temp_mname);
        $sy = $result[0]["sy"];
        $sem = $result[0]["semester"];
        $rawDateReq = $result[0]["dateReq"];
        $school = $result[0]["school"];
        $schoolABBR = $result[0]["schoolABBR"];
        $email = $result[0]["email"];
        $contact = $result[0]["contact"];
        $rawBday = $result[0]["bday"];
        $course = $result[0]["course"];
        $courseABBR = $result[0]["courseABBR"];
        $year = $result[0]["year"];
        $tSchool = $result[0]["transferredSchool"];
        $tReason = $result[0]["reason"];
        $studType = $result[0]["studentType"];
        $schType = $result[0]["schoolType"];
        $libraryC = $result[0]["libraryclearance"];
        $libraryR = $result[0]["libraryremarks"];
        $rawLibraryD = $result[0]["librarydate"];

        $guidanceC = $result[0]["guidanceclearance"];
        $guidanceR = $result[0]["guidanceremarks"];
        $rawGuidanceD = $result[0]["guidancedate"];

        $deptC = $result[0]["departmentclearance"];
        $deptR = $result[0]["departmentremarks"];
        $rawDeptD = $result[0]["departmentdate"];
        $acctC = $result[0]["accountingclearance"];
        $acctR = $result[0]["accountingremarks"];
        $rawAcctD = $result[0]["accountingdate"];
        $regC = $result[0]["registrarclearance"];
        $regR = $result[0]["registrarremarks"];
        $rawRegD = $result[0]["registrardate"];
        $guid_asst_name = guid_asstName();

        $attachedID = $result[0]["file_validID"];
        $attachedLTR = $result[0]["file_letter"];

      // DATE CONVERSIONS -------------------------------------------------------------------------------------------------
        if(!empty($rawBday)){                             
          $rawBday0 = strtr($rawBday, '-', '-');              
          $conv_bday = strtotime($rawBday0);                     
          $dispBday = date('F d, Y', $conv_bday);
        }

        if(!empty($rawDateReq)){                             
          $rawDateReq0 = strtr($rawDateReq, '-', '-');              
          $conv_dateReq = strtotime($rawDateReq0);                     
          $dispDateReq = date('M d, Y', $conv_dateReq);
        }

        if(!empty($rawLibraryD)){                             
          $rawLibraryD0 = strtr($rawLibraryD, '-', '-');              
          $conv_LibraryD = strtotime($rawLibraryD0);                     
          $dispLibraryD = date('M d, Y', $conv_LibraryD);
        }
        else{
          $dispLibraryD = "";
        }

        if(!empty($rawGuidanceD)){                             
          $rawGuidanceD0 = strtr($rawGuidanceD, '-', '-');              
          $conv_GuidanceD = strtotime($rawGuidanceD0);                     
          $dispGuidanceD = date('M d, Y', $conv_GuidanceD);
        }
        else{
          $dispGuidanceD = "";
        }

        if(!empty($rawDeptD)){                             
          $rawDeptD0 = strtr($rawDeptD, '-', '-');              
          $conv_DeptD = strtotime($rawDeptD0);                     
          $dispDeptD = date('M d, Y', $conv_DeptD);
        }
        else{
          $dispDeptD = "";
        }

        if(!empty($rawAcctD)){                             
          $rawAcctD0 = strtr($rawAcctD, '-', '-');              
          $conv_AcctD = strtotime($rawAcctD0);                     
          $dispAcctD = date('M d, Y', $conv_AcctD);
        }
        else{
          $dispAcctD = "";
        }

        if(!empty($rawRegD)){                             
          $rawRegD0 = strtr($rawRegD, '-', '-');              
          $conv_RegD = strtotime($rawRegD0);                     
          $dispRegD = date('M d, Y', $conv_RegD);
        }
        else{
          $dispRegD = "";
        }

        // STATUS ICONS -------------------------------------------------------------------------------------------------
        if($libraryC == "CLEARED"){
          $iconClassL = "staticon-approved";
          $iconLibrary = "<i class='fa-solid fa-circle-check'></i>";
        }
        elseif($libraryC == "ON HOLD"){
          $iconClassL = "staticon-hold";
          $iconLibrary = "<i class='fa-solid fa-triangle-exclamation'></i>";
        }
        else{
          $iconClassL = "staticon-pending";
          $iconLibrary = "<i class='fa-regular fa-circle'></i>";
        }

        if($guidanceC == "CLEARED"){
          $iconClassG = "staticon-approved";
          $iconGuidance = "<i class='fa-solid fa-circle-check'></i>";
        }
        elseif($guidanceC == "ON HOLD"){
          $iconClassG = "staticon-hold";
          $iconGuidance = "<i class='fa-solid fa-triangle-exclamation'></i>";
        }
        else{
          $iconClassG = "staticon-pending";
          $iconGuidance = "<i class='fa-regular fa-circle'></i>";
        }

        if($deptC == "CLEARED"){
          $iconClassD = "staticon-approved";
          $iconDept = "<i class='fa-solid fa-circle-check'></i>";
        }
        elseif($deptC == "ON HOLD"){
          $iconClassD = "staticon-hold";
          $iconDept = "<i class='fa-solid fa-triangle-exclamation'></i>";
        }
        else{
          $iconClassD = "staticon-pending";
          $iconDept = "<i class='fa-regular fa-circle'></i>";
        }

        if($acctC == "CLEARED"){
          $iconClassA = "staticon-approved";
          $iconAcct = "<i class='fa-solid fa-circle-check'></i>";
        }
        elseif($acctC == "ON HOLD"){
          $iconClassA = "staticon-hold";
          $iconAcct = "<i class='fa-solid fa-triangle-exclamation'></i>";
        }
        else{
          $iconClassA = "staticon-pending";
          $iconAcct = "<i class='fa-regular fa-circle'></i>";
        }

        if($regC == "CLEARED"){
          $iconClassR = "staticon-approved";
          $iconReg = "<i class='fa-solid fa-circle-check'></i>";
        }
        elseif($regC == "ON HOLD"){
          $iconClassR = "staticon-hold";
          $iconReg = "<i class='fa-solid fa-triangle-exclamation'></i>";
        }
        else{
          $iconClassR = "staticon-pending";
          $iconReg = "<i class='fa-regular fa-circle'></i>";
        }

      // HOLD REMARKS -------------------------------------------------------------------------------------------------
      if(!empty($libraryR)){
        $dispLibraryR = "Library Department: <b class='remarks'> $libraryR </b><br>";
      }
      else{
        $dispLibraryR = "<i class='remarks'>No remarks from Library Department </i><br>";
      }

      if(!empty($guidanceR)){
        $dispGuidanceR = "Guidance Department: <b class='remarks'> $guidanceR </b><br>";
      }
      else{
        $dispGuidanceR = "<i class='remarks'>No remarks from Guidance Department </i><br>";
      }
      
      if(!empty($deptR)){
        $dispDeptR = "Dean's Office: <b class='remarks'> $deptR </b><br>";
      }
      else{
        $dispDeptR = "<i class='remarks'> No remarks from the Dean's Office </i><br>";
      }

      if(!empty($acctR)){
        $dispAcctR = "Accounting Department: <b class='remarks'> $acctR </b><br>";
      }
      else{
        $dispAcctR = "<i class='remarks'>No remarks from the Accounting Department</i><br>";
      }

      if(!empty($regR)){
        $dispRegR = "Office of the University Registrar: <b class='remarks'> $regR </b><br>";
      }
      else{
        $dispRegR = "<i class='remarks'>No remarks from the Office of the University Registrar</i><br>";
      }
      
      // URL Redirect -------------------------------------------------------------------------------------------------
      if($guidanceC == "PENDING"){
        $urlA = 'req';
      }
      elseif($guidanceC == "ON HOLD"){
        $urlA = "hld";
      }
      elseif($guidanceC == "CLEARED"){
        $urlA = "app";
      }
      else{
        //do nothing
      }
      
      // if($studType == "Graduate"){
        // $urlB = 'gd';
      // }
      // elseif($studType == "Transfer"){
        $urlB = "tr";
      // }
      // else{
        //do nothing
      // }
        
      echo "<h3 class='text-center'><i class='fas fa-user-circle'></i> <u> Student Information </u> </h3>";
        
      echo "<div class='table-responsive pt-4 col-12'>";
        echo "<div class='row pb-2 shadow p-3 mb-5 bg-white rounded'>";
          echo "<div class='col col-7'>";
            echo "<table class='table table-borderless' width='100%'>";
              echo "<tr>
                    <td class='desc-studID'><b>$studID</b></td>
                    </td>";
              echo "<tr class='bottomborder'>
                    <td class='value pt-0'>$lname, $fname $mname</td>
                    </tr>";
              echo "<tr><td class='desc pt-2'>School: <b>$school</b></td></tr>";
              echo "<tr><td class='desc'>Course: <b>$course</b></td></tr>";
              echo "<tr><td class='desc'>School Year & Sem: <b>SY$sy-$sem</b></td></tr>";
              echo "<tr><td class='desc'>Student Type: <b>$studType</b></td></tr>";
              echo "<tr><td class='desc'>Email Address: <b>$email</b></td></tr>";
              echo "<tr><td class='desc'>Contact Number: <b>$contact</b></td></tr>";
              echo "<tr><td class='desc'>Birthdate: <b>$dispBday</b></td></tr>";
              echo "<tr><td class='desc'><hr></td></tr>";
              if($studType == "Transfer"){
                echo "<tr><td class='desc'>Reason for Transferring: <b>$tReason</b></tr></td>";
                if($tSchool == "Abroad"){
                  echo "<tr><td class='desc'><b>Planning to continue studies Abroad.</b></tr></td>";
                }
                else{
                  echo "<tr><td class='desc'>Possible School Transferring to: <b>$tSchool</b></tr></td>";
                }
              }
              else{
                // do nothing
              }
              
            echo "</table>";
          echo "</div>";

          echo "<div class='col col-5'>";
            echo "<p class=caption>Clearance Details</p>";
              echo "<table class='table table-borderless' width='100%'>";
                echo "<tr><td class='desc'>Reference #: <b>$refID</b></td></tr>";
                echo "<tr><td class='desc'>Date Requested: <b>$dispDateReq</b></td></tr>";
              echo "</table>";

              echo "<p class=caption>Actions</p>";
              echo "<table class='table table-borderless' width='100%'>";
                echo "<tr><td>";
                
                if($guidanceC == "PENDING"){
                  echo "<button class='btn btn-sm btn-block btn-success d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#guidModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Exit Interview Completed</button>";
                }

                if($guidanceC == "ON HOLD"){
                  echo"<button class='btn btn-sm btn-block btn-warning d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#guidHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear</button>";
                }else{
                  echo"<button class='btn btn-sm btn-block btn-warning d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#guidHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Set On-Hold </button>";
                }
                
                if($studType == "Transfer"){
                    echo "<a href='resource/uploads/ids/$attachedID' class='btn btn-primary btn-sm btn-block d-block' target='_blank'><i class='fa-solid fa-id-card'></i> View Attached ID</a>";
                    echo "<a href='resource/uploads/letters/$attachedLTR' class='btn btn-primary btn-sm btn-block d-block' target='_blank'><i class='fa-solid fa-envelope'></i> View Letter of Intent for Exit</a>";
                  }

                echo "<a href='guid-$urlA-$urlB.php' class='btn btn-info btn-sm my-2 d-block ' data-toggle='tooltip' data-placement='top' title='Back'><i class='fa-solid fa-arrow-left'></i> Back </a>";
                      include "modals.php";
                echo "</tr></td>";
              echo "</table>";
          echo "</div>";
        echo "</div>";

        echo "<div class='row'>";
            echo "<div class='col col-7'>";
              echo "<p class=caption>Clearance Status</p>";
                echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded' width='100%'>";
                    echo "<th class='stathead'>Dean's Ofc.</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Guidance Ofc.</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Library</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Accounting</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Registrar</th>";
                    echo "<tr>";
                      echo "<td class='$iconClassD'>$iconDept</td>";
                      echo "<td class='$iconClassD'>∙∙∙</td>";
                      echo "<td class='$iconClassG'>$iconGuidance</td>";
                      echo "<td class='$iconClassG'>∙∙∙</td>";
                      echo "<td class='$iconClassL'>$iconLibrary</td>";
                      echo "<td class='$iconClassL'>∙∙∙</td>";
                      echo "<td class='$iconClassA'>$iconAcct</td>";
                      echo "<td class='$iconClassA'>∙∙∙</td>";
                      echo "<td class='$iconClassR'>$iconReg</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td class='statcap'>$dispDeptD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispGuidanceD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispLibraryD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispAcctD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispRegD</td>";
                    echo "</tr>";
                  echo "</table>";

            echo "</div>";

            echo "<div class='col col-5'>";
              echo "<p class=caption>Remarks</p>";
                echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded' width='100%'>";
                  echo "<tr>";
                    echo "<td>$dispDeptR</td>";
                  echo "</tr>";
                    echo "<td>$dispGuidanceR</td>";
                  echo "</tr>";
                    echo "<td >$dispLibraryR</td>";
                  echo "</tr>";
                    echo "<td>$dispAcctR</td>";
                  echo "</tr>";
                    echo "<td>$dispRegR</td>";
                  echo "</tr>";
                echo "</table>";
            echo "</div>";
          echo "</div>";
              }
    public function infoLibrary(){
        $con = $this->con();
        if($this->type == "Graduate"){
          $sql = "SELECT * FROM `ecle_forms` WHERE `id` = '$this->id'";
        }else{
          $sql = "SELECT * FROM `ecle_forms_ug` WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

          $id = $result[0]["id"];                 // PK
          $studID = $result[0]["studentID"];      // index
          $refID = $result[0]["referenceID"];
          $temp_lname = utf8_decode($result[0]["lname"]);
          $lname = str_replace('?', 'Ñ', $temp_lname);
          $temp_fname = utf8_decode($result[0]["fname"]);
          $fname = str_replace('?', 'Ñ', $temp_fname);
          $temp_mname = utf8_decode($result[0]["mname"]);
          $mname = str_replace('?', 'Ñ', $temp_mname);
          $sy = $result[0]["sy"];
          $sem = $result[0]["semester"];
          $rawDateReq = $result[0]["dateReq"];
          $school = $result[0]["school"];
          $schoolABBR = $result[0]["schoolABBR"];
          $email = $result[0]["email"];
          $contact = $result[0]["contact"];
          $rawBday = $result[0]["bday"];
          $course = $result[0]["course"];
          $courseABBR = $result[0]["courseABBR"];
          $year = $result[0]["year"];
          $tSchool = $result[0]["transferredSchool"];
          $tReason = $result[0]["reason"];
          $studType = $result[0]["studentType"];
          $schType = $result[0]["schoolType"];
          $libraryC = $result[0]["libraryclearance"];
          $libraryR = $result[0]["libraryremarks"];
          $rawLibraryD = $result[0]["librarydate"];
          $deptC = $result[0]["departmentclearance"];
          $deptR = $result[0]["departmentremarks"];
          $rawDeptD = $result[0]["departmentdate"];
          $acctC = $result[0]["accountingclearance"];
          $acctR = $result[0]["accountingremarks"];
          $rawAcctD = $result[0]["accountingdate"];
          $regC = $result[0]["registrarclearance"];
          $regR = $result[0]["registrarremarks"];
          $rawRegD = $result[0]["registrardate"];
          $libr_asst_name = libr_asstName();

          if($studType == "Transfer"){
            $guidanceC = $result[0]["guidanceclearance"];
            $guidanceR = $result[0]["guidanceremarks"];
            $rawGuidanceD = $result[0]["guidancedate"];
            $attachedID = $result[0]["file_validID"];
            $attachedLTR = $result[0]["file_letter"];
          }

        // DATE CONVERSIONS -------------------------------------------------------------------------------------------------
          if(!empty($rawBday)){                             
            $rawBday0 = strtr($rawBday, '-', '-');              
            $conv_bday = strtotime($rawBday0);                     
            $dispBday = date('F d, Y', $conv_bday);
          }

          if(!empty($rawDateReq)){                             
            $rawDateReq0 = strtr($rawDateReq, '-', '-');              
            $conv_dateReq = strtotime($rawDateReq0);                     
            $dispDateReq = date('M d, Y', $conv_dateReq);
          }

          if(!empty($rawLibraryD)){                             
            $rawLibraryD0 = strtr($rawLibraryD, '-', '-');              
            $conv_LibraryD = strtotime($rawLibraryD0);                     
            $dispLibraryD = date('M d, Y', $conv_LibraryD);
          }
          else{
            $dispLibraryD = "";
          }

          if(!empty($rawDeptD)){                             
            $rawDeptD0 = strtr($rawDeptD, '-', '-');              
            $conv_DeptD = strtotime($rawDeptD0);                     
            $dispDeptD = date('M d, Y', $conv_DeptD);
          }
          else{
            $dispDeptD = "";
          }

          if(!empty($rawAcctD)){                             
            $rawAcctD0 = strtr($rawAcctD, '-', '-');              
            $conv_AcctD = strtotime($rawAcctD0);                     
            $dispAcctD = date('M d, Y', $conv_AcctD);
          }
          else{
            $dispAcctD = "";
          }

          if(!empty($rawRegD)){                             
            $rawRegD0 = strtr($rawRegD, '-', '-');              
            $conv_RegD = strtotime($rawRegD0);                     
            $dispRegD = date('M d, Y', $conv_RegD);
          }
          else{
            $dispRegD = "";
          }

          if($studType == "Transfer"){
            if(!empty($rawGuidanceD)){                             
              $rawGuidanceD0 = strtr($rawGuidanceD, '-', '-');              
              $conv_GuidanceD = strtotime($rawGuidanceD0);                     
              $dispGuidanceD = date('M d, Y', $conv_GuidanceD);
            }
            else{
              $dispGuidanceD = "";
            }
          }

          // STATUS ICONS -------------------------------------------------------------------------------------------------
          if($libraryC == "CLEARED"){
            $iconClassL = "staticon-approved";
            $iconLibrary = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($libraryC == "ON HOLD"){
            $iconClassL = "staticon-hold";
            $iconLibrary = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassL = "staticon-pending";
            $iconLibrary = "<i class='fa-regular fa-circle'></i>";
          }

          if($deptC == "CLEARED"){
            $iconClassD = "staticon-approved";
            $iconDept = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($deptC == "ON HOLD"){
            $iconClassD = "staticon-hold";
            $iconDept = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassD = "staticon-pending";
            $iconDept = "<i class='fa-regular fa-circle'></i>";
          }

          if($acctC == "CLEARED"){
            $iconClassA = "staticon-approved";
            $iconAcct = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($acctC == "ON HOLD"){
            $iconClassA = "staticon-hold";
            $iconAcct = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassA = "staticon-pending";
            $iconAcct = "<i class='fa-regular fa-circle'></i>";
          }

          if($regC == "CLEARED"){
            $iconClassR = "staticon-approved";
            $iconReg = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($regC == "ON HOLD"){
            $iconClassR = "staticon-hold";
            $iconReg = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassR = "staticon-pending";
            $iconReg = "<i class='fa-regular fa-circle'></i>";
          }

          if($studType == "Transfer"){
            if($guidanceC == "CLEARED"){
              $iconClassG = "staticon-approved";
              $iconGuidance = "<i class='fa-solid fa-circle-check'></i>";
            }
            elseif($guidanceC == "ON HOLD"){
              $iconClassG = "staticon-hold";
              $iconGuidance = "<i class='fa-solid fa-triangle-exclamation'></i>";
            }
            else{
              $iconClassG = "staticon-pending";
              $iconGuidance = "<i class='fa-regular fa-circle'></i>";
            }
          }

        // HOLD REMARKS -------------------------------------------------------------------------------------------------
        if(!empty($libraryR)){
          $dispLibraryR = "Library Department: <b class='remarks'> $libraryR </b><br>";
        }
        else{
          $dispLibraryR = "<i class='remarks'>No remarks from Library Department </i><br>";
        }
        
        if(!empty($deptR)){
          $dispDeptR = "Dean's Office: <b class='remarks'> $deptR </b><br>";
        }
        else{
          $dispDeptR = "<i class='remarks'> No remarks from the Dean's Office </i><br>";
        }

        if(!empty($acctR)){
          $dispAcctR = "Accounting Department: <b class='remarks'> $acctR </b><br>";
        }
        else{
          $dispAcctR = "<i class='remarks'>No remarks from the Accounting Department</i><br>";
        }

        if(!empty($regR)){
          $dispRegR = "Office of the University Registrar: <b class='remarks'> $regR </b><br>";
        }
        else{
          $dispRegR = "<i class='remarks'>No remarks from the Office of the University Registrar</i><br>";
        }

        if($studType == "Transfer"){
          if(!empty($guidanceR)){
            $dispGuidanceR = "Guidance Department: <b class='remarks'> $guidanceR </b><br>";
          }
          else{
            $dispGuidanceR = "<i class='remarks'>No remarks from Guidance Department </i><br>";
          }
        }
                
        // URL Redirect -------------------------------------------------------------------------------------------------
        if($libraryC == "PENDING"){
          $urlA = 'req';
        }
        elseif($libraryC == "ON HOLD"){
          $urlA = "hld";
        }
        elseif($libraryC == "CLEARED"){
          $urlA = "app";
        }
        else{
          //do nothing
        }
        
        if($studType == "Graduate"){
          $urlB = 'gd';
        }
        elseif($studType == "Transfer"){
          $urlB = "tr";
        }
        else{
          //do nothing
        }
          
        echo "<h3 class='text-center'><i class='fas fa-user-circle'></i> <u> Student Information </u> </h3>";
          
        echo "<div class='table-responsive pt-4 col-12'>";
          echo "<div class='row pb-2 shadow p-3 mb-5 bg-white rounded'>";
            echo "<div class='col col-7'>";
              echo "<table class='table table-borderless' width='100%'>";
                echo "<tr>
                      <td class='desc-studID'><b>$studID</b></td>
                      </td>";
                echo "<tr class='bottomborder'>
                      <td class='value pt-0'>$lname, $fname $mname</td>
                      </tr>";
                echo "<tr><td class='desc pt-2'>School: <b>$school</b></td></tr>";
                echo "<tr><td class='desc'>Course: <b>$course</b></td></tr>";
                echo "<tr><td class='desc'>School Year & Sem: <b>SY$sy-$sem</b></td></tr>";
                echo "<tr><td class='desc'>Student Type: <b>$studType</b></td></tr>";
                echo "<tr><td class='desc'>Email Address: <b>$email</b></td></tr>";
                echo "<tr><td class='desc'>Contact Number: <b>$contact</b></td></tr>";
                echo "<tr><td class='desc'>Birthdate: <b>$dispBday</b></td></tr>";
                echo "<tr><td class='desc'><hr></td></tr>";
                if($studType == "Transfer"){
                  echo "<tr><td class='desc'>Reason for Transferring: <b>$tReason</b></tr></td>";
                  if($tSchool == "Abroad"){
                    echo "<tr><td class='desc'><b>Planning to continue studies Abroad.</b></tr></td>";
                  }
                  else{
                    echo "<tr><td class='desc'>Possible School Transferring to: <b>$tSchool</b></tr></td>";
                  }
                }
                else{
                  // do nothing
                }
              echo "</table>";
            echo "</div>";

            echo "<div class='col col-5'>";
              echo "<p class=caption>Clearance Details</p>";
                echo "<table class='table table-borderless' width='100%'>";
                  echo "<tr><td class='desc'>Reference #: <b>$refID</b></td></tr>";
                  echo "<tr><td class='desc'>Date Requested: <b>$dispDateReq</b></td></tr>";
                echo "</table>";

                echo "<p class=caption>Actions</p>";
                echo "<table class='table table-borderless' width='100%'>";
                  echo "<tr><td>";
                  
                  if($libraryC == "PENDING"){
                    echo "<button class='btn btn-sm btn-block btn-success d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#librModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
                  }

                  if($libraryC == "ON HOLD"){
                    echo"<button class='btn btn-sm btn-block btn-warning d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#librHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear</button>";
                  }else{
                    echo"<button class='btn btn-sm btn-block btn-warning d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#librHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold Clearance</button>";
                  }
                          
                  if($studType == "Transfer"){
                    echo "<a href='resource/uploads/ids/$attachedID' class='btn btn-primary btn-sm btn-block d-block' target='_blank'><i class='fa-solid fa-id-card'></i> View Attached ID</a>";
                    echo "<a href='resource/uploads/letters/$attachedLTR' class='btn btn-primary btn-sm btn-block d-block' target='_blank'><i class='fa-solid fa-envelope'></i> View Letter of Intent for Exit</a>";
                  }

                  echo "<a href='libr-$urlA-$urlB.php' class='btn btn-info btn-sm my-2 d-block ' data-toggle='tooltip' data-placement='top' title='Back'><i class='fa-solid fa-arrow-left'></i> Back </a>";
                        include "modals.php";
                  echo "</tr></td>";
                echo "</table>";
            echo "</div>";
          echo "</div>";

          echo "<div class='row'>";
            echo "<div class='col col-7'>";
              echo "<p class=caption>Clearance Status</p>";
                echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded' width='100%'>";
                    echo "<th class='stathead'>Dean's Ofc.</th>";
                    echo "<th> </th>";

                    if($studType == "Transfer"){
                      echo "<th class='stathead'>Guidance Ofc.</th>";
                      echo "<th> </th>";
                    }

                    echo "<th class='stathead'>Library</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Accounting</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Registrar</th>";
                    echo "<tr>";
                      echo "<td class='$iconClassD'>$iconDept</td>";
                      echo "<td class='$iconClassD'>∙∙∙</td>";

                      if($studType == "Transfer"){
                        echo "<td class='$iconClassG'>$iconGuidance</td>";
                        echo "<td class='$iconClassG'>∙∙∙</td>";
                      }

                      echo "<td class='$iconClassL'>$iconLibrary</td>";
                      echo "<td class='$iconClassL'>∙∙∙</td>";
                      echo "<td class='$iconClassA'>$iconAcct</td>";
                      echo "<td class='$iconClassA'>∙∙∙</td>";
                      echo "<td class='$iconClassR'>$iconReg</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td class='statcap'>$dispDeptD</td>";
                      echo "<td></td>";

                      if($studType == "Transfer"){
                        echo "<td class='statcap'>$dispGuidanceD</td>";
                        echo "<td></td>";
                      }

                      echo "<td class='statcap'>$dispLibraryD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispAcctD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispRegD</td>";
                    echo "</tr>";
                  echo "</table>";

            echo "</div>";

            echo "<div class='col col-5'>";
              echo "<p class=caption>Remarks</p>";
                echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded' width='100%'>";
                  echo "<tr>";
                    echo "<td>$dispDeptR</td>";
                  echo "</tr>";

                      if($studType == "Transfer"){
                          echo "<td>$dispGuidanceR</td>";
                        echo "</tr>";
                      }

                    echo "<td >$dispLibraryR</td>";
                  echo "</tr>";
                    echo "<td>$dispAcctR</td>";
                  echo "</tr>";
                    echo "<td>$dispRegR</td>";
                  echo "</tr>";
                echo "</table>";
            echo "</div>";
          echo "</div>";
      }

    public function infoRegistrar(){
        $con = $this->con();
        //echo $this->type;
        if($this->type == "Graduate"){
          $sql = "SELECT * FROM `ecle_forms` WHERE `id` = '$this->id'";
        }else{
          $sql = "SELECT * FROM `ecle_forms_ug` WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

          $id = $result[0]["id"];                 // PK
          $studID = $result[0]["studentID"];      // index
          $refID = $result[0]["referenceID"];
          $temp_lname = utf8_decode($result[0]["lname"]);
          $lname = str_replace('?', 'Ñ', $temp_lname);
          $temp_fname = utf8_decode($result[0]["fname"]);
          $fname = str_replace('?', 'Ñ', $temp_fname);
          $temp_mname = utf8_decode($result[0]["mname"]);
          $mname = str_replace('?', 'Ñ', $temp_mname);
          $sy = $result[0]["sy"];
          $sem = $result[0]["semester"];
          $rawDateReq = $result[0]["dateReq"];
          $school = $result[0]["school"];
          $schoolABBR = $result[0]["schoolABBR"];
          $email = $result[0]["email"];
          $contact = $result[0]["contact"];
          $rawBday = $result[0]["bday"];
          $course = $result[0]["course"];
          $courseABBR = $result[0]["courseABBR"];
          $year = $result[0]["year"];
          $tSchool = $result[0]["transferredSchool"];
          $tReason = $result[0]["reason"];
          $studType = $result[0]["studentType"];
          $schType = $result[0]["schoolType"];
          $libraryC = $result[0]["libraryclearance"];
          $libraryR = $result[0]["libraryremarks"];
          $rawLibraryD = $result[0]["librarydate"];
          $deptC = $result[0]["departmentclearance"];
          $deptR = $result[0]["departmentremarks"];
          $rawDeptD = $result[0]["departmentdate"];
          $acctC = $result[0]["accountingclearance"];
          $acctR = $result[0]["accountingremarks"];
          $rawAcctD = $result[0]["accountingdate"];
          $regC = $result[0]["registrarclearance"];
          $regR = $result[0]["registrarremarks"];
          $rawRegD = $result[0]["registrardate"];
          $evaluator_name = evaluatorName();

          if($studType == "Transfer"){
            $guidanceC = $result[0]["guidanceclearance"];
            $guidanceR = $result[0]["guidanceremarks"];
            $rawGuidanceD = $result[0]["guidancedate"];
            $attachedID = $result[0]["file_validID"];
            $attachedLTR = $result[0]["file_letter"];
          }

        // DATE CONVERSIONS -------------------------------------------------------------------------------------------------
          if(!empty($rawBday)){                             
            $rawBday0 = strtr($rawBday, '-', '-');              
            $conv_bday = strtotime($rawBday0);                     
            $dispBday = date('F d, Y', $conv_bday);
          }

          if(!empty($rawDateReq)){                             
            $rawDateReq0 = strtr($rawDateReq, '-', '-');              
            $conv_dateReq = strtotime($rawDateReq0);                     
            $dispDateReq = date('M d, Y', $conv_dateReq);
          }

          if(!empty($rawLibraryD)){                             
            $rawLibraryD0 = strtr($rawLibraryD, '-', '-');              
            $conv_LibraryD = strtotime($rawLibraryD0);                     
            $dispLibraryD = date('M d, Y', $conv_LibraryD);
          }
          else{
            $dispLibraryD = "";
          }

          if(!empty($rawDeptD)){                             
            $rawDeptD0 = strtr($rawDeptD, '-', '-');              
            $conv_DeptD = strtotime($rawDeptD0);                     
            $dispDeptD = date('M d, Y', $conv_DeptD);
          }
          else{
            $dispDeptD = "";
          }

          if(!empty($rawAcctD)){                             
            $rawAcctD0 = strtr($rawAcctD, '-', '-');              
            $conv_AcctD = strtotime($rawAcctD0);                     
            $dispAcctD = date('M d, Y', $conv_AcctD);
          }
          else{
            $dispAcctD = "";
          }

          if(!empty($rawRegD)){                             
            $rawRegD0 = strtr($rawRegD, '-', '-');              
            $conv_RegD = strtotime($rawRegD0);                     
            $dispRegD = date('M d, Y', $conv_RegD);
          }
          else{
            $dispRegD = "";
          }

          if($studType == "Transfer"){
            if(!empty($rawGuidanceD)){                             
              $rawGuidanceD0 = strtr($rawGuidanceD, '-', '-');              
              $conv_GuidanceD = strtotime($rawGuidanceD0);                     
              $dispGuidanceD = date('M d, Y', $conv_GuidanceD);
            }
            else{
              $dispGuidanceD = "";
            }
          }

          // STATUS ICONS -------------------------------------------------------------------------------------------------
          if($libraryC == "CLEARED"){
            $iconClassL = "staticon-approved";
            $iconLibrary = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($libraryC == "ON HOLD"){
            $iconClassL = "staticon-hold";
            $iconLibrary = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassL = "staticon-pending";
            $iconLibrary = "<i class='fa-regular fa-circle'></i>";
          }

          if($deptC == "CLEARED"){
            $iconClassD = "staticon-approved";
            $iconDept = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($deptC == "ON HOLD"){
            $iconClassD = "staticon-hold";
            $iconDept = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassD = "staticon-pending";
            $iconDept = "<i class='fa-regular fa-circle'></i>";
          }

          if($acctC == "CLEARED"){
            $iconClassA = "staticon-approved";
            $iconAcct = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($acctC == "ON HOLD"){
            $iconClassA = "staticon-hold";
            $iconAcct = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassA = "staticon-pending";
            $iconAcct = "<i class='fa-regular fa-circle'></i>";
          }

          if($regC == "CLEARED"){
            $iconClassR = "staticon-approved";
            $iconReg = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($regC == "ON HOLD"){
            $iconClassR = "staticon-hold";
            $iconReg = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassR = "staticon-pending";
            $iconReg = "<i class='fa-regular fa-circle'></i>";
          }

          if($studType == "Transfer"){
            if($guidanceC == "CLEARED"){
              $iconClassG = "staticon-approved";
              $iconGuidance = "<i class='fa-solid fa-circle-check'></i>";
            }
            elseif($guidanceC == "ON HOLD"){
              $iconClassG = "staticon-hold";
              $iconGuidance = "<i class='fa-solid fa-triangle-exclamation'></i>";
            }
            else{
              $iconClassG = "staticon-pending";
              $iconGuidance = "<i class='fa-regular fa-circle'></i>";
            }
          }

        // HOLD REMARKS -------------------------------------------------------------------------------------------------
        if(!empty($libraryR)){
          $dispLibraryR = "Library Department: <b class='remarks'> $libraryR </b><br>";
        }
        else{
          $dispLibraryR = "<i class='remarks'>No remarks from Library Department </i><br>";
        }
        
        if(!empty($deptR)){
          $dispDeptR = "Dean's Office: <b class='remarks'> $deptR </b><br>";
        }
        else{
          $dispDeptR = "<i class='remarks'> No remarks from the Dean's Office </i><br>";
        }

        if(!empty($acctR)){
          $dispAcctR = "Accounting Department: <b class='remarks'> $acctR </b><br>";
        }
        else{
          $dispAcctR = "<i class='remarks'>No remarks from the Accounting Department</i><br>";
        }

        if(!empty($regR)){
          $dispRegR = "Office of the University Registrar: <b class='remarks'> $regR </b><br>";
        }
        else{
          $dispRegR = "<i class='remarks'>No remarks from the Office of the University Registrar</i><br>";
        }

        if($studType == "Transfer"){
          if(!empty($guidanceR)){
            $dispGuidanceR = "Guidance Department: <b class='remarks'> $guidanceR </b><br>";
          }
          else{
            $dispGuidanceR = "<i class='remarks'>No remarks from Guidance Department </i><br>";
          }
        }
        
        // URL Redirect -------------------------------------------------------------------------------------------------
        if($regC == "PENDING"){
          $urlA = 'req';
        }
        elseif($regC == "ON HOLD"){
          $urlA = "hld";
        }
        elseif($regC == "CLEARED"){
          $urlA = "app";
        }
        else{
          //do nothing
        }
        
        if($studType == "Graduate"){
          $urlB = 'gd';
        }
        elseif($studType == "Transfer"){
          $urlB = "tr";
        }
        else{
          //do nothing
        }

        // Button Lock -------------------------------------------------------------------------------------------------
        if($libraryC == "CLEARED" && $deptC == "CLEARED" & $acctC == "CLEARED"){
          $btnlock = "";
          $btncolor_sign = "btn-success";
          $btncolor_hold = "btn-warning";
        }else{
          $btnlock = "disabled";
          $btncolor_sign = "btn-secondary";
          $btncolor_hold = "btn-secondary";
        }
          
        echo "<h3 class='text-center'><i class='fas fa-user-circle'></i> <u> Student Information </u> </h3>";
     
        echo "<div class='table-responsive pt-4 col-12'>";
          echo "<div class='row pb-2 shadow p-3 mb-5 bg-white rounded'>";
            echo "<div class='col col-7'>";
              echo "<table class='table table-borderless' width='100%'>";
                echo "<tr>
                      <td class='desc-studID'><b>$studID</b></td>
                      </td>";
                echo "<tr class='bottomborder'>
                      <td class='value pt-0'>$lname, $fname $mname</td>
                      </tr>";
                echo "<tr><td class='desc pt-2'>School: <b>$school</b></td></tr>";
                echo "<tr><td class='desc'>Course: <b>$course</b></td></tr>";
                echo "<tr><td class='desc'>School Year & Sem: <b>SY$sy-$sem</b></td></tr>";
                echo "<tr><td class='desc'>Student Type: <b>$studType</b></td></tr>";
                echo "<tr><td class='desc'>Email Address: <b>$email</b></td></tr>";
                echo "<tr><td class='desc'>Contact Number: <b>$contact</b></td></tr>";
                echo "<tr><td class='desc'>Birthdate: <b>$dispBday</b></td></tr>";
                echo "<tr><td class='desc'><hr></td></tr>";
                if($studType == "Transfer"){
                  echo "<tr><td class='desc'>Reason for Transferring: <b>$tReason</b></tr></td>";
                  if($tSchool == "Abroad"){
                    echo "<tr><td class='desc'><b>Planning to continue studies Abroad.</b></tr></td>";
                  }
                  else{
                    echo "<tr><td class='desc'>Possible School Transferring to: <b>$tSchool</b></tr></td>";
                  }
                }
                else{
                  // do nothing
                }
              echo "</table>";
            echo "</div>";

            echo "<div class='col col-5'>";
              echo "<p class=caption>Clearance Details</p>";
                echo "<table class='table table-borderless' width='100%'>";
                  echo "<tr><td class='desc'>Reference #: <b>$refID</b></td></tr>";
                  echo "<tr><td class='desc'>Date Requested: <b>$dispDateReq</b></td></tr>";
                echo "</table>";

                echo "<p class=caption>Actions</p>";
                echo "<table class='table table-borderless' width='100%'>";
                  echo "<tr><td>";
                  
                  if($regC == "PENDING"){
                    echo "<button class='btn btn-sm btn-block d-block $btnlock $btncolor_sign' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
                  }

                  if($regC == "ON HOLD"){
                    echo"<button class='btn btn-sm btn-block $btnlock $btncolor_hold d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear</button>";
                  }else{
                    echo"<button class='btn btn-sm btn-block $btnlock $btncolor_hold d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#regsHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold Clearance</button>";
                  }
                  
                  if($studType == "Transfer"){
                    if(empty($attachedID)){
                      echo "<a href='#' class='btn btn-primary btn-sm btn-block d-block' target='_blank' disabled><i class='fa-solid fa-id-card'></i> No Attached ID</a>";
                    }else{
                      echo "<a href='#' class='btn btn-primary btn-sm btn-block d-block' target='_blank'><i class='fa-solid fa-id-card'></i> View Attached ID</a>";
                    }
                    if(empty($attachedID)){
                      echo "<a href='resource/uploads/letters/$attachedLTR' class='btn btn-primary btn-sm btn-block d-block' target='_blank'><i class='fa-solid fa-envelope'></i> View Letter of Intent for Exit</a>";
                    }else{
                      echo "<a href='resource/uploads/letters/$attachedLTR' class='btn btn-primary btn-sm btn-block d-block' target='_blank'><i class='fa-solid fa-envelope'></i> View Letter of Intent for Exit</a>";
                    }
                  }

                  echo "<a href='regs-$urlA-$urlB.php' class='btn btn-info btn-sm my-2 d-block ' data-toggle='tooltip' data-placement='top' title='Back'><i class='fa-solid fa-arrow-left'></i> Back </a>";
                        include "modals.php";
                  echo "</tr></td>";
                echo "</table>";
            echo "</div>";
          echo "</div>";

          echo "<div class='row'>";
            echo "<div class='col col-7'>";
              echo "<p class=caption>Clearance Status</p>";
                echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded' width='100%'>";
                    echo "<th class='stathead'>Dean's Ofc.</th>";
                    echo "<th> </th>";
                    
                    if($studType == "Transfer"){
                      echo "<th class='stathead'>Guidance Ofc.</th>";
                      echo "<th> </th>";
                    }

                    echo "<th class='stathead'>Library</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Accounting</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Registrar</th>";
                    echo "<tr>";
                      echo "<td class='$iconClassD'>$iconDept</td>";
                      echo "<td class='$iconClassD'>∙∙∙</td>";
                      
                      if($studType == "Transfer"){
                        echo "<td class='$iconClassG'>$iconGuidance</td>";
                        echo "<td class='$iconClassG'>∙∙∙</td>";
                      }

                      echo "<td class='$iconClassL'>$iconLibrary</td>";
                      echo "<td class='$iconClassL'>∙∙∙</td>";
                      echo "<td class='$iconClassA'>$iconAcct</td>";
                      echo "<td class='$iconClassA'>∙∙∙</td>";
                      echo "<td class='$iconClassR'>$iconReg</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td class='statcap'>$dispDeptD</td>";
                      echo "<td></td>";

                      if($studType == "Transfer"){
                        echo "<td class='statcap'>$dispGuidanceD</td>";
                        echo "<td></td>";
                      }

                      echo "<td class='statcap'>$dispLibraryD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispAcctD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispRegD</td>";
                    echo "</tr>";
                  echo "</table>";

            echo "</div>";

            echo "<div class='col col-5'>";
              echo "<p class=caption>Remarks</p>";
                echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded' width='100%'>";
                  echo "<tr>";
                    echo "<td>$dispDeptR</td>";
                  echo "</tr>";

                      if($studType == "Transfer"){
                          echo "<td>$dispGuidanceR</td>";
                        echo "</tr>";
                      }

                    echo "<td >$dispLibraryR</td>";
                  echo "</tr>";
                    echo "<td>$dispAcctR</td>";
                  echo "</tr>";
                    echo "<td>$dispRegR</td>";
                  echo "</tr>";
                echo "</table>";
            echo "</div>";
          echo "</div>";
      }

    public function infoDean(){
        $con = $this->con();
        if($this->type == "Graduate"){
          $sql = "SELECT * FROM `ecle_forms` WHERE `id` = '$this->id'";
        }else{
          $sql = "SELECT * FROM `ecle_forms_ug` WHERE `id` = '$this->id'";
        }
        $data = $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

          $id = $result[0]["id"];                 // PK
          $studID = $result[0]["studentID"];      // index
          $refID = $result[0]["referenceID"];
          $temp_lname = utf8_decode($result[0]["lname"]);
          $lname = str_replace('?', 'Ñ', $temp_lname);
          $temp_fname = utf8_decode($result[0]["fname"]);
          $fname = str_replace('?', 'Ñ', $temp_fname);
          $temp_mname = utf8_decode($result[0]["mname"]);
          $mname = str_replace('?', 'Ñ', $temp_mname);
          $sy = $result[0]["sy"];
          $sem = $result[0]["semester"];
          $rawDateReq = $result[0]["dateReq"];
          $school = $result[0]["school"];
          $schoolABBR = $result[0]["schoolABBR"];
          $email = $result[0]["email"];
          $contact = $result[0]["contact"];
          $rawBday = $result[0]["bday"];
          $course = $result[0]["course"];
          $courseABBR = $result[0]["courseABBR"];
          $year = $result[0]["year"];
          $tSchool = $result[0]["transferredSchool"];
          $tReason = $result[0]["reason"];
          $studType = $result[0]["studentType"];
          $schType = $result[0]["schoolType"];
          $libraryC = $result[0]["libraryclearance"];
          $libraryR = $result[0]["libraryremarks"];
          $rawLibraryD = $result[0]["librarydate"];
          $deptC = $result[0]["departmentclearance"];
          $deptR = $result[0]["departmentremarks"];
          $rawDeptD = $result[0]["departmentdate"];
          $acctC = $result[0]["accountingclearance"];
          $acctR = $result[0]["accountingremarks"];
          $rawAcctD = $result[0]["accountingdate"];
          $regC = $result[0]["registrarclearance"];
          $regR = $result[0]["registrarremarks"];
          $rawRegD = $result[0]["registrardate"];
          $dean_asst_name = dean_asstName();

          if($studType == "Transfer"){
            $guidanceC = $result[0]["guidanceclearance"];
            $guidanceR = $result[0]["guidanceremarks"];
            $rawGuidanceD = $result[0]["guidancedate"];
            $attachedID = $result[0]["file_validID"];
            $attachedLTR = $result[0]["file_letter"];
          }

        // DATE CONVERSIONS -------------------------------------------------------------------------------------------------
          if(!empty($rawBday)){                             
            $rawBday0 = strtr($rawBday, '-', '-');              
            $conv_bday = strtotime($rawBday0);                     
            $dispBday = date('F d, Y', $conv_bday);
          }

          if(!empty($rawDateReq)){                             
            $rawDateReq0 = strtr($rawDateReq, '-', '-');              
            $conv_dateReq = strtotime($rawDateReq0);                     
            $dispDateReq = date('M d, Y', $conv_dateReq);
          }

          if(!empty($rawLibraryD)){                             
            $rawLibraryD0 = strtr($rawLibraryD, '-', '-');              
            $conv_LibraryD = strtotime($rawLibraryD0);                     
            $dispLibraryD = date('M d, Y', $conv_LibraryD);
          }
          else{
            $dispLibraryD = "";
          }

          if(!empty($rawDeptD)){                             
            $rawDeptD0 = strtr($rawDeptD, '-', '-');              
            $conv_DeptD = strtotime($rawDeptD0);                     
            $dispDeptD = date('M d, Y', $conv_DeptD);
          }
          else{
            $dispDeptD = "";
          }

          if(!empty($rawAcctD)){                             
            $rawAcctD0 = strtr($rawAcctD, '-', '-');              
            $conv_AcctD = strtotime($rawAcctD0);                     
            $dispAcctD = date('M d, Y', $conv_AcctD);
          }
          else{
            $dispAcctD = "";
          }

          if(!empty($rawRegD)){                             
            $rawRegD0 = strtr($rawRegD, '-', '-');              
            $conv_RegD = strtotime($rawRegD0);                     
            $dispRegD = date('M d, Y', $conv_RegD);
          }
          else{
            $dispRegD = "";
          }

          if($studType == "Transfer"){
            if(!empty($rawGuidanceD)){                             
              $rawGuidanceD0 = strtr($rawGuidanceD, '-', '-');              
              $conv_GuidanceD = strtotime($rawGuidanceD0);                     
              $dispGuidanceD = date('M d, Y', $conv_GuidanceD);
            }
            else{
              $dispGuidanceD = "";
            }
          }


          // STATUS ICONS -------------------------------------------------------------------------------------------------
          if($libraryC == "CLEARED"){
            $iconClassL = "staticon-approved";
            $iconLibrary = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($libraryC == "ON HOLD"){
            $iconClassL = "staticon-hold";
            $iconLibrary = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassL = "staticon-pending";
            $iconLibrary = "<i class='fa-regular fa-circle'></i>";
          }

          if($deptC == "CLEARED"){
            $iconClassD = "staticon-approved";
            $iconDept = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($deptC == "ON HOLD"){
            $iconClassD = "staticon-hold";
            $iconDept = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassD = "staticon-pending";
            $iconDept = "<i class='fa-regular fa-circle'></i>";
          }

          if($acctC == "CLEARED"){
            $iconClassA = "staticon-approved";
            $iconAcct = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($acctC == "ON HOLD"){
            $iconClassA = "staticon-hold";
            $iconAcct = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassA = "staticon-pending";
            $iconAcct = "<i class='fa-regular fa-circle'></i>";
          }

          if($regC == "CLEARED"){
            $iconClassR = "staticon-approved";
            $iconReg = "<i class='fa-solid fa-circle-check'></i>";
          }
          elseif($regC == "ON HOLD"){
            $iconClassR = "staticon-hold";
            $iconReg = "<i class='fa-solid fa-triangle-exclamation'></i>";
          }
          else{
            $iconClassR = "staticon-pending";
            $iconReg = "<i class='fa-regular fa-circle'></i>";
          }

          if($studType == "Transfer"){
            if($guidanceC == "CLEARED"){
              $iconClassG = "staticon-approved";
              $iconGuidance = "<i class='fa-solid fa-circle-check'></i>";
            }
            elseif($guidanceC == "ON HOLD"){
              $iconClassG = "staticon-hold";
              $iconGuidance = "<i class='fa-solid fa-triangle-exclamation'></i>";
            }
            else{
              $iconClassG = "staticon-pending";
              $iconGuidance = "<i class='fa-regular fa-circle'></i>";
            }
          }

        // HOLD REMARKS -------------------------------------------------------------------------------------------------
        if(!empty($libraryR)){
          $dispLibraryR = "Library Department: <b class='remarks'> $libraryR </b><br>";
        }
        else{
          $dispLibraryR = "<i class='remarks'>No remarks from Library Department </i><br>";
        }
        
        if(!empty($deptR)){
          $dispDeptR = "Dean's Office: <b class='remarks'> $deptR </b><br>";
        }
        else{
          $dispDeptR = "<i class='remarks'> No remarks from the Dean's Office </i><br>";
        }

        if(!empty($acctR)){
          $dispAcctR = "Accounting Department: <b class='remarks'> $acctR </b><br>";
        }
        else{
          $dispAcctR = "<i class='remarks'>No remarks from the Accounting Department</i><br>";
        }

        if(!empty($regR)){
          $dispRegR = "Office of the University Registrar: <b class='remarks'> $regR </b><br>";
        }
        else{
          $dispRegR = "<i class='remarks'>No remarks from the Office of the University Registrar</i><br>";
        }

        if($studType == "Transfer"){
          if(!empty($guidanceR)){
            $dispGuidanceR = "Guidance Department: <b class='remarks'> $guidanceR </b><br>";
          }
          else{
            $dispGuidanceR = "<i class='remarks'>No remarks from Guidance Department </i><br>";
          }
        }
        
        // URL Redirect -------------------------------------------------------------------------------------------------
        if($deptC == "PENDING"){
          $urlA = 'req';
        }
        elseif($deptC == "ON HOLD"){
          $urlA = "hld";
        }
        elseif($deptC == "CLEARED"){
          $urlA = "app";
        }
        else{
          //do nothing
        }
        
        if($studType == "Graduate"){
          $urlB = 'gd';
        }
        elseif($studType == "Transfer"){
          $urlB = "tr";
        }
        else{
          //do nothing
        }
          
        echo "<h3 class='text-center'><i class='fas fa-user-circle'></i> <u> Student Information </u> </h3>";
          
        echo "<div class='table-responsive pt-4 col-12'>";
          echo "<div class='row pb-2 shadow p-3 mb-5 bg-white rounded'>";
            echo "<div class='col col-7'>";
              echo "<table class='table table-borderless' width='100%'>";
                echo "<tr>
                      <td class='desc-studID'><b>$studID</b></td>
                      </td>";
                echo "<tr class='bottomborder'>
                      <td class='value pt-0'>$lname, $fname $mname</td>
                      </tr>";
                echo "<tr><td class='desc pt-2'>School: <b>$school</b></td></tr>";
                echo "<tr><td class='desc'>Course: <b>$course</b></td></tr>";
                echo "<tr><td class='desc'>School Year & Sem: <b>SY$sy-$sem</b></td></tr>";
                echo "<tr><td class='desc'>Student Type: <b>$studType</b></td></tr>";
                echo "<tr><td class='desc'>Email Address: <b>$email</b></td></tr>";
                echo "<tr><td class='desc'>Contact Number: <b>$contact</b></td></tr>";
                echo "<tr><td class='desc'>Birthdate: <b>$dispBday</b></td></tr>";
                echo "<tr><td class='desc'><hr></td></tr>";
                if($studType == "Transfer"){
                  echo "<tr><td class='desc'>Reason for Transferring: <b>$tReason</b></tr></td>";
                  if($tSchool == "Abroad"){
                    echo "<tr><td class='desc'><b>Planning to continue studies Abroad.</b></tr></td>";
                  }
                  else{
                    echo "<tr><td class='desc'>Possible School Transferring to: <b>$tSchool</b></tr></td>";
                  }
                }
                else{
                  // do nothing
                }
              echo "</table>";
            echo "</div>";

            echo "<div class='col col-5'>";
              echo "<p class=caption>Clearance Details</p>";
                echo "<table class='table table-borderless' width='100%'>";
                  echo "<tr><td class='desc'>Reference #: <b>$refID</b></td></tr>";
                  echo "<tr><td class='desc'>Date Requested: <b>$dispDateReq</b></td></tr>";
                echo "</table>";

                echo "<p class=caption>Actions</p>";
                echo "<table class='table table-borderless' width='100%'>";
                  echo "<tr><td>";
                  
                  if($deptC == "PENDING"){
                    echo "<button class='btn btn-sm btn-block btn-success d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#deanModal$id' data-id='$id'><i class='fa-solid fa-check'></i> Sign</button>";
                  }

                  if($deptC == "ON HOLD"){
                    echo"<button class='btn btn-sm btn-block btn-warning d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#deanHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Clear</button>";
                  }else{
                    echo"<button class='btn btn-sm btn-block btn-warning d-block' id='btn' type='button' data-bs-toggle='modal' data-bs-target='#deanHold$id' data-id='$id'><i class='fa-solid fa-triangle-exclamation'></i> Hold Clearance</button>";
                  }

                  if($studType == "Transfer"){
                    echo "<a href='resource/uploads/ids/$attachedID' class='btn btn-primary btn-sm btn-block d-block' target='_blank'><i class='fa-solid fa-id-card'></i> View Attached ID</a>";
                    echo "<a href='resource/uploads/letters/$attachedLTR' class='btn btn-primary btn-sm btn-block d-block' target='_blank'><i class='fa-solid fa-envelope'></i> View Letter of Intent for Exit</a>";
                  }
                          
                  echo "<a href='dean-$urlA-$urlB.php' class='btn btn-info btn-sm my-2 d-block ' data-toggle='tooltip' data-placement='top' title='Back'><i class='fa-solid fa-arrow-left'></i> Back </a>";
                        include "modals.php";
                  echo "</tr></td>";
                echo "</table>";
            echo "</div>";
          echo "</div>";

          echo "<div class='row'>";
            echo "<div class='col col-7'>";
              echo "<p class=caption>Clearance Status</p>";
                echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded' width='100%'>";
                    echo "<th class='stathead'>Dean's Ofc.</th>";
                    echo "<th> </th>";

                    if($studType == "Transfer"){
                      echo "<th class='stathead'>Guidance Ofc.</th>";
                      echo "<th> </th>";
                    }

                    echo "<th class='stathead'>Library</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Accounting</th>";
                    echo "<th> </th>";
                    echo "<th class='stathead'>Registrar</th>";
                    echo "<tr>";
                      echo "<td class='$iconClassD'>$iconDept</td>";
                      echo "<td class='$iconClassD'>∙∙∙</td>";

                      if($studType == "Transfer"){
                        echo "<td class='$iconClassG'>$iconGuidance</td>";
                        echo "<td class='$iconClassG'>∙∙∙</td>";
                      }

                      echo "<td class='$iconClassL'>$iconLibrary</td>";
                      echo "<td class='$iconClassL'>∙∙∙</td>";
                      echo "<td class='$iconClassA'>$iconAcct</td>";
                      echo "<td class='$iconClassA'>∙∙∙</td>";
                      echo "<td class='$iconClassR'>$iconReg</td>";
                    echo "</tr>";
                    echo "<tr>";
                      echo "<td class='statcap'>$dispDeptD</td>";
                      echo "<td></td>";

                      if($studType == "Transfer"){
                        echo "<td class='statcap'>$dispGuidanceD</td>";
                        echo "<td></td>";
                      }

                      echo "<td class='statcap'>$dispLibraryD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispAcctD</td>";
                      echo "<td></td>";
                      echo "<td class='statcap'>$dispRegD</td>";
                    echo "</tr>";
                  echo "</table>";

            echo "</div>";

            echo "<div class='col col-5'>";
              echo "<p class=caption>Remarks</p>";
                echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded' width='100%'>";
                  echo "<tr>";
                    echo "<td>$dispDeptR</td>";
                  echo "</tr>";

                      if($studType == "Transfer"){
                          echo "<td>$dispGuidanceR</td>";
                        echo "</tr>";
                      }

                    echo "<td >$dispLibraryR</td>";
                  echo "</tr>";
                    echo "<td>$dispAcctR</td>";
                  echo "</tr>";
                    echo "<td>$dispRegR</td>";
                  echo "</tr>";
                echo "</table>";
            echo "</div>";
          echo "</div>";
      }
    
  }

?>
