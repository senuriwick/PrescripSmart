<?php require APPROOT."/views/inc/components/header.php" ?>
<link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_dashboard.css" />
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
<!-- <script src="main.js"></script> -->
</head>

<body>
    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
                <?php include 'information_container.php'; ?>
                <?php include 'in_page_navigation.php'; ?>

            <div class="ash-box">
                <div class="prescriptionsDiv">
                    <h2>Search Patient</h2>
                    <form method="post" action="<?php echo URLROOT; ?>/Pharmacist/searchPatient">
                        <input type="text" id="search" name="search" placeholder="Enter patient name" class="inputfield">
                        <button type="submit" id="searchButton" disabled>SEARCH</button>
                    </form>
                </div>
                <hr class="divider">
            <div class="details">
                <div class="patientFiles">
                    <?php if (empty($data['patients'])): ?>
                    <div class="center-content">
                        <p class="grey-text">Sorry, Not Found</p>
                    </div>
                    <?php else: ?>
                    <?php foreach($data['patients'] as $patient): ?>
                    <div class="patientFile">   
                        <img class="person-circle" src="<?php echo URLROOT ?>/public/uploads/profile_images/<?php echo $patient->profile_photo ?>" alt="patient-pic">
                        <p><?php echo $patient->display_Name; ?></p>
                        <p id="patientId">Patient ID <span><?php echo $patient->patient_ID; ?></span></p>
                        <a href="<?php echo URLROOT ?>/Pharmacist/allPrescriptions?patient_id=<?php echo $patient->patient_ID; ?>&patient_name=<?php echo urlencode($patient->display_Name); ?>&patient_age=<?php echo $patient->age; ?>" id="viewButton"><button>View Prescriptions</button></a>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php $totalPages = $data['totalPages'];
                      $currentPage = $data['currentPage'];
                ?>
                <!-- Pagination Links -->
                <div class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="<?php echo URLROOT ?>/pharmacist/dashboard/<?php echo $i ?>" <?php if ($currentPage == $i) echo 'class="active"'; ?>><?php echo $i ?></a>
                    <?php endfor; ?>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        document.getElementById("search").addEventListener("input", function () {
          var searchQuery = this.value.trim();
          if (searchQuery !== "") {
            console.log(searchQuery);
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "<?php echo URLROOT ?>/pharmacist/filterPatients?search=" + searchQuery, true);
            xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && xhr.status == 200) {
                var filteredPatients = JSON.parse(xhr.responseText);
                updatePatientList(filteredPatients);
              }
            };
            xhr.send();
          } else {
            location.reload();
          }
        });

    

      function updatePatientList(filteredPatients) {
        var patientsContainer = document.querySelector(".details");
        patientsContainer.innerHTML = "";

        filteredPatients.forEach(function (patient) {
          var patientHTML = `
          <div class="patientFile">   
                        <img class="person-circle" src="<?php echo URLROOT ?>/public/uploads/profile_images/${patient.profile_photo}" alt="patient-pic">
                        <p>${patient.display_Name}</p>
                        <p id="patientId">Patient ID <span>${patient.patient_ID}</span></p>
                        <a href="<?php echo URLROOT ?>/Pharmacist/allPrescriptions?patient_id=${patient.patient_ID}&patient_name=${patient.display_Name}&patient_age=${patient.age} id="viewButton"><button>View Prescriptions</button></a>
                    </div>`;
          patientsContainer.innerHTML += patientHTML;
          
        });
      }
    </script>

</body>
</html>
