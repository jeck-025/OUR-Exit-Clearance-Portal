<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailTransfer.php';

class insert extends config{

    public $fname,$lname,$mname,$studID,$email,$contact,$course,$year,$university,$reason, $validID, $validID_tmp, $file_letter, $file_letter_tmp;
    
    function __construct($fname=null,$lname=null,$mname=null,$studID=null,$email=null,$contact=null,$course=null,$bday=null,$year=null, $university=null, $reason=null, $validID=null, $validID_tmp=null, $file_letter=null, $file_letter_tmp = null){

    $this->fname =$fname;
    $this->lname =$lname;
    $this->mname =$mname;
    $this->studID =$studID;
    $this->email =$email;
    $this->contact =$contact;
    $this->course =$course;
    $this->bday =$bday;
    $this->year =$year;
    $this->university = $university;
    $this->reason = $reason;
    $this->valid_ID = $validID;
    $this->file_Letter = $file_letter;
    
    //Files
    // //Get Filenames
    // $filenameVID = $this->validID['name'];
    // $filenameLTR = $this->file_letter['name'];

    //Get Filename Extensions
    $vID = strtolower(pathinfo($this->valid_ID['name'], PATHINFO_EXTENSION));
    $vLtr = strtolower(pathinfo($this->file_Letter['name'], PATHINFO_EXTENSION));

    //Get Temporary Filenames from Temporary Folder
    $this->file_letter_tmp = $file_letter_tmp;
    $this->validID_tmp = $validID_tmp;
    

    $error = 0;

    if($vLtr !== "pdf" || $vLtr == ""){
        echo "<div class='alert alert-danger' role='alert'>
                <i class='fa-solid fa-triangle-exclamation'></i> Error: Valid ID: File must be PDF.
            </div>";
        $error = $error + 1;
    }elseif($vID !== "pdf" || $vID == ""){
        echo "<div class='alert alert-danger' role='alert'>
                <i class='fa-solid fa-triangle-exclamation'></i> Error: Letter of Intent: File must be PDF.
            </div>";
        $error = $error + 1;
    }else{
        $this->valid_ID['name'] = $this->studID."_".$this->lname."_".$this->fname."_id.".$vID;
        $storage2 = "resource/uploads/ids/";
        $this->idFile = $storage2 . $this->valid_ID['name'];
        move_uploaded_file($this->validID_tmp, $this->idFile);

        $this->file_letter['name'] = $studID."_".$this->lname."_".$this->fname."_letter.".$vLtr;
        $storage = "resource/uploads/letters/";
        $this->ltrfile = $storage . $this->file_letter['name'];
        move_uploaded_file($this->file_letter_tmp, $this->ltrfile);

        //TESTER:
        // echo "File Extension: ".$vID."<br>";
        // echo "Filename: ".$this->valid_ID['name']."<br>";
        // echo "File Upload Folder: ".$storage2."<br>";
        // echo "Complete URL: ".$this->idFile;
        }

        if($error > 0){
            echo "<div class='text-center pb-5'>
                <button onclick='history.back()' class='btn btn-sm btn-outline-light mt-2 button-back'>Go Back</button>
            </div>";
        }    
    }

    public function insertApplication(){

        $transnumber = uniqid('Transfer');
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


        if ($schoolType === "Science"){
            $sql1 = "INSERT INTO `ecle_forms_ug`(`lname`, `fname`, `mname`, `semester`, `sy`, `school`, `schoolABBR`, `studentID`, `email`, `contact`, `bday`, `course`, `courseABBR`, `year`, `transferredSchool`, `reason`, `studentType`, `schoolType`, `referenceID`, `file_validID`, `file_letter`) VALUES ('$this->lname', '$this->fname', '$this->mname', '$semester', '$schoolYear', '$school', '$schoolABBR', '$this->studID', '$this->email', '$this->contact', '$this->bday', '$this->course', '$courseABBR', '$this->year', '$this->university', '$this->reason', '$studentType', '$schoolType', '$transnumber', '$filenameVID', '$filenameLTR')";
            $data1 = $con->prepare($sql1);
            if($data1->execute()){
                sendReferenceMail($this->lname, $this->fname, $this->mname, $transnumber, $this->email);
                echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                <b>Congratulations!</b> Your clearance request has been successfully submitted! Your Reference Number is: <b>'.$transnumber.'</b>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Your request could not be submitted due to wrong information or repeated input!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            }
        } else {
            $sql1 = "INSERT INTO `ecle_forms_ug`(`lname`, `fname`, `mname`, `semester`, `sy`, `school`, `schoolABBR`, `studentID`, `email`, `contact`, `bday`, `course`, `courseABBR`, `year`, `transferredSchool`, `reason`, `studentType`, `schoolType`, `referenceID`, `file_validID`, `file_letter`) VALUES ('$this->lname', '$this->fname', '$this->mname', '$semester', '$schoolYear', '$school', '$schoolABBR', '$this->studID', '$this->email', '$this->contact', '$this->bday', '$this->course', '$courseABBR', '$this->year', '$this->university', '$this->reason', '$studentType', '$schoolType', '$transnumber', '$filenameVID', '$filenameLTR')";
            $data1 = $con->prepare($sql1);
            if($data1->execute()){
                sendReferenceMail($this->lname, $this->fname, $this->mname, $transnumber, $this->email);
                echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                <b>Congratulations!</b> Your clearance request has been successfully submitted! Your Reference Number is: <b>'.$transnumber.'</b>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Your request could not be submitted due to wrong information or repeated input!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
            }
        }
    }

}
?>