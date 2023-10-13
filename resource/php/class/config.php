<?php

class config{
    //hostinger
     private $user = 'ceumnlre_root';
     private $password = 'Eg5c272klko5';

    //local
    // private $user = 'root';
    // private $password = '';
    
    public $pdo = null;

    public function con(){
        try {
            // hostinger
             $this->pdo = new PDO('mysql:local=109.106.254.187;dbname=ceumnlre_ecle', $this->user, $this->password);

            // localhost
            // $this->pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=ceumnlre_ecle', $this->user, $this->password);
            } catch (PDOException $e) {
                die($e->getMessage());
        }
        return $this->pdo;

    }
}

 ?>
