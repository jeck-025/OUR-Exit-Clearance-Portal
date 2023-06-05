<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';

class reference extends config{

    public $transnumber;
    
    function __construct($transnumber=null){
        $this->transnumber=ucfirst($transnumber);
    }

    public function referenceCheck(){
        $con = $this->con();
        $sql = "SELECT * FROM `ecle_forms_ug` WHERE `referenceID` = '$this->transnumber'";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
            echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b><i class="fa-solid fa-triangle-exclamation"></i> Error: </b> Invalid Reference Number
                </div>';
        }
        else {
            foreach ($result as $data) {
                if($data['studentType'] === "Transfer"){
                    if($data['libraryclearance'] === 'PENDING' && 
                        $data['guidanceclearance'] === 'PENDING' && 
                        $data['departmentclearance'] === 'PENDING' && 
                        $data['accountingclearance'] === 'PENDING' && 
                        $data['registrarclearance'] === 'PENDING' && 
                        $data['expiry'] === 'NO'){
                            echo "<h5>The current status for <h5 class='data'>$data[fname] $data[mname] $data[lname]</h5> <h5>with transaction number <h5 class='data'>$data[referenceID]</h5>, <h5>is still being reviewed.</h5>";
                    }elseif($data['libraryclearance'] === 'CLEARED' && 
                        $data['guidanceclearance'] === 'PENDING' && 
                        $data['departmentclearance'] === 'CLEARED' && 
                        $data['accountingclearance'] === 'CLEARED' && 
                        $data['registrarclearance'] === 'CLEARED' && 
                        $data['expiry'] === 'NO'){
                            echo "<h5>The current status for <h5 class='data'>$data[fname] $data[mname] $data[lname]</h5> <h5>with transaction number <h5 class='data'>$data[referenceID]</h5>, <h5>has been finished reviewing, <a href='formDownload.php?referenceID=$data[referenceID]'>download</a> your copy.</h5>";
                    }elseif($data['expiry'] === 'YES'){
                        echo "<h5>Your form has expired due to unattended remarks available, please resubmit a form or contact a Teacher-In-Charge</h5>";
                    }else{
                            $libraryC = $data["libraryclearance"];
                            $deptC = $data["departmentclearance"];
                            $acctC = $data["accountingclearance"];
                            $regC = $data["registrarclearance"];

                            $libraryR = $data["libraryremarks"];
                            $deptR = $data["departmentremarks"];
                            $acctR = $data["accountingremarks"];
                            $regR = $data["registrarremarks"];

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
                        echo "<h3 class='text-center font-weight-bold'> Student Information </h3>";
                        echo "<div class='table-responsive'>";
                        echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
                        echo "<thead class='thead-dark' style='font-size: medium'>";
                        echo "<th>Dean's Office</th>";
                        echo "<th>Library</th>";
                        echo "<th>Accounting</th>";
                        echo "<th>Registrar</th>";
                        echo "</thead>";
                        echo "<br>";
                        echo "<p> <small>Student Name:</small>&emsp;<strong> $data[lname], $data[fname] $data[mname]</strong></p>";
                        // echo "<p> <small>First Name:</small>&emsp;<strong> $data[fname] </strong> &emsp;&emsp; <small>Last Name:</small>&emsp;<strong>$data[lname]</strong>  &emsp;&emsp;<small>Middle Name: </small>&emsp;<strong>$data[mname]</strong></p>";
                        echo "<p> <small>Course:&emsp;</small><strong> $data[course]</strong></p>";
                        echo "<p> <small>Email:&emsp;</small><strong> $data[email]</strong> </p>";
                        echo "<hr>";
                        if($data['registrarclearance'] === "CLEARED" && $data['expiry'] === 'NO'){
                             echo "<h5><a href='formDownload.php?referenceID=$data[referenceID]&type=Transfer' class='btn btn-sm btn-outline-light'><i class='fa-solid fa-file-arrow-down'></i> DOWNLOAD</a> the copy of your Clearance Form</h5><br>";
                        }else{
                            echo "h3 class='text-center font-weight-bold'> Clearance Status </h3>";
                        }
                        echo "<br>";
                        echo "<tr class='text-white'>";
                        echo "<td style='font-size: large'>$deptC </td>";
                        echo "<td style='font-size: large'>$libraryC</td>";
                        echo "<td style='font-size: large'>$acctC</td>";
                        echo "<td style='font-size: large'>$regC</td>";
                        echo "</tr>";   
                        echo "<tr class='text-white'>";
                        echo "<td class='$iconClassD'>$iconDept</td>";
                        echo "<td class='$iconClassL'>$iconLibrary</td>";
                        echo "<td class='$iconClassA'>$iconAcct</td>";
                        echo "<td class='$iconClassR'>$iconReg</td>";
                        echo "</tr>";
                        echo "<tr class='text-white'>";
                        if($data['registrarclearance'] === "CLEARED" && $data['expiry'] === 'NO'){
                            // do not display remarks area
                        }else{
                            if(!empty($deptR)){
                                echo "<td style='font-size: small; width:25%;'>$deptR</td>";
                            }else{
                                echo "<td style='font-size: small; width:25%;'><i>No Remarks</i></td>";
                            }
                            if(!empty($libraryR)){
                                echo "<td style='font-size: small; width:25%;'>$libraryR</td>";
                            }else{
                                echo "<td style='font-size: small; width:25%;'><i>No Remarks</i></td>";
                            }
                            if(!empty($acctR)){
                                echo "<td style='font-size: small; width:25%;'>$acctR</td>";
                            }else{
                                echo "<td style='font-size: small; width:25%;'><i>No Remarks</i></td>";
                            }
                            if(!empty($regR)){
                                echo "<td style='font-size: small; width:25%;'>$regR</td>";
                            }else{
                                echo "<td style='font-size: small; width:25%;'><i>No Remarks</i></td>";
                            }
                        }
                        echo "</tr>";
                        echo "</table>";
                        echo "</div>";
                    }
                }else{
                    echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                            <b><i class="fa-solid fa-triangle-exclamation"></i> Error:</b> Please refer to the <a class="al" href="ecle/graduateLogin.php"><b>Graduate Section</b></a> for your reference checker.
                        </div>';
                }
            }
        }
    }
}
?>