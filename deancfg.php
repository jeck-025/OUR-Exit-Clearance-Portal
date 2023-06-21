<?php
$view = new view();
$update = new updateDeanCFG();

echo"<div class='modal fade' id='deanCFG' aria-labelledby='modal' aria-hidden='true'>
        <div class='modal-dialog modal-xl'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='modal'>Dean Info Configuration</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>

                <div class='modal-body'>
                    <div class='input-group col-md-12 modal-report-gen'>
                        <form method='post'>
                            <div class='row'>
                                <table id='scholartable' class='table table-hover table-striped table-borderless table-sm'>
                                <tr>
                                <th><h5>School</h5></th>
                                <th><h5>Dean</h5></th>
                                </tr>"; ?>
                                <?php $view->loadDeans(); ?>
                                </table>
                            </div>
                            <input type="submit" name="updatedeanCFG" id="updatedeanCFG">
                        </form>
                <?php
                echo"</div>";
                echo "<div class='modal-footer mt-3'>";
                echo "FOOTER";
                echo "</div>
            </div>
        </div>
    </div>
</div>";



?>