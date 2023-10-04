<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailTransfer.php';

class insert extends config{

    public $fname,$lname,$mname,$studID,$email,$contact,$course,$year,$sem,$university,$reason, $validID, $validID_tmp, $file_letter, $file_letter_tmp, $validIDsize, $lettersize;
    
    function __construct($fname=null,$lname=null,$mname=null,$studID=null,$email=null,$contact=null,$course=null,$bday=null,$year=null, $sem=null, $university=null, $reason=null, $validID=null, $validID_tmp=null, $file_letter=null, $file_letter_tmp = null, $validIDsize = null, $lettersize = null){

        $this->fname = $fname;
        $this->lname = $lname;
        $this->mname = $mname;
        $this->studID = $studID;
        $this->email = $email;
        $this->contact = $contact;
        $this->course = $course;
        $this->bday = $bday;
        $this->year = $year."-".$sem;
        $this->university = $university;
        $this->reason = $reason;
        $this->valid_ID = $validID;
        $this->file_Letter = $file_letter;
        $this->valid_IDsize = $validIDsize;
        $this->file_Lettersize = $lettersize;

        //Get Filename Extensions
        $vID = strtolower(pathinfo($this->valid_ID['name'], PATHINFO_EXTENSION));
        $vLtr = strtolower(pathinfo($this->file_Letter['name'], PATHINFO_EXTENSION));

        //Get Temporary Filenames from Temporary Folder
        $this->file_letter_tmp = $file_letter_tmp;
        $this->validID_tmp = $validID_tmp;

        $curdate = date("mdyHis");
        
        //Error counter
        $error = 0;

        if($vLtr !== "pdf" || $vLtr == ""){
            echo "<div class='alert alert-danger' role='alert'>
                    <i class='fa-solid fa-triangle-exclamation'></i> Error: Valid ID: File must be PDF.
                </div>";
            $error = $error + 1;
        }
    
        if($vID !== "pdf" || $vID == ""){
            echo "<div class='alert alert-danger' role='alert'>
                    <i class='fa-solid fa-triangle-exclamation'></i> Error: Letter of Intent: File must be PDF.
                </div>";
            $error = $error + 1;
        }

        if($error == 0){
            $this->valid_ID['name'] = $this->studID."_".$this->lname."_".$this->fname."_id".$curdate.".".$vID;
            $storage2 = "resource/uploads/ids/";
            $this->idFile = $storage2 . $this->valid_ID['name'];
            move_uploaded_file($this->validID_tmp, $this->idFile);

            $this->file_letter['name'] = $studID."_".$this->lname."_".$this->fname."_letter".$curdate.".".$vLtr;
            $storage = "resource/uploads/letters/";
            $this->ltrfile = $storage . $this->file_letter['name'];
            move_uploaded_file($this->file_letter_tmp, $this->ltrfile);

            $this->insertApplication();
        }
    }

    public function insertApplication(){

        $transnumber = uniqid('TransferMNL');
        $studentType = "Transfer";
        $config = new config;

        $con = $config->con();
        $sql2 = "SELECT * FROM `courseschool` WHERE `course` = '$this->course'";
        $data2 = $con->prepare($sql2);
        $data2 ->execute();
        $result = $data2->fetchALL(PDO::FETCH_ASSOC);
        $schoolType = $result[0]["type"];
        $school = $result[0]["department"];
        $schoolABBR = $result[0]["departmentABBR"];
        $courseABBR = $result[0]["courseABBR"];

        $con = $config->con();
        $sql4 = "SELECT * FROM `config`";
        $data4 = $con->prepare($sql4);
        $data4 ->execute();
        $result2 = $data4->fetchALL(PDO::FETCH_ASSOC);
        $semester = $result2[0]["semester"];
        $schoolYear = $result2[0]["schoolYear"];
        $filenameVID = $this->valid_ID['name'];
        $filenameLTR = $this->file_letter['name'];


        //check for duplicates

        if($this->studID == "0000-00000"){
            $match = 0;
        }else{
            $sqlcheck = "SELECT COUNT(`studentID`) as `match` from `ecle_forms_ug` WHERE `studentID` LIKE '$this->studID'";
            $datacheck = $con->prepare($sqlcheck);
            $datacheck ->execute();
            $checkrslt = $datacheck->fetchAll(PDO::FETCH_ASSOC);
            $match = $checkrslt[0]['match'];
        }

        if($match == 0){
            if ($schoolType === "Science"){
                $sql1 = "INSERT INTO `ecle_forms_ug`(`lname`, `fname`, `mname`, `semester`, `sy`, `school`, `schoolABBR`, `studentID`, `email`, `contact`, `bday`, `course`, `courseABBR`, `year`, `transferredSchool`, `reason`, `studentType`, `schoolType`, `referenceID`, `file_validID`, `file_letter`) VALUES ('$this->lname', '$this->fname', '$this->mname', '$semester', '$schoolYear', '$school', '$schoolABBR', '$this->studID', '$this->email', '$this->contact', '$this->bday', '$this->course', '$courseABBR', '$this->year', '$this->university', '$this->reason', '$studentType', '$schoolType', '$transnumber', '$filenameVID', '$filenameLTR')";
                $data1 = $con->prepare($sql1);
                $data1->execute();
                sendReferenceMail($this->lname, $this->fname, $this->mname, $transnumber, $this->email);
                echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                        <b>Congratulations!</b> Your clearance request has been successfully submitted! Your Reference Number is: <b>'.$transnumber.'</b>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }else{
                $sql1 = "INSERT INTO `ecle_forms_ug`(`lname`, `fname`, `mname`, `semester`, `sy`, `school`, `schoolABBR`, `studentID`, `email`, `contact`, `bday`, `course`, `courseABBR`, `year`, `transferredSchool`, `reason`, `studentType`, `schoolType`, `referenceID`, `file_validID`, `file_letter`) VALUES ('$this->lname', '$this->fname', '$this->mname', '$semester', '$schoolYear', '$school', '$schoolABBR', '$this->studID', '$this->email', '$this->contact', '$this->bday', '$this->course', '$courseABBR', '$this->year', '$this->university', '$this->reason', '$studentType', '$schoolType', '$transnumber', '$filenameVID', '$filenameLTR')";
                $data1 = $con->prepare($sql1);
                $data1->execute();
                sendReferenceMail($this->lname, $this->fname, $this->mname, $transnumber, $this->email);
                echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                        <b>Congratulations!</b> Your clearance request has been successfully submitted! Your Reference Number is: <b>'.$transnumber.'. Kindly check your email for updates. Thank you</b>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }
        }else{
            echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                     <b>Error!</b> Your request could not be submitted. Student Number entered already has requested Exit Clearance or Information has invalid input.
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                 </div>';
        }
    }

}
?>