<form method="POST">
  <div class="row mt-5 g-3">
    <div class="col-md">
      <div>
        <h5>Please enter your provided reference number to check the current status:</h5>
        <input type="text" name="transnumber" oninvalid="this.setCustomValidity('Please enter your reference number!')" oninput="this.setCustomValidity('')" class="form-control" required>
      </div>
    </div>
  </div>
  <div class="row pt-4">
    <div class="col-md pt-3">
      <button class="btn button-submit btn-info">Check</button>
    </div>
  </div>
</form>
