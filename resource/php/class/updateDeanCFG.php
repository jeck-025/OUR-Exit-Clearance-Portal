<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';

class updateDeanCFG extends config{

    public function setDeans(){
        $dean = $_POST['dean'];
        $id = $_POST['id'];
        $config = new config();
        $con = $config->con();

        foreach($dean as $key => $n){
        $sql = "UPDATE `collegeschool` SET `dean` = '$n' WHERE `id` = '$id[$key]'";
        $data = $con->prepare($sql);
        $data ->execute();
        }
    }
}
?>