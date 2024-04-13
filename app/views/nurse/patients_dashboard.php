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
    <?php include 'side_navigation_panel.php'; ?>

    <div class="main">
      <?php include 'top_navigation_panel.php'; ?>

      <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>

        <div class="prescriptionsDiv">
          <div class="inquiriesDiv">
            <h1>Search Patient</h1>
            <input type="text" id="searchBar" name="search" placeholder="Enter patient's name or ID" class="inputfield">
            <button id="searchButton">SEARCH</button>

            <div class="patient-details">
              <table>
                <tbody>
                  <?php foreach ($data['patients'] as $patient): ?>
                    <?php
                    $address = $patient->home_Address;
                    $parts = explode(", ", $address);
                    $city = end($parts);
                    ?>

                    <div class="patientFile">
                      <div class="fileInfo">
                        <img
                          src="<?php echo URLROOT ?>\public\uploads\profile_images\<?php echo $patient->profile_photo ?>"
                          alt="patient-pic">
                        <?php if ($patient->gender == "male"): ?>
                          <strong>
                            <p>Mr.
                              <?php echo $patient->display_Name; ?>
                            </p>
                          </strong>
                        <?php else: ?>
                          <strong>
                            <p>Ms.
                              <?php echo $patient->display_Name; ?>
                            </p>
                          </strong>
                        <?php endif; ?>
                        <p class="patientId"><?php echo $city; ?></p>

                      </div>
                      <button class="viewButton" value="<?php echo $patient->patient_ID; ?>">View Profile</button>
                    </div>
                  <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById("searchButton").addEventListener("click", function () {
      filterPatients();
    });

    document.getElementById("searchBar").addEventListener("input", function () {
      filterPatients();
    });

    function filterPatients() {
      var searchQuery = document.getElementById("searchBar").value.toLowerCase();
      var patientDetails = document.querySelectorAll(".patientFile");

      patientDetails.forEach(function (patient) {
        var patientName = patient.querySelector("p").textContent.toLowerCase();

        if (patientName.includes(searchQuery) || searchQuery === "") {
          patient.style.display = "flex";
        } else {
          patient.style.display = "none";
        }
      });
    }

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