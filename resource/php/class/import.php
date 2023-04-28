<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';

class import extends config{

    public function insertGraduate(){
        if(isset($_POST['importSubmit'])){
            $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'text/octet-stream', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain',);

            if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    
                    //check if headers match from file uploaded to the headers expected
                    
                    //declare the expected variables
                    $requiredH = array('LNAME', 'FNAME', 'MNAME', 'Birthday', 'studentID', 'Email', 'Course', 'Year Last Enrolled');
                    //open CSV
                    $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                    //get the first line (headers)
                    $firstLine = fgets($csvFile);
                    //close CSV
                    fclose($csvFile);
                    //parse the first line into array
                    $foundHeaders = str_getcsv(trim($firstLine), ',', '"');
                    //check if headers from file matches with the declared headers
                    if($foundHeaders !== $requiredH) {
                        // echo 'Headers do not match: <br>'.implode(', ', $foundHeaders);
                        // echo '<br>'.implode(', ', $requiredH);
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-triangle-exclamation"></i> Error:</strong> 
                                Header count does not match
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                    }else{
                        // echo" tuloy ";
                        // die();
                        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                        fgetcsv($csvFile);
                        while(($line = fgetcsv($csvFile)) !== FALSE){
                            $lname = $line[0];
                            $fname = $line[1];
                            $mname = $line[2];
                            $bday = $line[3];
                            $studentID = $line[4];
                            $email = $line[5];
                            $course = $line[6];
                            $year = $line[7];
                            $studentType = "Graduate";
                            $transnumber = uniqid('Graduate');

                            $config = new config;
                            $con = $config->con();
                            $sql2 = "SELECT `type` FROM `courseschool` WHERE `course` = '$course'";
                            $data2 = $con->prepare($sql2);
                            $data2 ->execute();
                            $schoolType = $data2->fetchColumn();

                            $con = $config->con();
                            $sql5 = "SELECT `department` FROM `courseschool` WHERE `course` = '$course'";
                            $data5 = $con->prepare($sql5);
                            $data5 ->execute();
                            $school = $data5->fetchColumn();

                            $con = $config->con();
                            $sql6 = "SELECT `departmentABBR` FROM `courseschool` WHERE `course` = '$course'";
                            $data6 = $con->prepare($sql6);
                            $data6 ->execute();
                            $schoolABBR = $data6->fetchColumn();

                            $con = $config->con();
                            $sql7 = "SELECT `courseABBR` FROM `courseschool` WHERE `course` = '$course'";
                            $data7 = $con->prepare($sql7);
                            $data7 ->execute();
                            $courseABBR = $data7->fetchColumn();

                            $con = $config->con();
                            $sql3 = "SELECT `semester` FROM `config`";
                            $data3 = $con->prepare($sql3);
                            $data3 ->execute();
                            $semester = $data3->fetchColumn();

                            $con = $config->con();
                            $sql4 = "SELECT `schoolYear` FROM `config`";
                            $data4 = $con->prepare($sql4);
                            $data4 ->execute();
                            $schoolYear = $data4->fetchColumn();

                            //$sy = $schoolYear.'-'.$semester;

                            if($schoolType === "Science"){
                                $sql1 = "INSERT INTO `ecle_forms`(`lname`, `fname`, `mname`, `semester`, `sy`, `school`, `schoolABBR`, `studentID`, `email`, `bday`, `course`, `courseABBR`, `year`, `studentType`, `schoolType`, `referenceID`) VALUES ('$lname', '$fname', '$mname', '$semester', '$schoolYear', '$school', '$schoolABBR', '$studentID', '$email', '$bday', '$course', '$courseABBR', '$year', '$studentType', '$schoolType', '$transnumber')";
                                $data1 = $con->prepare($sql1);
                                $data1->execute();
                            }else{
                                $sql1 = "INSERT INTO `ecle_forms`(`lname`, `fname`, `mname`, `semester`, `sy`, `school`, `schoolABBR`, `studentID`, `email`, `bday`, `course`, `courseABBR`, `year`, `studentType`, `schoolType`, `referenceID`) VALUES ('$lname', '$fname', '$mname', '$semester', '$schoolYear', '$school', '$schoolABBR', '$studentID', '$email', '$bday', '$course', '$courseABBR', '$year', '$studentType', '$schoolType', '$transnumber')";
                                $data1 = $con->prepare($sql1);
                                $data1->execute();
                            }
                        }
                        fclose($csvFile);
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-circle-check"></i> Upload Success! </strong> Please check the database if data were inserted correctly.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                    }
                }
            }
            else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-triangle-exclamation"></i> Error:</strong> 
                    Invalid file. Format must be "CSV".
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }
    }
}


?>