<?php
$view = new view();
$update = new updateDeanCFG();

echo"<div class='modal fade' id='deanCFG' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Configure Dean's Info</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>

                <div class='modal-body'>
                    <div class='input-group col-md-12 modal-dean-cfg'>
                        <form method='post'>
                            
                                <table id='scholartable' class='table table-hover table-striped table-borderless table-sm table-dean'>
                                <tr>
                                <th width='50%'><h5>College / School</h5></th>
                                <th width='50%'><h5>Dean</h5></th>
                                </tr>"; 
                                $view->loadDeans();
                                echo "</table>";
                            
                            
                        

                echo"</div>";
                echo "<div class='modal-footer mt-3'>";
                echo "<button type='button' class='btn btn-dark' data-bs-dismiss='modal' aria-label='Close'><i class='fa-solid fa-xmark'></i> Close</button>";
                echo "<button type='submit' name='updatedeanCFG' id='updatedeanCFG' class='btn btn-dark'><i class='fa-solid fa-floppy-disk'></i> Save Changes</button>";
                echo "</form>";
                echo "</div>
            </div>
        </div>
    </div>
</div>";



?>