<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Search a Doctor</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/search.css"/>
</head>
<body>

  <div class="content">
    <div class="sideMenu"> 
      <div class="logoDiv">
          <img class="logoImg" src="<?php echo URLROOT ?>/img/Untitled design (5).png"/>
      </div>


      <div class="manageDiv">
        <button class="mainOptions" onclick="toggleSubmenu('submenus'),toggleCaret()">MANAGE <i id="caret" class="fa fa-angle-right dropdown" style="padding-left: 4vh;"></i></button>
        <div class="submenus" id="submenus">
        <a href="<?php echo URLROOT ?>/pages/searchPatient" id="appointments">Patients</a>
        <a href="<?php echo URLROOT ?>/pages/searchDoc" id="appointments">Doctors</a>
        <a href="<?php echo URLROOT ?>/pages/searchNurse" id="appointments">Nurses</a>
        <a href="<?php echo URLROOT ?>/pages/searchLabtech" id="appointments">Lab Technicians</a>
        <a href="<?php echo URLROOT ?>/pages/searchHealthsup" id="appointments">Health SV</a>
        <a href="<?php echo URLROOT ?>/pages/searchReceptionist" id="appointments">Receptionists</a>
        <a href="<?php echo URLROOT ?>/pages/searchPharmacist" id="appointments">Pharmacists</a>
        <a href="<?php echo URLROOT ?>/pages/searchPatient" id="appointments">Medications</a>
     
    


      <div class="othersDiv">
        <a class="sideMenuTexts">Profile</a>
        <a class="sideMenuTexts">Billing</a>
        <a class="sideMenuTexts">Terms of Services</a>
        <a class="sideMenuTexts">Privacy Policy</a>
        <a class="sideMenuTexts">Settings</a>
      </div>
    </div>
  </div>

    </div>

    <div class="main">
      <div class="navBar">
        <img src="<?php echo URLROOT ?>/img/user.png" alt="user-icon">
        <p>SAMPLE USERNAME HERE</p>
      </div>  

      <div class="adminInfoContainer">
        <div class="adminInfo">
          <img src="<?php echo URLROOT ?>/img/profile.png" alt="profile-pic">
          <div class="adminNameDiv">
            <p class="name">Administrator Name</p>
            <p class="role">Admin</p>
          </div>
        </div>

        <div class="menu">

        <a href="<?php echo URLROOT ?>/pages/searchPatient" id="prescriptions">Patients</a>
            <a href="<?php echo URLROOT ?>/pages/searchDoc" id="reports">Doctors</a>
            <a href="<?php echo URLROOT ?>/pages/searchNurse" id="appointments">Nurses</a>
            <a href="<?php echo URLROOT ?>/pages/searchLabtech" id="appointments">Lab Technicians</a>
            <a href="<?php echo URLROOT ?>/pages/searchHealthsup" id="appointments">Health SV</a>
            <a href="<?php echo URLROOT ?>/pages/searchReceptionist" id="appointments">Receptionists</a>
            <a href="<?php echo URLROOT ?>/pages/searchPharmacist" id="appointments">Pharmacists</a>

        </div>

        <div class="searchDiv">
          <h1>Search Nurse</h1>
          <div class="searchFiles">

            <input type="search" placeholder="Enter Nurses' Name/ID here">
            <button type="search"><b>SEARCH</b></button>

         </div>
       </div>

        <!-- <div class="addapp">
          <div class="newapp">
            <img src="<?php //echo URLROOT ?>/img/FilePerson.png">
            <a href="AdminDocRegister.html">Register a new doctor</a>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</body>
<script src="<?php echo URLROOT ?>/js/script.js"></script>
               
</html>