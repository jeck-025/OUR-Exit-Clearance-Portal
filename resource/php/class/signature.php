<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/vendor/sendmailTransfer.php';

class signature extends config{
    public $signature, $account;

    function __construct($signature=null, $account=null){

        $this->signature =$signature;
        $this->account =$account;
    }

    public function insertSignature(){

        $img_name = $_FILES['signature']['name'];
        $img_size = $_FILES['signature']['size'];
        $tmp_name = $_FILES['signature']['tmp_name'];
        $error = $_FILES['signature']['error'];
        
        if ($error === 0) {
            if ($img_size > 20000) {
                $em = "Sorry, your file is too large.";
                print($em);
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png"); 

                if (in_array($img_ex_lc, $allowed_exs)) {
                    
                    $img_upload_path = 'signatures/'.$img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                    $config = new config;
                    $con = $config->con();
                    $sql = "UPDATE `tbl_accounts` SET `signature` = '$img_name' WHERE `username` = '$this->account'";
                    $data = $con->prepare($sql);
                    $data->execute();
                }else {
                    $em = "You can't upload files of this type";
                    print($em);
                }
            }
        }

        
    }
}
?>