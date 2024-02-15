<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomePage</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700"/>
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/home.css">
 
</head>

<body>
  <div class="welcomePage">
    <div class="container">
        <p class="mainTitle">Prescrip<span class="smart">Smart</span></p>
        <a href="#page2"><button id="selectRole" >Select role</button></a>
    </div>
  </div>

  <div id="page2">
    <div id="selectRolePage">
      <p id="iam">I'm a<span class="dots">...</span></p>
      <div id="options">
        <button id="patient">Patient</button>
        
        
        <button>Lab Technician</button>
        <button>Doctor</button>
        <button>Pharmacist</button>
        <button>Nurse</button>
        <button id="admin">System Admin</button>
        <script>
          document.getElementById("admin").addEventListener("click", function () {
              window.location.href = "<?php echo URLROOT?>/admin/login";
          });
        </script>

        <button id="receptionist">Receptionist</button>
        <script>
          document.getElementById("receptionist").addEventListener("click", function () {
              window.location.href = "<?php echo URLROOT?>/admin/login";
          });
        </script>

        <button >Health Supervisor</button>
        
      </div>
    </div>
  </div>
</body>

</html>