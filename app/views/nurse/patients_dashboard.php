<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Patients</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\nurse\patients_dashboard.css" />
</head>

<body>

  <div class="content">
    <div class="sideMenu">
      <div class="logoDiv">
        <img class="logoImg" src="<?php echo URLROOT ?>\public\img\nurse\Untitled design (5) copy 2.png" />
      </div>

      <!-- <div class="patientDiv">
        <p class="mainOptions">NURSE</p>

        <div class="profile">
          <p>username</p>
        </div>
      </div> -->


      <div class="manageDiv">
        <p class="mainOptions">MANAGE</p>

        <a href="patients_dashboard.html" id="patients">Patients</a>
        <a href="ongoing.html" id="On-going">On-going session</a>
        <a href="sessions.html" id="sessions">Sessions</a>
        <a href="appointments.html" id="appointments">Appoinments</a>
        <a href="profile.html" id="profile">Profile</a>
      </div>


      <div class="othersDiv">
        <a href="billing.html" id="billing">Terms of Service</a>
        <a href="terms_of_service.html" id="terms">Privacy Policy</a>
        <a href="privacy_policy.html" id="privacy">Settings</a>
      </div>

    </div>

    <div class="main">
      <div class="navBar">
        <img src="<?php echo URLROOT ?>\public\img\nurse\user.png" alt="user-icon">
        <p>SAMPLE USERNAME HERE</p>
      </div>

      <div class="patientInfoContainer">
        <div class="patientInfo">
          <img src="<?php echo URLROOT ?>\public\img\nurse\profile.png" alt="profile-pic">
          <div class="patientNameDiv">
            <p class="name">Nurse Name</p>
            <p class="role">Nurse</p>
          </div>
        </div>

        <div class="menu">
          <a href="patients_dashboard.html" id="patients">Patients</a>
          <a href="ongoing.html" id="On-going">On-going session</a>
          <a href="sessions.html" id="sessions">Sessions</a>
          <a href="appointments.html" id="appointments">Appoinments</a>
        </div>

        <div class="prescriptionsDiv">
          <h1>Search Patient</h1>
          <input type="text" id="searchBar" name="search" placeholder="Enter patient's name or ID" class="inputfield">
          <button id="searchButton">SEARCH</button>

          <div class="patient-details">
            <table>
              <tbody>
                <?php foreach ($data['patients'] as $patient): ?>
                  <div class="patientFile">
                    <div class="fileInfo">
                      <img src="\public\img\nurse\PersonCircle.png" alt="patient-pic">
                      <?php if ($patient->gender == "male"): ?>
                        <p>Mr.
                          <?php echo $patient->display_Name; ?>
                        </p>
                      <?php else: ?>
                        <p>Ms.
                          <?php echo $patient->display_Name; ?>
                        </p>
                      <?php endif; ?>

                    </div>
                    <p class="patientId">Patient ID #
                      <?php echo $patient->patient_ID; ?>
                    </p>
                    <button class="viewButton" value="<?php echo $patient->patient_ID; ?>">View Profile</button>
                  </div>
                <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("searchBar").addEventListener("input", function () {
      var searchQuery = this.value.toLowerCase();
      var patientDetails = document.querySelectorAll(".patientFile");
      patientDetails.forEach(function (patient) {
        var patientName = patient.querySelector("p").textContent.toLowerCase();

        if (patientName.includes(searchQuery)) {
          patient.style.display = "block";
        } else {
          patient.style.display = "none";
        }
      });
    });
  </script>

  <script>
    var viewButtons = document.querySelectorAll(".viewButton");

    viewButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        var patientId = this.value;
        window.location.href = "patient_profile?patientId=" + patientId;
      });
    });
  </script>


</body>