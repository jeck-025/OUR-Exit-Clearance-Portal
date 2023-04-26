<?php
        echo "<div class='col-md p-3 form'>";
        echo "<h3 class='col-md pb-3' style='text-align:center; font-weight:bold;'>"; 
        echo "Summary of Transferring Students' School of Choice and Their Reasons</h3>";
        echo "<div class='chartform p-3 shadow mb-5 bg-white rounded'>";
            if(!empty($_GET['semester'])){
                echo "Currently Displaying data for: ";
                if(!empty($_GET['sch'])){
                    echo "<b class='sy'>SY $_GET[sy]-$_GET[semester] from $_GET[sch]</b><br>";
                }
                else{
                    echo "<b class='sy'>SY $_GET[sy]-$_GET[semester]</b><br>";
                }
                echo "Change School Year, Semester and School to Display";
            }
            else{
                echo "Please choose School Year, Semester and School to Display";
            }
        echo "<form action='' method='get' name='filterchart'>";
        echo "<div class='p-3'>";
        echo "<select id='sy' name='sy' class='selectpicker form-control form-control-sm mr-2' data-live-search='true' title='Select School Year' required>";
            if(!empty($_GET['sy'])){
                echo "<option hidden selected value='$_GET[sy]'>$_GET[sy]</option>";
            }
            else{
                echo "<option disabled selected value> -- Select School Year -- </option>";
            }
                schoolYear();
        echo "</select>";
        echo "<select id='semester' name='semester' class='selectpicker form-control form-control-sm mr-2' title='Select Semester' required>";
            if(!empty($_GET['semester'])){
                if($_GET['semester'] == '1'){
                    echo "<option hidden selected value='1'>First</option>";
                }
                elseif($_GET['semester'] == '2'){
                    echo "<option hidden selected value='2'>Second</option>";
                }else{
                    echo "<option hidden selected value='3'>Summer</option>";
                }
            }
            else{
                echo "<option disabled selected value> -- Select Semester -- </option>";
            }    
        echo "<option value='1'>First</option>
                <option value='2'>Second</option>
                <option value='3'>Summer</option>
            </select>";
        echo "<select id='sch' name='sch' class='selectpicker form-control form-control-sm mr-2' data-live-search='true' title='Select School' >";
            if(!empty($_GET['sch'])){
                echo "<option hidden selected value='$_GET[sch]'>$_GET[sch]</option>";
            }
            else{
                echo "<option disabled selected value> -- Select School (Optional) -- </option>";
            }
                schoolSelect();
        echo "</select>";
        echo "<input type='submit' class='btn btn-info btn-sm' value='View'>";
        echo "<a class='btn btn-danger btn-sm' href='registrar.php' name='reset'> Reset </a>";
        echo "</div>";
        echo "</form>";
        echo "</div></div>";
?>