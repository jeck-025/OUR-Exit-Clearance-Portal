<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';

class update extends config{

    public $semester, $sy;
    
    function __construct($semester=null,$sy=null){

    $this->semester =$semester;
    $this->sy =$sy;
    }

    public function updateSemester() {
        $config = new config();
        if(!empty($this->semester) && is_numeric($this->semester)) {
            $con = $config->con();
            $sql = "UPDATE `config` SET `semester` = '$this->semester'";
            $data = $con->prepare($sql);
            $data ->execute();
            // echo $this->semester;
        }
    }

    public function updateSchoolyear() {
        $config = new config();
        if(!empty($this->sy)) {
            $con = $config->con();
            $sql = "UPDATE `config` SET `schoolYear` = '$this->sy'";
            $data = $con->prepare($sql);
            $data ->execute();
            // echo $this->sy;
        }
    }

}
?>