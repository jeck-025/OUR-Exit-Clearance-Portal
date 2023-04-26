<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once 'config.php';

class chartfilter extends config{

    public $sy;
    public $sem;
    public $sch;

    public function __construct($sy = null, $sem = null, $sch = null)
    {
        $this->sy = $sy;
        $this->sem = $sem;

        if(empty($sch)){
            $this->sch = "";
        }
        else{
            $this->sch = "AND `schoolABBR` = '$sch'";
        }
    }

    public function viewTransferredSchoolNames() {
        $con = $this->con();
        $sql = "SELECT transferredSchool, COUNT(transferredSchool) AS quantity FROM ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' $this->sch AND transferredSchool != 'NULL' GROUP BY transferredSchool";
        $data= $con->prepare($sql);
        $data->execute();
        $names[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $names[] = $row['transferredSchool'];
        }
        unset($names[0]);
        return $names;
    }

    public function viewTransferredSchoolTotal() {
        $con = $this->con();
        $sql = "SELECT transferredSchool, COUNT(transferredSchool) AS quantity FROM ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' $this->sch AND transferredSchool != '' GROUP BY transferredSchool";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['quantity'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    public function viewReasonNames(){
        $con = $this->con();
        $sql = "SELECT reason, COUNT(reason) AS quantity FROM ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' $this->sch AND reason != 'NULL' GROUP BY reason";
        $data= $con->prepare($sql);
        $data->execute();
        $reasons[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $reasons[] = $row['reason'];
        }
        unset($reasons[0]);
        return $reasons;
    }

    public function viewReasonTotal(){
        $con = $this->con();
        $sql = "SELECT reason, COUNT(reason) AS quantity FROM ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' $this->sch AND reason != 'NULL' GROUP BY reason";
        $data= $con->prepare($sql);
        $data->execute();
        $total[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $total[] = $row['quantity'];
        }
        unset($total[0]);
        return $total;
    }

    public function countSAM(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'SAM'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }
        
    public function countDENTISTRY(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'DENT'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }

    public function countELAMS(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'SELAMS'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }

    public function countGS(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'GRADSCH'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }

    public function countMEDTECH(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'MEDTECH'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }

    public function countMEDICINE(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'MEDICINE'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }

    public function countNHM(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'NHM'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }

    public function countNURSING(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'NURSING'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }

    public function countOPTO(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'OPTO'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }

    public function countPHARM(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'PHARM'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }

    public function countSCITECH(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND reason != 'NULL' AND schoolABBR = 'SCITECH'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }
        
    public function countSAMGD(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND studentType = 'Graduate' AND schoolABBR = 'SAM'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }

    public function countDENTISTRYGD(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND studentType = 'Graduate' AND schoolABBR = 'DENT'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }
    
    public function countELAMSGD(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND studentType = 'Graduate' AND schoolABBR = 'SELAMS'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }
    
    public function countGSGD(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND studentType = 'Graduate' AND schoolABBR = 'GRADSCH'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }
    
    public function countMEDTECHGD(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND studentType = 'Graduate' AND schoolABBR = 'MEDTECH'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }
    
    public function countMEDICINEGD(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND studentType = 'Graduate' AND schoolABBR = 'MEDICINE'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }
    
    public function countNHMGD(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND studentType = 'Graduate' AND schoolABBR = 'NHM'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }
    
    public function countNURSINGGD(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND studentType = 'Graduate' AND schoolABBR = 'NURSING'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }
    
    public function countOPTOGD(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND studentType = 'Graduate' AND schoolABBR = 'OPTO'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }
    
    public function countPHARMGD(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND studentType = 'Graduate' AND schoolABBR = 'PHARM'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }
    
    public function countSCITECHGD(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE semester = '$this->sem' AND sy = '$this->sy' AND studentType = 'Graduate' AND schoolABBR = 'SCITECH'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC); 
            return $rows[0]['count'];
        }

     public function viewCountClearedGDSAM() {
            $con = $this->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'SAM'";
            $data= $con->prepare($sql);
            $data->execute();
            $numbers[] = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $numbers[] = $row['count'];
            }
            unset($numbers[0]);
            return $numbers;
        }

     public function viewCountClearedGDDENT() {
            $con = $this->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'DENT'";
            $data= $con->prepare($sql);
            $data->execute();
            $numbers[] = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $numbers[] = $row['count'];
            }
            unset($numbers[0]);
            return $numbers;
        }

     public function viewCountClearedGDSELAMS() {
            $con = $this->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'SELAMS'";
            $data= $con->prepare($sql);
            $data->execute();
            $numbers[] = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $numbers[] = $row['count'];
            }
            unset($numbers[0]);
            return $numbers;
        }

     public function viewCountClearedGDGRADSCH() {
            $con = $this->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'GRADSCH'";
            $data= $con->prepare($sql);
            $data->execute();
            $numbers[] = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $numbers[] = $row['count'];
            }
            unset($numbers[0]);
            return $numbers;
        }

     public function viewCountClearedGDMEDICINE() {
            $con = $this->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'MEDICINE'";
            $data= $con->prepare($sql);
            $data->execute();
            $numbers[] = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $numbers[] = $row['count'];
            }
            unset($numbers[0]);
            return $numbers;
        }

     public function viewCountClearedGDMEDTECH() {
            $con = $this->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'MEDTECH'";
            $data= $con->prepare($sql);
            $data->execute();
            $numbers[] = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $numbers[] = $row['count'];
            }
            unset($numbers[0]);
            return $numbers;
        }

     public function viewCountClearedGDNURSING() {
            $con = $this->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'NURSING'";
            $data= $con->prepare($sql);
            $data->execute();
            $numbers[] = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $numbers[] = $row['count'];
            }
            unset($numbers[0]);
            return $numbers;
        }

     public function viewCountClearedGDNHM() {
            $con = $this->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'NHM'";
            $data= $con->prepare($sql);
            $data->execute();
            $numbers[] = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $numbers[] = $row['count'];
            }
            unset($numbers[0]);
            return $numbers;
        }

     public function viewCountClearedGDOPTO() {
            $con = $this->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'OPTO'";
            $data= $con->prepare($sql);
            $data->execute();
            $numbers[] = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $numbers[] = $row['count'];
            }
            unset($numbers[0]);
            return $numbers;
        }

     public function viewCountClearedGDPHARMACY() {
            $con = $this->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'PHARMACY'";
            $data= $con->prepare($sql);
            $data->execute();
            $numbers[] = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $numbers[] = $row['count'];
            }
            unset($numbers[0]);
            return $numbers;
        }

     public function viewCountClearedGDSCITECH() {
            $con = $this->con();
            $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'SCITECH'";
            $data= $con->prepare($sql);
            $data->execute();
            $numbers[] = array();
            $result = $data->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $numbers[] = $row['count'];
            }
            unset($numbers[0]);
            return $numbers;
        }

    public function viewCountUnclearedGDSAM() {
        $con = $this->con();
        $sql = "SELECT count(*) AS `count` from ecle_forms WHERE (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'SAM'";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['count'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    public function viewCountUnclearedGDDENT() {
        $con = $this->con();
        $sql = "SELECT count(*) AS `count` from ecle_forms WHERE (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'DENT'";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['count'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    public function viewCountUnclearedGDSELAMS() {
        $con = $this->con();
        $sql = "SELECT count(*) AS `count` from ecle_forms WHERE (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'SELAMS'";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['count'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    public function viewCountUnclearedGDGRADSCH() {
        $con = $this->con();
        $sql = "SELECT count(*) AS `count` from ecle_forms WHERE (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'GRADSCH'";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['count'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    public function viewCountUnclearedGDMEDICINE() {
        $con = $this->con();
        $sql = "SELECT count(*) AS `count` from ecle_forms WHERE (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'MEDICINE'";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['count'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    public function viewCountUnclearedGDMEDTECH() {
        $con = $this->con();
        $sql = "SELECT count(*) AS `count` from ecle_forms WHERE (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'MEDTECH'";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['count'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    public function viewCountUnclearedGDNHM() {
        $con = $this->con();
        $sql = "SELECT count(*) AS `count` from ecle_forms WHERE (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'NHM'";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['count'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    public function viewCountUnclearedGDNURSING() {
        $con = $this->con();
        $sql = "SELECT count(*) AS `count` from ecle_forms WHERE (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'NURSING'";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['count'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    public function viewCountUnclearedGDOPTO() {
        $con = $this->con();
        $sql = "SELECT count(*) AS `count` from ecle_forms WHERE (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'OPTO'";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['count'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    public function viewCountUnclearedGDPHARMACY() {
        $con = $this->con();
        $sql = "SELECT count(*) AS `count` from ecle_forms WHERE (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'PHARMACY'";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['count'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    public function viewCountUnclearedGDSCITECH() {
        $con = $this->con();
        $sql = "SELECT count(*) AS `count` from ecle_forms WHERE (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'SCITECH'";
        $data= $con->prepare($sql);
        $data->execute();
        $numbers[] = array();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $numbers[] = $row['count'];
        }
        unset($numbers[0]);
        return $numbers;
    }

    
    
    
}
?>

<!-- $sql = "SELECT count(*) AS `count` from ecle_forms WHERE `registrarclearance` = 'CLEARED' AND `libraryclearance` = 'CLEARED' AND `departmentclearance` = 'CLEARED' AND `accountingclearance` = 'CLEARED' AND `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'DENT'"; -->


        <!-- $sql = "SELECT count(*) AS `count` from ecle_forms WHERE 
        (`registrarclearance` = 'PENDING' OR `registrarclearance` = 'ON HOLD') AND 
        (`departmentclearance` = 'PENDING' OR `departmentclearance` = 'ON HOLD') AND
        (`libraryclearance` = 'PENDING' OR `libraryclearance` = 'ON HOLD') AND
        (`accountingclearance` = 'PENDING' OR `accountingclearance` = 'ON HOLD') AND
        `studentType` = 'Graduate' AND semester = '$this->sem' AND sy = '$this->sy' AND `schoolABBR` = 'SCITECH'"; -->

<!-- public function viewSchNamesGD(){
    $con = $this->con();
    $sql = "SELECT DISTINCT `schoolABBR` from ecle_forms WHERE semester = '1' AND sy = '2022-2023' AND studentType = 'Graduate' ORDER BY `schoolABBR` ASC;";
    $data= $con->prepare($sql);
    $data->execute();
    $schNames[] = array();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        $schNames[] = $row['schoolABBR'];
    }
    unset($schNames[0]);
    return $schNames;
} -->


<!-- 

QUERY TO DISPLAY NUMBER OF GRADUATES PER SCHOOL

SELECT `schoolABBR`, count(*) AS `count` from ecle_forms WHERE semester = '1' AND sy = '2022-2023' AND studentType = 'Graduate' GROUP BY `schoolABBR`;

QUERY TO DISPLAY ONLY THE NUMBER

SELECT count(*) AS `count` from ecle_forms WHERE semester = '1' AND sy = '2022-2023' AND studentType = 'Graduate' GROUP BY `schoolABBR`;

QUERY TO DISPLAY ONLY THE SCHOOL
SELECT DISTINCT `schoolABBR` from ecle_forms WHERE semester = '1' AND sy = '2022-2023' AND studentType = 'Graduate' ORDER BY `schoolABBR` ASC;

-->