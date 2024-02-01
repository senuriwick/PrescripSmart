<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Healthsupervisor Page</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"
    />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/healthSupervisor/healthSupervisor_dashboard.css" />
    <!-- <link rel="stylesheet" href="styles/sideMenu&navBar.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
  </head>
  <body>
    <div class="content">
      <div class="sideMenu">
        <div class="logoDiv">
          <img class="logoImg" src="./assets/logo.png" />
        </div>

        <div class="patientDiv">
          <p class="mainOptions">HEALTHSUPERVISOR</p>

          <div class="profile">
            <p>username</p>
          </div>
        </div>

        <div class="manageDiv">
          <p class="mainOptions">MANAGE</p>

          <div class="inquiriesMenu">
            <p class="sideMenuTexts">Inquiries</p>
          </div>

          <a href="healthSupervisor_History.html" class="sideMenuLink">
            <p class="sideMenuTexts">History</p>
          </a>
          <p class="sideMenuTexts">Profile</p>
        </div>

        <div class="othersDiv">
          <p class="sideMenuTexts">Terms of Services</p>
          <p class="sideMenuTexts">Privacy Policy</p>
          <p class="sideMenuTexts">Settings</p>
        </div>
      </div>

      <div class="main">
        <div class="navBar">
          <img src="./assets/user.png" alt="user-icon" />
          <p>SAMPLE USERNAME HERE</p>
        </div>

        <div class="patientInfoContainer">
          <div class="patientInfo">
            <img src="./assets/profile.png" alt="profile-pic" />
            <div class="patientNameDiv">
              <p class="name">HealthSupervisor Name</p>
              <p class="role">HealthSupervisor</p>
            </div>
          </div>

          <div class="menu">
            <p id="">Inquiries</p>
            <p id="history">History</p>
          </div>

          <p class="noOfPrescriptions">Inquiries (3)</p>
          <div class="prescription-file1">
            <img class="clipboard-1" src="./assets/clipboard.png" />
            <p class="pres-description-1">#1256633</p>
            <p class="doctor-name-1">Patient Name</p>
            <p class="dd-mm-yyyy-1">DD-MM-YYYY</p>
            <p><button class="green-button">view</button></p>
          </div>
          <div class="prescription-file2">
            <img class="clipboard-2" src="./assets/clipboard.png" />
            <p class="pres-description-2">#1254652</p>
            <p class="doctor-name-2">Patient Name</p>
            <p class="dd-mm-yyyy-2">DD-MM-YYYY</p>
            <p><button class="green-button">view</button></p>
          </div>
          <div class="prescription-file3">
            <img class="clipboard-3" src="./assets/clipboard.png" />
            <p class="pres-description-3">#1254686</p>
            <p class="doctor-name-3">Patient Namee</p>
            <p class="dd-mm-yyyy-3">DD-MM-YYYY</p>
            <p><button class="green-button">view</button></p>
          </div>
          <div class="line-19-WS5"></div>
        </div>
      </div>
    </div>
  </body>
</html>