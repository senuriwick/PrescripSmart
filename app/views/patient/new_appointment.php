<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>New Appointment</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/patient/new_appointment.css" />
</head>

<body>
  <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

    <div class="main">
      <?php include 'top_navigation_panel.php'; ?>

      <div class="adminInfoContainer">
        <div class="adminInfo">
          <?php include 'information_container.php'; ?>
        </div>

        <div class="menu">
          <a href="<?php echo URLROOT ?>/patient/new_appointment" id="appointments">New Appointment</a>
        </div>

        <div class="searchDiv">
          <h1>Find Your Doctor</h1>
          <div class="searchFiles">
            <form>
              <input type="text" name="search" id="searchInput" placeholder="Enter doctor's name here">
            </form>

            <?php

            $specializations = array();
            $genders = array();

            foreach ($data['doctors'] as $doctor) {
              if (!in_array($doctor->specialization, $specializations)) {
                $specializations[] = $doctor->specialization;
              }
            }

            foreach ($data['doctors'] as $doctor) {
              if (!in_array($doctor->gender, $genders)) {
                $genders[] = $doctor->gender;
              }
            }

            ?>

            <div class="searchFilter">
              <select class="filterSelect" id="specializationSelect">
                <option value="">Select Specialization</option>
                <option value="clear">Clear Specialization</option>
                <?php foreach ($specializations as $specialization): ?>
                  <option value="<?php echo $specialization; ?>">
                    <?php echo $specialization; ?>
                  </option>
                <?php endforeach; ?>
              </select>

              <select class="filterSelect" id="genderSelect">
                <option value="">Select Gender</option>
                <option value="clear">Clear Gender</option>
                <?php foreach ($genders as $gender): ?>
                  <option value="<?php echo $gender; ?>">
                    <?php echo $gender; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="patient-details">
              <table>
                <tbody>
                  <?php foreach ($data['doctors'] as $doctor): ?>
                    <tr class="patient-details-row" style="display: none;">
                      <td>
                        <div class="desDiv">
                          <a href="<?php echo URLROOT; ?>/patient/doctor_sessions?doctor_ID=<?php echo $doctor->doctor_ID; ?>"
                            class="doctor-link">
                            <img
                              src="<?php echo URLROOT ?>/public/uploads/profile_images/<?php echo $doctor->profile_photo ?>"
                              alt="profImage">
                            <p class="patientName"><strong>Dr.
                                <?php echo $doctor->first_Name; ?>
                                <?php echo $doctor->last_Name; ?></strong>
                            </p>
                            <p class="patientSpecialization">
                              <?php echo $doctor->specialization; ?>
                            </p>
                            <p class="patientGender" style="display:none">
                              <?php echo $doctor->gender; ?>
                            </p>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>

              <script>
                document.addEventListener("DOMContentLoaded", function () {
                  const searchInput = document.getElementById("searchInput");
                  const doctorRows = document.querySelectorAll(".patient-details-row");
                  const specializationSelect = document.getElementById("specializationSelect");
                  const genderSelect = document.getElementById("genderSelect");

                  searchInput.addEventListener("input", updateDoctorList);
                  specializationSelect.addEventListener("change", updateDoctorList);
                  genderSelect.addEventListener("change", updateDoctorList);

                  function updateDoctorList() {
                    const searchTerm = searchInput.value.toLowerCase();
                    const selectedSpecialization = specializationSelect.value.toLowerCase();
                    const selectedGender = genderSelect.value.toLowerCase();

                    doctorRows.forEach(function (row) {
                      const doctorName = row.querySelector(".patientName").textContent.toLowerCase();
                      const doctorSpecialization = row.querySelector(".patientSpecialization").textContent.toLowerCase();
                      const doctorGender = row.querySelector(".patientGender").textContent.toLowerCase();

                      const nameMatch = doctorName.includes(searchTerm);
                      const specializationMatch = selectedSpecialization === '' || doctorSpecialization.includes(selectedSpecialization);
                      const genderMatch = selectedGender === '' || doctorGender === selectedGender;

                      if (nameMatch && specializationMatch && genderMatch) {
                        row.style.display = "table-row";
                      } else {
                        row.style.display = "none";
                      }
                    });
                  }

                  specializationSelect.addEventListener("change", function () {
                    if (specializationSelect.value === "clear") {
                      specializationSelect.value = "";
                      updateDoctorList();
                    }
                  });

                  genderSelect.addEventListener("change", function () {
                    if (genderSelect.value === "clear") {
                      genderSelect.value = "";
                      updateDoctorList();
                    }
                  });
                });
              </script>
            </div>

            <script>
              document.addEventListener("DOMContentLoaded", function () {
                const doctorLinks = document.querySelectorAll(".doctor-link");

                doctorLinks.forEach(function (link) {
                  link.addEventListener("click", function (event) {
                    event.preventDefault();

                    const doctorHref = link.getAttribute("href");
                    const doctorIDMatch = doctorHref.match(/doctor_ID=(\d+)/);

                    if (doctorIDMatch && doctorIDMatch[1]) {
                      const doctorID = doctorIDMatch[1];

                      window.location.href = `<?php echo URLROOT; ?>/patient/doctor_sessions?doctor_ID=${doctorID}`;
                    } else {
                      console.error("Doctor ID not found in the href attribute");
                      header("Location: /prescripsmart/general/error_page");
                    }
                  });
                });
              });
            </script>
          </div>

        </div>
      </div>
    </div>
</body>

</html>