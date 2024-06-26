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

        public function collegeSP3($college0){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `collegeschool` WHERE `college_school` = '$college0' AND `state` = 'active'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->college_school.'." value="'.$row->college_school.'">'.$row->college_school.'</option>';
                }
        }

        public function collegeSP4($college1){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `collegeschool` WHERE `college_school` = '$college1' AND `state` = 'active'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->college_school.'." value="'.$row->college_school.'">'.$row->college_school.'</option>';
                }
        }

        public function collegeSP5($college2){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `collegeschool` WHERE `college_school` = '$college2' AND `state` = 'active'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->college_school.'." value="'.$row->college_school.'">'.$row->college_school.'</option>';
                }
        }

        public function collegeSP6($college){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `courseschool` WHERE `department` = '$college'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
            return $rows[0]['departmentABBR'];
        }

        public function groupSP2(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `tbl_group`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->id.'." value="'.$row->id.'">'.$row->name.'</option>';
                }
        }

        public function groupSP3($groups){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `tbl_group` WHERE `id` = '$groups'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->id.'." value="'.$row->id.'">'.$row->name.'</option>';
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
                }
        }

        public function courseSP3(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `courseschool` WHERE `status` = 'Active'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->id.'." value="'.$row->id.'">'.$row->course.'</option>';
                }
        }

        public function courseSP4($id){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `courseschool` WHERE `id` = '$id'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->id.'." value="'.$row->type.'">'.$row->type.'</option>';
                }
        }

        public function courseSP5(){
            echo "<option data-tokens='Non-Science' value='Non-Science'>Non-Science</option>";
            echo "<option data-tokens='Science' value='Science'>Science</option>";
        }

        
        public function courseSP6($course){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `courseschool` WHERE `course` = '$course'";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows = $data-> fetchAll(PDO::FETCH_ASSOC);
            return $rows[0]['courseABBR'];
        }

        public function semesterChoose(){
          echo '<option>Choose Sem</option>';
          echo '<option data-tokens="1" value="1">First</option>';
          echo '<option data-tokens="2" value="2">Second</option>';
          echo '<option data-tokens="3" value="3">Summer</option>';
        }
        public function semesterChoose2(){
          // echo '<option>Choose Sem</option>';
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
                $temp_univ = utf8_decode($row->university);
                $display = str_replace('?', 'ñ', $temp_univ);
                echo '<option data-tokens=".'.$row->university.'." value="'.$row->university.'">'.$display.'</option>';
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
          //echo '<option data-tokens="International Transfer" value="International Transfer">International Transfer</option>';
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

        public function loadDeans(){
          $config = new config;
          $con = $config->con();

          $sql = "SELECT * FROM `collegeschool` where `state` = 'active'";
          $data = $con-> prepare($sql);
          $data ->execute();
          $result = $data->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result as $row)
          {
            $id = $row['id'];
            $school = $row['college_school'];
            $dean = $row['dean'];

            echo "<tr>";
            echo "<td> $school </td>";
            echo "<td> <input type='text' class='form-control' value='$dean' name='dean[]' autocomplete='off'> </td>";
            echo "<input type='hidden' name='id[]' value='$id'>";
            echo "</tr>";
          }
        }

        public function loadDeans2(){
          $config = new config;
          $con = $config->con();

          $sql0 = "SELECT DISTINCT `college_school` from `collegeschool` ORDER BY `college_school` ASC";
          $data0 = $con-> prepare($sql0);
          $data0 ->execute();
          $result0 = $data0->fetchAll(PDO::FETCH_ASSOC);

          foreach ($result0 as $row0){
            $school = $row0['college_school'];
            echo "<tr><td>$school</td>";
            echo "<td>";
            echo "<div class='form-group mb-0'>
                  <select name='id[]' class='form-select form-select-sm'>";

                  $sql1 = "SELECT * from `collegeschool` where `college_school` = '$school' ORDER BY `state` ASC";
                  $data1 = $con-> prepare($sql1);
                  $data1 ->execute();
                  $result1 = $data1->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($result1 as $row1){

                    $id = $row1['id'];
                    $dean = $row1['dean'];

                    echo "<option data-tokens='$id' value='$id'> $dean </option>";
                  }
                  echo "</select></div></td>";
          }
        }

        public function loadDeans3(){
          $config = new config;
          $con = $config->con();

          echo "<div class='form-group mb-0'>
                  <select name='d_dean' class='form-control form-select form-select-sm'>";

                  $sql1 = "SELECT * from `collegeschool`";
                  $data1 = $con-> prepare($sql1);
                  $data1 ->execute();
                  $result1 = $data1->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($result1 as $row1){

                    $id = $row1['id'];
                    $dean = $row1['dean'];

                    echo "<option data-tokens='$id' value='$id'> $dean </option>";
                  }
                  echo "</select></div>";
        }

        public function loadUserAcct(){
          $config = new config;
          $con = $config->con();

          echo "<div class='form-group mb-0'>
                  <select name='d_user' class='form-control form-select form-select-sm'>";

                  $sql1 = "SELECT * from `tbl_accounts` WHERE `groups` != '1'";
                  $data1 = $con-> prepare($sql1);
                  $data1 ->execute();
                  $result1 = $data1->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($result1 as $row1){

                    $id = $row1['id'];
                    $dean = $row1['name'];
                    echo "<option data-tokens='$id' value='$id'> $dean </option>";
                  }
                  echo "</select>";
                  echo "</div>";
        }
        
        public function loadReg2(){
          $config = new config;
          $con = $config->con();

          echo "<div class='form-group mb-0'>
                  <select name='regselect' class='form-control form-select form-select-sm mb-3'>";

                  $sql0 = "SELECT * from `tbl_accounts` WHERE `pos` = 'reg'";
                  $data0 = $con-> prepare($sql0);
                  $data0 ->execute();
                  $result0 = $data0->fetchAll(PDO::FETCH_ASSOC);
                    $id0 = $result0[0]['id'];
                    $name0 = $result0[0]['name'];
                    echo "<option data-tokens='$id0' value='$id0'> $name0 - <i>Active</i> </option>";

                  $sql1 = "SELECT * from `tbl_accounts` WHERE `groups` = '2'";
                  $data1 = $con-> prepare($sql1);
                  $data1 ->execute();
                  $result1 = $data1->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($result1 as $row1){
                    $id = $row1['id'];
                    $name = $row1['name'];
                    echo "<option data-tokens='$id' value='$id'> $name </option>";
                  }
                  echo "</select></div>";
        }

        public function studIDGrad(){
          $config = new config;
          $con = $config->con();
          $sql = "SELECT * FROM `ecle_forms`";
          $data = $con->prepare($sql);
          $data->execute();
          $rows = $data->fetchAll(PDO::FETCH_OBJ);
          foreach ($rows as $row) {
            $lname = str_replace('?', 'Ñ', utf8_decode($row->lname));
            $fname = str_replace('?', 'Ñ', utf8_decode($row->fname));
            $mname = str_replace('?', 'Ñ', utf8_decode($row->mname));
            echo '<option data-tokens=".' . $row->studentID . '." value="' . $row->studentID . '">' . $row->studentID." - ". $lname . ", ". $fname . " " . $mname . '</option>';
          }
        }

        public function studIDUndergrad(){
          $config = new config;
          $con = $config->con();
          $sql = "SELECT * FROM `ecle_forms_ug`";
          $data = $con->prepare($sql);
          $data->execute();
          $rows = $data->fetchAll(PDO::FETCH_OBJ);
          foreach ($rows as $row) {
            $lname = str_replace('?', 'Ñ', utf8_decode($row->lname));
            $fname = str_replace('?', 'Ñ', utf8_decode($row->fname));
            $mname = str_replace('?', 'Ñ', utf8_decode($row->mname));
            echo '<option data-tokens=".' . $row->studentID . '." value="' . $row->studentID . '">' . $row->studentID." - ". $lname . ", ". $fname . " " . $mname . '</option>';
          }
        }
}
