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
  <?php $currentPage = $data['currentPage'];
  $totalPages = $data['totalPages'];
  $allPatients = $data['allPatients'] ?>

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

            <div class="file">
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
                              <p class="name">Mr.
                                <?php echo $patient->display_Name; ?>
                              </p>
                            </strong>
                          <?php else: ?>
                            <strong>
                              <p class="name">Ms.
                                <?php echo $patient->display_Name; ?>
                              </p>
                            </strong>
                          <?php endif; ?>
                          <p class="city"><?php echo $city; ?></p>

                        </div>
                        <button class="viewButton" value="<?php echo $patient->patient_ID; ?>">View Profile</button>
                      </div>
                    <?php endforeach; ?>

                    <div class="pagination">
                      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="<?php echo URLROOT ?>/nurse/patients_dashboard/<?php echo $i ?>" <?php if ($currentPage == $i)
                                echo 'class="active"'; ?>><?php echo $i ?></a>
                      <?php endfor; ?>
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {

        function attachViewProfileListeners() {
          var viewButtons = document.querySelectorAll(".viewButton");
          viewButtons.forEach(function (button) {
            button.addEventListener("click", function () {
              var patientId = this.value;
              window.location.href = "<?php echo URLROOT ?>/nurse/patient_profile?patientId=" + patientId;
            });
          });
        }

        document.getElementById("searchBar").addEventListener("input", function () {
          var searchQuery = this.value.trim();
          if (searchQuery !== "") {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "<?php echo URLROOT ?>/nurse/filterPatients?search=" + searchQuery, true);
            xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && xhr.status == 200) {
                var filteredPatients = JSON.parse(xhr.responseText);
                updatePatientList(filteredPatients);
                attachViewProfileListeners();
              }
            };
            xhr.send();
          } else {
            location.reload();
          }
        });
        attachViewProfileListeners();
      });

      function updatePatientList(filteredPatients) {
        var patientsContainer = document.querySelector(".file .patient-details");
        patientsContainer.innerHTML = "";

        filteredPatients.forEach(function (patient) {
          var patientHTML = `
            <div class="patientFile">
                <div class="fileInfo">
                    <img src="<?php echo URLROOT ?>/public/uploads/profile_images/${patient.profile_photo}" alt="patient-pic">
                    <strong>
                        <p class="name">${patient.gender === 'male' ? 'Mr.' : 'Ms.'} ${patient.display_Name}</p>
                    </strong>
                    <p class="city">${patient.city}</p>
                </div>
                <button class="viewButton" value="${patient.patient_ID}">View Profile</button>
            </div>`;
          patientsContainer.innerHTML += patientHTML;
        });
      }
    </script>

    <script>
      var viewButtons = document.querySelectorAll(".viewButton");
      viewButtons.forEach(function (button) {
        button.addEventListener("click", function () {
          var patientId = this.value;
          window.location.href = "<?php echo URLROOT ?>/nurse/patient_profile?patientId=" + patientId;
        });
      });
    </script>

</body>