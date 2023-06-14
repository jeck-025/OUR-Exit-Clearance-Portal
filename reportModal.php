<?php
echo"<div class='modal fade' id='reportModal' aria-labelledby='modal' aria-hidden='true'>
    <div class='modal-dialog modal-xl'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='modal'>Generate Reports</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>

            <div class='modal-body'>
                <div class='input-group col-md-12 modal-report-gen'>"; ?>
                    <form method="get" action="reportsDownload.php">
                        <!-- <h4>Generate Reports</h4><hr> -->
                          <div class="row">
                            <div class="col col-md-3">
                              <label for="r_semester" class="form-label">Semester</label>
                                <select name="r_semester" id="semester" class="form-select form-control" data-live-search="true">
                                  <?php 
                                    $view = new view();
                                    $view->semesterChoose();?>
                                </select>
                            </div>
                            <div class="col col-md-3">
                              <label for="r_sy" class="form-label">School Year</label>
                                <input type="text" name="r_sy" id="r_sy" class="form-control" placeholder="xxxx-xxxx" pattern="[0-9]{4}-[0-9]{4}" oninvalid="this.setCustomValidity('Please follow the pattern (XXXX-XXXX)')" oninput="this.setCustomValidity('')" autocomplete="off">
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="g_submit" class="form-label"><u>Graduates</u></label>
                              <button type="submit" id="g_submit" name="g_submit" class="btn btn-dark btn-block" onClick="btnDownloadG()"><i class="fa-solid fa-download"></i> Download </button>
                            </div>
                            <div class="col-md-3 text-center">
                                <label for="u_submit" class="form-label"><u>Transfers</u></label>
                              <button type="submit" id="u_submit" name="u_submit" class="btn btn-dark btn-block" onClick="btnDownloadU()"><i class="fa-solid fa-download"></i> Download </button>
                            </div>
                          </div> 
                    </form>
                <?php
                echo"</div>";
                echo "<div class='modal-footer mt-3'>";
                echo "</div>
            </div>
        </div>
    </div>
</div>";
?>