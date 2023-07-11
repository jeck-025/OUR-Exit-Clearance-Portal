<?php

echo"<div class='modal fade' id='regsRemove$id2' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-md'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                        Remove Name from the list?
                    <div class='modal-footer mt-3'>";

                    if($regC2 == "ON HOLD" && $studType == "Graduate"){
                        $landing = "rhg";
                    }elseif($regC2 == "ON HOLD" && $studType == "Transfer"){
                        $landing = "rht";
                    }elseif($regC2 == "PENDING" && $studType == "Graduate"){
                        $landing = "rrg";
                    }elseif($regC2 == "PENDING" && $studType == "Transfer"){
                        $landing = "rrt";
                    }else{}

                    echo "<input type='hidden' name='landing' value='$landing'>";
                    echo "<input type='hidden' name='type' value='$studType2'>";
                    echo "<input type='hidden' name='hold' value='$id2'>";
                    echo "<button type='button' class='btn btn-sm btn-warning' data-bs-dismiss='modal'> Cancel </button>";
                    echo "<a href='registrarRemove.php?edit=$id2&landing=$landing&user=$evaluator_name&type=$studType2' class='btn btn-sm my-1 d-block btn-danger' data-toggle='tooltip' data-placement='top' title='Remove'><i class='fa-solid fa-trash'></i> Remove </a>";
                    echo "</div>
                </div>
            </div>
        </div>
    </div>";

?>