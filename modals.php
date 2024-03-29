 <?php

echo"<div class='modal fade' id='deanModal$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-md'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>

                <div class='modal-body'>
                    <div class='input-group col-md-12'>
                        Sign Clearance?
                    </div>
                    <div class='modal-footer mt-3'>";

                    if($deptC == "ON HOLD" && $studType == "Graduate"){
                        $landing = "dhg";
                    }elseif($deptC == "ON HOLD" && $studType == "Transfer"){
                        $landing = "dht";
                    }elseif($deptC == "PENDING" && $studType == "Graduate"){
                        $landing = "drg";
                    }elseif($deptC == "PENDING" && $studType == "Transfer"){
                        $landing = "drt";
                    }else{}

                    echo "<button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Cancel</button>
                        <a href='deanApprove.php?edit=$id&landing=$landing&school=$school&user=$dean_asst_name&type=$studType' class='btn btn-sm my-1 d-block btn-success' data-toggle='tooltip' data-placement='top' title='Approve'><i class='fa-solid fa-check'></i> Yes</a>
                     </div>
                </div>
            </div>
        </div>
    </div>";

echo"<div class='modal fade' id='acctModal$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-md'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>

                <div class='modal-body'>
                    <div class='input-group col-md-12'>
                        Sign Clearance?
                    </div>
                    <div class='modal-footer mt-3'>";

                    if($acctC == "ON HOLD" && $studType == "Graduate"){
                        $landing = "ahg";
                    }elseif($acctC == "ON HOLD" && $studType == "Transfer"){
                        $landing = "aht";
                    }elseif($acctC == "PENDING" && $studType == "Graduate"){
                        $landing = "arg";
                    }elseif($acctC == "PENDING" && $studType == "Transfer"){
                        $landing = "art";
                    }else{}

                    echo "<button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Cancel</button>
                        <a href='accountingApprove.php?edit=$id&landing=$landing&user=$acct_asst_name&type=$studType' class='btn btn-sm my-1 d-block btn-success' data-toggle='tooltip' data-placement='top' title='Approve'><i class='fa-solid fa-check'></i> Yes</a>
                     </div>
                </div>
            </div>
        </div>
    </div>";

echo"<div class='modal fade' id='librModal$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-md'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>

                <div class='modal-body'>
                    <div class='input-group col-md-12'>
                        Sign Clearance?
                    </div>
                    <div class='modal-footer mt-3'>";

                    if($libraryC == "ON HOLD" && $studType == "Graduate"){
                        $landing = "lhg";
                    }elseif($libraryC == "ON HOLD" && $studType == "Transfer"){
                        $landing = "lht";
                    }elseif($libraryC == "PENDING" && $studType == "Graduate"){
                        $landing = "lrg";
                    }elseif($libraryC == "PENDING" && $studType == "Transfer"){
                        $landing = "lrt";
                    }else{}

                    echo "<button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Cancel</button>
                        <a href='libraryApprove.php?edit=$id&landing=$landing&user=$libr_asst_name&type=$studType' class='btn btn-sm my-1 d-block btn-success' data-toggle='tooltip' data-placement='top' title='Approve'><i class='fa-solid fa-check'></i> Yes</a>
                     </div>
                </div>
            </div>
        </div>
    </div>";

echo"<div class='modal fade' id='regsModal$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-md'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>

                <div class='modal-body'>
                    <div class='input-group col-md-12'>
                        Sign Clearance?
                    </div>
                    <div class='modal-footer mt-3'>";

                    if($regC == "ON HOLD" && $studType == "Graduate"){
                        $landing = "rhg";
                    }elseif($regC == "ON HOLD" && $studType == "Transfer"){
                        $landing = "rht";
                    }elseif($regC == "PENDING" && $studType == "Graduate"){
                        $landing = "rrg";
                    }elseif($regC == "PENDING" && $studType == "Transfer"){
                        $landing = "rrt";
                    }else{}

                    echo "<button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Cancel</button>
                        <a href='registrarApprove.php?edit=$id&landing=$landing&user=$evaluator_name&type=$studType&regid=$rid' class='btn btn-sm my-1 d-block btn-success' data-toggle='tooltip' data-placement='top' title='Approve'><i class='fa-solid fa-check'></i> Yes</a>
                     </div>
                </div>
            </div>
        </div>
    </div>";

echo"<div class='modal fade' id='regsHold$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Remarks</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <form action='remarksRegistrar.php' method='post'>
                <div class='modal-body'>
                    <div class='input-group col-md-12'>
                            Please state below the reason why the clearance will be on-hold.
                    </div>
                    <div class='input-group col-md-12'>
                        <textarea class='form-control' id='remarks' rows='10' name='remarks' required>$regR</textarea>
                    </div>
                    <div class='modal-footer mt-3'>";

                    if($regC == "ON HOLD" && $studType == "Graduate"){
                        $landing = "rhg";
                    }elseif($regC == "ON HOLD" && $studType == "Transfer"){
                        $landing = "rht";
                    }elseif($regC == "PENDING" && $studType == "Graduate"){
                        $landing = "rrg";
                    }elseif($regC == "PENDING" && $studType == "Transfer"){
                        $landing = "rrt";
                    }else{}

                    echo "<input type='hidden' name='landing' value='$landing'>";
                    echo "<input type='hidden' name='type' value='$studType'>";
                    echo "<input type='hidden' name='hold' value='$id'>";
                    echo "<button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Cancel</button>";
                    if($regC == "ON HOLD"){
                        echo "<input type='submit' class='btn btn-sm btn-info' value='Clear Remarks' name='reset'>";
                    }else{                          
                        echo "<input type='submit' class='btn btn-sm btn-warning' value='Hold Clearance' name='submit'>";
                    }
                    echo "</div>
                    </form>
                </div>
            </div>
        </div>
    </div>";

echo"<div class='modal fade' id='librHold$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <form action='remarksLibrary.php' method='post'>
                <div class='modal-body'>
                    <div class='input-group col-md-12'>
                            Please state below the reason why the clearance will be on-hold.
                    </div>
                    <div class='input-group col-md-12'>
                        <textarea class='form-control' id='remarks' rows='10' name='remarks' required>$libraryR</textarea>
                    </div>
                    <div class='modal-footer mt-3'>";

                    if($libraryC == "ON HOLD" && $studType == "Graduate"){
                        $landing = "lhg";
                    }elseif($libraryC == "ON HOLD" && $studType == "Transfer"){
                        $landing = "lht";
                    }elseif($libraryC == "PENDING" && $studType == "Graduate"){
                        $landing = "lrg";
                    }elseif($libraryC == "PENDING" && $studType == "Transfer"){
                        $landing = "lrt";
                    }else{}

                    echo "<input type='hidden' name='landing' value='$landing'>";
                    echo "<input type='hidden' name='type' value='$studType'>";
                    echo "<input type='hidden' name='hold' value='$id'>";
                    echo "<button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Cancel</button>";
                    if($libraryC == "ON HOLD"){
                        echo "<input type='submit' class='btn btn-sm btn-info' value='Clear Remarks' name='reset'>";
                    }else{                          
                        echo "<input type='submit' class='btn btn-sm btn-warning' value='Hold Clearance' name='submit'>";
                    }
                    echo "</div>
                    </form>
                </div>
            </div>
        </div>
    </div>";

echo"<div class='modal fade' id='acctHold$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <form action='remarksAccounting.php' method='post'>
                <div class='modal-body'>
                    <div class='input-group col-md-12'>
                            Please state below the reason why the clearance will be on-hold.
                    </div>
                    <div class='input-group col-md-12'>
                        <textarea class='form-control' id='remarks' rows='10' name='remarks' required>$acctR</textarea>
                    </div>
                    <div class='modal-footer mt-3'>";

                    if($acctC == "ON HOLD" && $studType == "Graduate"){
                        $landing = "ahg";
                    }elseif($acctC == "ON HOLD" && $studType == "Transfer"){
                        $landing = "aht";
                    }elseif($acctC == "PENDING" && $studType == "Graduate"){
                        $landing = "arg";
                    }elseif($acctC == "PENDING" && $studType == "Transfer"){
                        $landing = "art";
                    }else{}

                    echo "<input type='hidden' name='landing' value='$landing'>";
                    echo "<input type='hidden' name='type' value='$studType'>";
                    echo "<input type='hidden' name='hold' value='$id'>";
                    echo "<button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Cancel</button>";
                    if($acctC == "ON HOLD"){
                        echo "<input type='submit' class='btn btn-sm btn-info' value='Clear Remarks' name='reset'>";
                    }else{                          
                        echo "<input type='submit' class='btn btn-sm btn-warning' value='Hold Clearance' name='submit'>";
                    }
                    echo "</div>
                    </form>
                </div>
            </div>
        </div>
    </div>";

echo"<div class='modal fade' id='deanHold$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <form action='remarksDean.php' method='post'>
                <div class='modal-body'>
                    <div class='input-group col-md-12'>
                            Please state below the reason why the clearance will be on-hold.
                    </div>
                    <div class='input-group col-md-12'>
                        <textarea class='form-control' id='remarks' rows='10' name='remarks' required>$deptR</textarea>
                    </div>
                    <div class='modal-footer mt-3'>";

                    if($deptC == "ON HOLD" && $studType == "Graduate"){
                        $landing = "dhg";
                    }elseif($deptC == "ON HOLD" && $studType == "Transfer"){
                        $landing = "dht";
                    }elseif($deptC == "PENDING" && $studType == "Graduate"){
                        $landing = "drg";
                    }elseif($deptC == "PENDING" && $studType == "Transfer"){
                        $landing = "drt";
                    }else{}

                    echo "<input type='hidden' name='landing' value='$landing'>";
                    echo "<input type='hidden' name='type' value='$studType'>";
                    echo "<input type='hidden' name='hold' value='$id'>";
                    echo "<button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Cancel</button>";
                    if($deptC == "ON HOLD"){
                        echo "<input type='submit' class='btn btn-sm btn-info' value='Clear Remarks' name='reset'>";
                    }else{                          
                        echo "<input type='submit' class='btn btn-sm btn-warning' value='Hold Clearance' name='submit'>";
                    }
                    echo "</div>
                    </form>
                </div>
            </div>
        </div>
    </div>";

echo"<div class='modal fade' id='regsRemove$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-md'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                        Remove Name from the list?
                    <div class='modal-footer mt-3'>";

                    if($regC == "ON HOLD" && $studType == "Graduate"){
                        $landing = "rhg";
                    }elseif($regC == "ON HOLD" && $studType == "Transfer"){
                        $landing = "rht";
                    }elseif($regC == "PENDING" && $studType == "Graduate"){
                        $landing = "rrg";
                    }elseif($regC == "PENDING" && $studType == "Transfer"){
                        $landing = "rrt";
                    }else{}

                    echo "<input type='hidden' name='landing' value='$landing'>";
                    echo "<input type='hidden' name='type' value='$studType'>";
                    echo "<input type='hidden' name='hold' value='$id'>";
                    echo "<button type='button' class='btn btn-sm btn-warning' data-bs-dismiss='modal'> Cancel </button>";
                    echo "<a href='registrarRemove.php?edit=$id&landing=$landing&user=$evaluator_name&type=$studType' class='btn btn-sm my-1 d-block btn-danger' data-toggle='tooltip' data-placement='top' title='Remove'><i class='fa-solid fa-trash'></i> Remove </a>";
                    echo "</div>
                </div>
            </div>
        </div>
    </div>";

echo"<div class='modal fade' id='regsPermDeleteGD$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-md'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                        This will delete the entire clearance entry for $fname $mname $lname.
                        Action cannot be undone.
                    <div class='modal-footer mt-3'>";
                    echo "<input type='hidden' name='type' value='$studType'>";
                    echo "<input type='hidden' name='hold' value='$id'>";
                    echo "<button type='button' class='btn btn-sm btn-warning' data-bs-dismiss='modal'> Cancel </button>";
                    echo "<a href='registrarPDelete.php?edit=$id&landing=rrg&user=$evaluator_name&type=$studType' class='btn btn-sm my-1 d-block btn-danger' data-toggle='tooltip' data-placement='top' title='Remove'><i class='fa-solid fa-trash'></i> Remove </a>";
                    echo "</div>
                </div>
            </div>
        </div>
    </div>";

echo"<div class='modal fade' id='regsRestore$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Restore</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <form action='restoreRegistrar.php' method='post'>
                <div class='modal-body'>
                    <div class='input-group col-md-12 modal-report-gen'>
                        <div class='row'>
                            Set School Year and Semester
                        </div>
                        <div class='row'>
                            <div class='col-md-6'>
                                <input type='text' name='r_sy' id='r_sy' class='form-control ml-3' placeholder='xxxx-xxxx' pattern='[0-9]{4}-[0-9]{4}' autocomplete='off' required>
                            </div>
                            <div class='col-md-6'>
                                <select name='r_semester' id='r_semester' class='form-select form-control' data-live-search='true'>";
                                    $view = new view();
                                    $view->semesterChoose2();
                                echo "</select>
                            </div>
                        </div>
                    </div>

                    <div class='modal-footer mt-3'>";

                    if($regC == "REMOVED" && $studType == "Graduate"){
                        $landing = "rhg";
                    }elseif($regC == "REMOVED" && $studType == "Transfer"){
                        $landing = "rht";
                    }elseif($regC == "REMOVED" && $studType == "Graduate"){
                        $landing = "rrg";
                    }elseif($regC == "REMOVED" && $studType == "Transfer"){
                        $landing = "rrt";
                    }else{}

                    echo "<input type='hidden' name='landing' value='$landing'>";
                    echo "<input type='hidden' name='type' value='$studType'>";
                    echo "<input type='hidden' name='restore' value='$id'>";
                    echo "<button type='button' class='btn btn-sm btn-warning' data-bs-dismiss='modal'> Cancel </button>";
                    echo "<input type='submit' class='btn btn-sm btn-info' value='Restore and Reset Status' name='restoreR'>";
                    echo "<input type='submit' class='btn btn-sm btn-info' value='Restore' name='restoreW'>";
                    // echo "<a href='registrarRestore.php?edit=$id&landing=$landing&user=$evaluator_name&type=$studType' class='btn btn-sm my-1 d-block btn-danger' data-toggle='tooltip' data-placement='top' title='Remove'><i class='fa-solid fa-trash-undo'></i> Restore </a>";
                    echo "</div>
                    </form>
                </div>
            </div>
        </div>
    </div>";

if($studType == "Transfer"){
    echo"<div class='modal fade' id='guidHold$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <form action='remarksGuidance.php' method='post'>
                <div class='modal-body'>
                    <div class='input-group col-md-12'>
                            Please state below the reason why this student will be on-hold.
                    </div>
                    <div class='input-group col-md-12'>
                        <textarea class='form-control' id='remarks' rows='10' name='remarks' required>$guidanceR</textarea>
                    </div>
                    <div class='modal-footer mt-3'>";

                    if($guidanceC == "ON HOLD" && $studType == "Graduate"){
                        $landing = "ghg";
                    }elseif($guidanceC == "ON HOLD" && $studType == "Transfer"){
                        $landing = "ght";
                    }elseif($guidanceC == "PENDING" && $studType == "Graduate"){
                        $landing = "grg";
                    }elseif($guidanceC == "PENDING" && $studType == "Transfer"){
                        $landing = "grt";
                    }else{}

                    echo "<input type='hidden' name='landing' value='$landing'>";
                    echo "<input type='hidden' name='type' value='$studType'>";
                    echo "<input type='hidden' name='hold' value='$id'>";
                    echo "<button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Cancel</button>";
                    if($guidanceC == "ON HOLD"){
                        echo "<input type='submit' class='btn btn-sm btn-info' value='Clear Remarks' name='reset'>";
                    }else{                          
                        echo "<input type='submit' class='btn btn-sm btn-warning' value='Hold Clearance' name='submit'>";
                    }
                    echo "</div>
                    </form>
                </div>
            </div>
        </div>
    </div>";

    echo"<div class='modal fade' id='guidModal$id' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-md'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Confirm</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>

                <div class='modal-body'>
                    <div class='input-group col-md-12'>
                        Did the student completed the Exit Interview? Kindly confirm to proceed.
                    </div>
                    <div class='modal-footer mt-3'>";

                    if($guidanceC == "ON HOLD" && $studType == "Graduate"){
                        $landing = "ghg";
                    }elseif($guidanceC == "ON HOLD" && $studType == "Transfer"){
                        $landing = "ght";
                    }elseif($guidanceC == "PENDING" && $studType == "Graduate"){
                        $landing = "grg";
                    }elseif($guidanceC == "PENDING" && $studType == "Transfer"){
                        $landing = "grt";
                    }else{}

                    echo "<button type='button' class='btn btn-sm btn-danger' data-bs-dismiss='modal'><i class='fa-solid fa-x'></i> Cancel</button>
                        <a href='guidanceApprove.php?edit=$id&landing=$landing&user=$guid_asst_name&type=$studType' class='btn btn-sm my-1 d-block btn-success' data-toggle='tooltip' data-placement='top' title='Approve'><i class='fa-solid fa-check'></i> Yes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>";
}
?>