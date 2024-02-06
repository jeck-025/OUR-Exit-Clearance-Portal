<?php
// require_once 'config2.php';

class ovrData extends config{

    public function viewRaw($id, $stud_type){

        if(isset($_POST['saveChanges'])){
            $this->update();
        }

        $view = new view();
        $con = $this->con();

        if($stud_type == "grad"){
            $sql = "SELECT * FROM `ecle_forms` WHERE `studentID` = '$id'";
        }elseif($stud_type == "under"){
            $sql = "SELECT * FROM `ecle_forms_ug` WHERE `studentID` = '$id'";
        }else{
            echo "Error.";
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
          $tSchool = strtoupper(str_replace('?', 'Ñ', utf8_decode($result[0]['transferredSchool'])));
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

          if($studType == "Under"){
            $guidanceC = $result[0]["guidanceclearance"];
            $guidanceR = $result[0]["guidanceremarks"];
            $rawGuidanceD = $result[0]["guidancedate"];
            $attachedID = $result[0]["file_validID"];
            $attachedLTR = $result[0]["file_letter"];
          }

          if($regC == "PENDING")
          {
            $rcc = "bg-info";
          }else{
            $rcc = "";
          }
    
    echo "<form method='post' action=''>";

    echo "<div class='row d-flex justify-content-between'>";
        echo "<div class='col col-md-5'>";
            echo "<h3 class='text-center mt-5'><i class='fas fa-user-circle'></i> <u> Student Information </u> </h3>";
        echo "</div>";
        echo "<div class='col col-md-2 justify-content-center'>";
        echo "<button type='submit' name='saveChanges' class='btn btn-adduser btn-block mt-3 mr-3'><i class='fa-solid fa-floppy-disk'></i> Save Changes</button>";
        echo "<a class='btn btn-dark btn-block mt-1 mr-3' href='override'><i class='fa-solid fa-person-walking-arrow-right'></i> Cancel</a>";
        echo "</div>";
    echo "</div>";
    echo "<hr>";
     
        echo "<div class='table-responsive mt-4 col-12'>";
            echo "<div class='row justify-content-center'>";
                echo "<div class='col col-10'>";
                    echo "<table class='table table-borderless' width='100%'>";

                        echo "<tr><td>Reference #: <h4><b>$refID</b></h4></td></tr>
                                <tr><td>Date Requested: <h4><b>$rawDateReq</b></h4></td></tr>
                                <tr><td>Student Number: <h4><b>$studID</b></h4>
                                <input type='hidden' name='studID' value='$studID'></td></tr>";
                        
                        echo "<tr>
                                <td>Last Name <input class='form-control' type='text' name='lastName' value='$lname' required> 
                                    First Name <input class='form-control' type='text' name='firstName' value='$fname' required>
                                    Middle Name <input class='form-control' type='text' name='middleName' value='$mname' required>
                                </td>
                            </tr>";

                        echo "<tr>
                                <td class='pt-2'>School:
                                    <select name='school' class='form-control selectpicker' data-live-search='true' required>
                                    <option data-tokens='$school' value='$school'>$school</option>";
                                        $view->collegeSP2();
                                echo "</select>
                                </td>
                            </tr>";

                        echo "<tr>
                                <td class='pt-2'>Course:
                                    <select name='course' class='form-control selectpicker' data-live-search='true' required>
                                    <option data-tokens='$course' value='$course'>$course</option>";
                                        $view->courseSP2();
                                echo "</select>
                                </td>
                            </tr>";

                        if($studType == "Graduate"){
                            echo "<tr>
                                    <td>
                                        <div class='row'>
                                            <div class='col col-6'>
                                                School Year <input class='form-control' type='text' name='schYear' value='$sy' required> 
                                            </div>
                                            <div class='col col-6'>
                                                Semester <input class='form-control' type='text' name='sem' value='$sem' required>
                                            </div>
                                        </div>
                                    </td>
                                </tr>";
                        }else{
                            echo "<tr>
                                <td>
                                    Last Year Enrolled <input class='form-control' type='text' name='year' value='$year' required> 
                                </td>
                            </tr>";
                        }

                        echo "<tr>
                                <td class='pt-2'>Student Type:
                                    <select name='studType' class='form-control selectpicker'>
                                        <option data-tokens='$studType' value='$studType'>$studType</option>
                                        <option data-tokens='Graduate' value='Graduate'>Graduate</option>
                                        <option data-tokens='Transfer' value='Transfer'>Undergraduate / Transfer</option>
                                    </select>
                                </td>
                            </tr>";

                        echo "<tr>
                                <td>Email Address: <input class='form-control' type='text' name='email' value='$email' required></td>
                            </tr>";

                        echo "<tr>
                                <td>
                                    <div class='row'>
                                        <div class='col col-8'>
                                            Contact Number <input class='form-control' type='text' name='contact' value='$contact'>
                                        </div>
                                        <div class='col col-4'>
                                            Birthdate: <input type='date' class='form-control' name='bdate' value='$rawBday'
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                echo "</table>";
            echo "</div>";
        echo "</div>";

        echo "<hr><div class='row justify-content-center'>";
            echo "<h3 class='text-center my-4'><i class='fas fa-user-circle'></i> <u> Clearance Status </u> </h3>";
                echo "<div class='col col-11'>";
                    
                    echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded text-center' width='100%'>";
                        echo "<th>Dean's Office</th>";
                        if($studType == "Transfer"){
                            echo "<th>Guidance Office</th>";}
                        echo "<th>Library</th>";
                        echo "<th>Accounting</th>";
                        echo "<th>Registrar</th>";
                        echo "<tr>";
                        echo "<td class='pt-2'>
                                    Status
                                    <select name='deptC' class='form-control selectpicker'>
                                        <option data-tokens='$deptC' value='$deptC'>$deptC</option>
                                        <option data-tokens='PENDING' value='PENDING'>PENDING</option>
                                        <option data-tokens='ON-HOLD' value='ON-HOLD'>ON-HOLD</option>
                                        <option data-tokens='CLEARED' value='CLEARED'>CLEARED</option>
                                    </select>
                                </td>";
                        if($studType == "Transfer"){
                            echo "<td class='pt-2'>
                                    Status
                                    <select name='guidanceC' class='form-control selectpicker'>
                                        <option data-tokens='$guidanceC' value='$guidanceC'>$guidanceC</option>
                                        <option data-tokens='PENDING' value='PENDING'>PENDING</option>
                                        <option data-tokens='ON-HOLD' value='ON-HOLD'>ON-HOLD</option>
                                        <option data-tokens='CLEARED' value='CLEARED'>CLEARED</option>
                                    </select>
                                </td>";}
                            echo "<td class='pt-2'>
                                    Status
                                    <select name='libraryC' class='form-control selectpicker'>
                                        <option data-tokens='$libraryC' value='$libraryC'>$libraryC</option>
                                        <option data-tokens='PENDING' value='PENDING'>PENDING</option>
                                        <option data-tokens='ON-HOLD' value='ON-HOLD'>ON-HOLD</option>
                                        <option data-tokens='CLEARED' value='CLEARED'>CLEARED</option>
                                    </select>
                                </td>";
                            echo "<td class='pt-2'>
                                    Status
                                    <select name='acctC' class='form-control selectpicker'>
                                        <option data-tokens='$acctC' value='$acctC'>$acctC</option>
                                        <option data-tokens='PENDING' value='PENDING'>PENDING</option>
                                        <option data-tokens='ON-HOLD' value='ON-HOLD'>ON-HOLD</option>
                                        <option data-tokens='CLEARED' value='CLEARED'>CLEARED</option>
                                    </select>
                                </td>";
                            echo "<td class='pt-2'>
                                    Status
                                    <select name='regC' class='form-control selectpicker'>
                                        <option data-tokens='$regC' value='$regC'>$regC</option>
                                        <option data-tokens='PENDING' value='PENDING'>PENDING</option>
                                        <option data-tokens='ON-HOLD' value='ON-HOLD'>ON-HOLD</option>
                                        <option data-tokens='CLEARED' value='CLEARED'>CLEARED</option>
                                        <option data-tokens='REMOVED' value='REMOVED'>REMOVED</option>
                                    </select>
                                </td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td>Date: <input type='date' class='form-control' name='deptD' value='$rawDeptD'></td>";
                        if($studType == "Transfer"){
                            echo "<td>Date: <input type='date' class='form-control' name='guidanceD' value='$rawGuidanceD'></td>";}
                        echo "<td>Date: <input type='date' class='form-control' name='libraryD' value='$rawLibraryD'></td>";
                        echo "<td>Date: <input type='date' class='form-control' name='acctD' value='$rawAcctD'></td>";
                        echo "<td>Date: <input type='date' class='form-control' name='regD' value='$rawRegD'></td>";
                        echo "</tr>";
                    echo "</table>";
                echo "</div>";
        echo "</div>";

        echo "<hr><div class='row justify-content-center'>";
            echo "<h3 class='text-center my-4'><i class='fas fa-user-circle'></i> <u> Remarks </u> </h3>";
                echo "<div class='col col-11'>";
                    echo "<table class='table table-borderless shadow p-3 mb-5 bg-white rounded' width='100%'>";
                        echo "<tr> 
                                <td>Dean's Office Remarks: <input class='form-control' type='text' name='deptR' value='$deptR'></td>
                            </tr>";
                        if($studType == "Transfer"){
                            echo "<td>Guidance Office Remarks: <input class='form-control' type='text' name='guidanceR' value='$guidanceR'></td>";}
                        echo "<tr> 
                                <td>Library Remarks: <input class='form-control' type='text' name='libraryR' value='$libraryR'></td>
                            </tr>";
                        echo "<tr> 
                                <td>Accounting Dept. Remarks: <input class='form-control' type='text' name='acctR' value='$acctR'></td>
                            </tr>";
                        echo "<tr> 
                                <td>Registrar's Office Remarks: <input class='form-control' type='text' name='regR' value='$regR'></td>
                            </tr>";
                    echo "</table>";
                echo "</div>";
        echo "</div>";
        
        echo "<hr><div class='row d-flex justify-content-center pb-5'>";
            echo "<div class='col col-md-5 '>";
                echo "<a class='btn btn-dark btn-block mt-4 mr-1' href='override'><i class='fa-solid fa-person-walking-arrow-right'></i> Cancel</a>";
                echo "<button type='submit' name='saveChanges' class='btn btn-block btn-adduser'><i class='fa-solid fa-floppy-disk'></i> Save Changes</button>";
            echo "</div>";
        echo "</div>";
    echo "</div>";
    echo "</form>";
    }

    public function update(){
        $id = $_POST['studID'];
        $new_lname = $_POST['lastName'];
        $new_fname = $_POST['firstName'];
        $new_mname = $_POST['middleName'];
        $new_school = $_POST['school'];
        $new_course = $_POST['course'];
        $new_email = $_POST['email'];
        $new_contact = $_POST['contact'];
        $new_bday = $_POST['bdate'];
        $new_deptC = $_POST['deptC'];
        $new_libraryC = $_POST['libraryC'];
        $new_acctC = $_POST['acctC'];
        $new_regC = $_POST['regC'];
        $new_deptD = $_POST['deptD'];
        $new_libraryD = $_POST['libraryD'];
        $new_acctD = $_POST['acctD'];
        $new_regD = $_POST['regD'];
        $new_deptR = $_POST['deptR'];
        $new_libraryR = $_POST['libraryR'];
        $new_acctR = $_POST['acctR'];
        $new_regR = $_POST['regR'];
        $type = $_POST['studType'];

        if($type == "Transfer"){
            $new_year = $_POST['year'];
            $new_guidanceC = $_POST['guidanceC'];
            $new_guidanceD = $_POST['guidanceD'];
            $new_guidanceR = $_POST['guidanceR'];
            $sql = "UPDATE `ecle_forms_ug` SET `lname` = '$new_lname' WHERE `studentID` = '$id'";
        }elseif($type == "Graduate"){
            $new_sy = $_POST['schYear'];
            $new_sem = $_POST['sem'];
            $sql = "UPDATE `ecle_forms` SET `lname` = '$new_lname' WHERE `studentID` = '$id'";
        }else{
            echo "Error.";
        }

        $con = $this->con();
        $data = $con->prepare($sql);
            try{$data->execute();
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <i class='fa-solid fa-circle-check'></i> Changes Saved.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                        
            }catch(PDOException $e){
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <strong><i class='fa-solid fa-triangle-exclamation'></i> Update Failed. </strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
            }
    }
}
?>
