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
        <p class="mainTitle">Prescrip<span class="smart">Smart</span></p>
        <a href="#selectRole"><button id="selectRoleButton">Select role</button></a>
    </div>
  </div>

  <div id="selectRole">
    <div id="selectRolePage">
      <p id="iam">I'm a/an ...</p>
      <div id="options">
        <button id="patient" class="optionButton">
          <img src="<?php echo URLROOT; ?>\public\img\general\mdi_patient-outline.png" alt="Patient" class="optionIcon">
          Patient
        </button>
        <button id="employee" class="optionButton">
          <img src="<?php echo URLROOT; ?>\public\img\general\clarity_employee-line.png" alt="Employee" class="optionIcon">
          Employee
        </button>
      </div>
    </div>
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
