<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/ecle/resource/php/class/core/init.php';
require_once 'config.php';

class view extends config{

        public function collegeSP2(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `collegeschool` WHERE `state` = 'active'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->college_school.'." value="'.$row->college_school.'">'.$row->college_school.'</option>';
                }
        }

        public function courseSP2(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `courseschool` WHERE `status` = 'Active'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->course.'." value="'.$row->course.'">'.$row->course.'</option>';
                  // echo 'success';
                }
        }

        public function semesterChoose(){
          echo '<option>Choose Sem</option>';
          echo '<option data-tokens="1" value="1">First</option>';
          echo '<option data-tokens="2" value="2">Second</option>';
          echo '<option data-tokens="3" value="3">Summer</option>';
        }

        public function university(){
          $config = new config;
          $con = $config->con();
          $sql = "SELECT * FROM `university`";
          $data = $con-> prepare($sql);
          $data ->execute();
          $rows =$data-> fetchAll(PDO::FETCH_OBJ);
              foreach ($rows as $row) {
                echo '<option data-tokens=".'.$row->university.'." value="'.$row->university.'">'.$row->university.'</option>';
                // echo 'success';
              }
      }

        public function reason(){
          echo '<option data-tokens="Continuation of Studies" value="Continuation of Studies">Continuation of Studies</option>';
          echo '<option data-tokens="Financial Problem" value="Financial Problem">Financial Problem</option>';
          echo '<option data-tokens="Change of Major" value="Change of Major">Change of Major</option>';
          echo '<option data-tokens="Family Issues" value="Family Issues">Family Issues</option>';
          echo '<option data-tokens="Change of Residence" value="Change of Residence">Change of Residence</option>';
          echo '<option data-tokens="University Quality Concerns" value="University Quality Concerns">University Quality Concerns</option>';
          echo '<option data-tokens="International Transfer" value="International Transfer">International Transfer</option>';
          echo '<option data-tokens="Others" value="Others">Others</option>';

        }

        public function getdpSRA(){
            $user = new user();
            return $user->data()->dp;
        }

        public function getMmSRA(){
            $user = new user();
             return $user->data()->mm;
        }


        public function viewConfigSem(){
          $config = new config;
          $con = $config->con();

          $sql = "SELECT * FROM `config`";
          $data = $con-> prepare($sql);
          $data ->execute();
          $result = $data->fetchAll(PDO::FETCH_ASSOC);

          $current_sem = $result[0]['semester'];
          $current_sy = $result[0]['schoolYear'];

          echo "Current setting: <span class='badge bg-primary'>$current_sy-$current_sem</span>";
          
        }

        public function viewConfigMailer(){
          $config = new config;
          $con = $config->con();
          
          $sql = "SELECT * FROM `tbl_mailer_info`";
          $data = $con-> prepare($sql);
          $data ->execute();
          $result = $data->fetchAll(PDO::FETCH_ASSOC);

          $mailer_username = $result[0]['username'];
          $mailer_password = $result[0]['password'];
          $mailer_platform = $result[0]['platform'];
          $mailer_port = $result[0]['port'];

          return array($mailer_username, $mailer_password, $mailer_platform, $mailer_port);
        }

}
