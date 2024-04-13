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
        <img src="<?php echo URLROOT ?>/img/admin/user.png" alt="user-icon">
        <p><?php echo ucwords($_SESSION['first_name']); ?></p>
      </div>  

      <div class="adminInfoContainer">
        <div class="adminInfo">
          <img src="<?php echo URLROOT ?>/img/admin/profile.png" alt="profile-pic">
          <div class="adminNameDiv">
            <p class="name"><?php echo ucwords($_SESSION['first_name']); ?> <?php echo ucwords($_SESSION['last_name']); ?></p>
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