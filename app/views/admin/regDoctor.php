<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Patient Profile</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/RegisterActor.css"/>
</head><body>

<div class="content">
    <div class="sideMenu"> 
      <div class="logoDiv">
          <img class="logoImg" src="<?php echo URLROOT ?>/img/admin/Untitled design (5).png"/>
      </div>


      <div class="manageDiv">
        <button class="mainOptions" onclick="toggleSubmenu('submenus'),toggleCaret()">MANAGE <i id="caret" class="fa fa-angle-right dropdown" style="padding-left: 4vh;"></i></button>
        <div class="submenus" id="submenus">
        <a href="<?php echo URLROOT ?>/admin/searchPatient" id="appointments">Patients</a>
        <a href="<?php echo URLROOT ?>/admin/searchDoctor" id="appointments">Doctors</a>
        <a href="<?php echo URLROOT ?>/admin/searchNurse" id="appointments">Nurses</a>
        <a href="<?php echo URLROOT ?>/admin/searchLabtech" id="appointments">Lab Technicians</a>
        <a href="<?php echo URLROOT ?>/admin/searchHealthsup" id="appointments">Health SV</a>
        <a href="<?php echo URLROOT ?>/admin/searchReceptionist" id="appointments">Receptionists</a>
        <a href="<?php echo URLROOT ?>/admin/searchPharmacist" id="appointments">Pharmacists</a>
        <a href="<?php echo URLROOT ?>/admin/searchPatient" id="appointments">Medications</a>

      <div class="othersDiv">
        <a class="appointments">Profile</a>
        <a class="appointments">Billing</a>
        <a class="appointments">Terms of Services</a>
        <a class="appointments">Privacy Policy</a>
        <a class="appointments">Settings</a>
      </div>
      </div>

    </div>
    </div>


    <div class="main">
      <div class="navBar">
        <img src="<?php echo URLROOT ?>/img/admin/user.png" alt="user-icon">
        <p>SAMPLE USERNAME HERE</p>
      </div>  

      <div class="adminInfoContainer">
        <div class="adminInfo">
          <img src="<?php echo URLROOT ?>/img/admin/profile.png" alt="profile-pic">
          <div class="adminNameDiv">
            <p class="name">Administrator Name</p>
            <p class="role">Admin</p>
          </div>
        </div>

        <div class="menu">

            <a href="<?php echo URLROOT ?>/admin/searchPatient" id="prescriptions">Patients</a>
            <a href="<?php echo URLROOT ?>/admin/searchDoctor" id="reports">Doctors</a>
            <a href="<?php echo URLROOT ?>/admin/searchNurse" id="appointments">Nurses</a>
            <a href="<?php echo URLROOT ?>/admin/searchLabtech" id="appointments">Lab Technicians</a>
            <a href="<?php echo URLROOT ?>/admin/searchHealthsup" id="appointments">Health SV</a>
            <a href="<?php echo URLROOT ?>/admin/searchReceptionist" id="appointments">Receptionists</a>
            <a href="<?php echo URLROOT ?>/admin/searchPharmacist" id="appointments">Pharmacists</a>

        </div>
    

        
      <div class="details">
        <div class="back" style="display: flex; ">
          
            <img src="<?php echo URLROOT ?>/img/admin/Vector.svg" >
          
          <h1 >Doctor Registration</h1>
        </div>
        
          <div class="top1">
              <div class="firstname">
                  <div class="req">
                    <h3 style="color: #0069FF;">first name</h3>
                    <p style="color: red;">*</p>
                  </div>
                  <input type="text" name="first_name" placeholder="Enter Your first name">
              </div>
              <div class="lastname">
                <div class="req">
                  <h3 style="color: #0069FF;">last name</h3>
                  <p style="color: red;">*</p>
                </div>
                  <input type="text" name="last_name" placeholder="Enter Your last name">
              </div>
          </div>
      
          <div class="top2">
              <div class="email">
                  <h3>email address</h3>
                  <input type="text" name="email" placeholder="Enter Your email address">
              </div>
              <div class="phone">
                <div class="req">
                  <h3 style="color: #0069FF;">contact number</h3>
                  <p style="color: red;">*</p>
                </div>
                  <input type="text" name="phone_number" placeholder="Enter Your phone number">
              </div>
          </div>
      
          <div class="top3">
            <div class="req">
              <h3 style="color: #0069FF;">create password</h3>
              <p style="color: red;">*</p>
            </div>
              <input type="password" name="password" placeholder="Enter password">
          </div>
          
          <button type="submit"><b>Register</b></button>
      
      </div>
      <script src="<?php echo URLROOT ?>/js/admin/script.js"></script>
      
      
    