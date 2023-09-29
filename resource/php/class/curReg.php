<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once 'config.php';

class curReg extends config{
    public function currentRegistrar(){
        $con = $this->con();
        $sql = "SELECT * FROM `tbl_accounts` WHERE `pos` = 'reg'";
        $data= $con->prepare($sql);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        $current_registrar = $result[0]['id'];
        return $current_registrar;
    }

}

?>