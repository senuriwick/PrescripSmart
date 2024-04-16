<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomePage</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700"/>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/general/home.css">
</head>

<body>
  <div class="welcomePage" id="welcomePage">
    <div class="container">
      <div class="logoDiv">
        <div>P</div>
        <h5>PrescripSmart</h5>
      </div>
      <p class="mainTitle">Your paperless <br>prescription partner.</p>
      <div id="options">
        <button id="patient" class="optionButton1">
          <img src="<?php echo URLROOT; ?>\public\img\general\bed (1).png" alt="Patient" class="optionIcon">
          Patient
        </button>
        <button id="employee" class="optionButton2">
          <img src="<?php echo URLROOT; ?>\public\img\general\medical-team (1).png" alt="Employee" class="optionIcon">
          Employee
        </button>
      </div>
    </div>
  </div>

  <div class="terms-privacy-container">
    <a href="<?php echo URLROOT; ?>/general/terms_of_service">Terms and Conditions</a>
    <a href="<?php echo URLROOT; ?>/general/privacy_policy">Privacy Policy</a>
  </div>

  <script>
    document.getElementById("patient").addEventListener("click", function () {
      window.location.href = "<?php echo URLROOT; ?>/patient/login";
    });

    document.getElementById("employee").addEventListener("click", function () {
      window.location.href = "<?php echo URLROOT; ?>/general/employee_login";
    });
  </script>

</body>
</html>
