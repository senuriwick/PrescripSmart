<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Receptionist Add appointmnet</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/RepAddApp.css"/>
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/navbar&sidemenu.css"/>
  <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script>

</head>
<body>

  <?php require APPROOT .'/views/includes/navbar&sidemenu.php'; ?>

        <div class="searchDiv">
              <h1>Add New Appointment</h1>
              <div class="searchFiles">
                    <input type="search" placeholder="Enter doctor name or ID here">
                    <button type="search"><b>SEARCH</b></button>
                    <hr style="margin-bottom: 3vh;">        
             </div>

             <div class="app-doc">
                    <img src="<?php echo URLROOT ?>/img/receptionist/PersonCircle.png" alt="profile-pic">
                    <h3>DR. ASANKA SAYAKKARA</h3>
             </div>          
             <h4 class="doc-pos">Consultant Physician</h4>

             <div class="sessions">
                    <h4><strong>Session #23233</strong></h4>
                    <hr style="margin-top: -2vh; width: 25vh; color:#445172BF;">
                    <p>Date: Sunday, 17th Sept, 2023</p>
                    <p>Time: 06.00 A.M </p>
                    <button><strong>BOOK NOW</strong> </button>
             </div>



        </div>
</body>