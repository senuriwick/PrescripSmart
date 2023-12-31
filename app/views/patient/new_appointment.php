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
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/doctor/sideMenu&navBar.css" />
</head>

<body>


  <div class="content">
    <div class="sideMenu">
      <div class="logoDiv">
        <img class="logoImg" src="<?php echo URLROOT; ?>\public\img\patient\Untitled design (5) copy 2.png" />
      </div>

      <!-- <div class="patientDiv">
        <p class="mainOptions">PATIENT</p>

        <div class="profile">
          <p>username</p>
        </div>
      </div> -->


      <div class="manageDiv">
        <p class="mainOptions">MANAGE</p>

        <a href="prescriptions_dashboard.html" id="prescriptions">Prescriptions</a>
        <a href="reports_dashboard.html" id="reports">Reports</a>
        <a href="appointments_dashboard.html" id="appointments">Appointments</a>
        <a href="inquiries_dashboard.html" id="inquiries">Inquiries</a>
        <a href="prescriptions_dashboard.html" id="profile">Profile</a>
      </div>



      <div class="othersDiv">
        <a href="billing.html" id="billing">Billing</a>
        <a href="terms_of_service.html" id="terms">Terms of Service</a>
        <a href="privacy_policy.html" id="privacy">Privacy Policy</a>
      </div>

    </div>

    <div class="main">
      <div class="navBar">
        <img src="<?php echo URLROOT; ?>\public\img\patient\user.png" alt="user-icon">
        <p>SAMPLE USERNAME HERE</p>
      </div>

      <div class="adminInfoContainer">
        <div class="adminInfo">
          <img src="<?php echo URLROOT; ?>\public\img\patient\profile.png" alt="profile-pic">
          <div class="patientNameDivDiv">
            <p class="name">Patient Name</p>
            <p class="role">Patient</p>
          </div>
        </div>

        <div class="menu">
          <a href="new_appointment.html" id="appointments">New Appointment</a>
        </div>

        <div class="searchDiv">
          <h1>Find Your Doctor</h1>
          <div class="searchFiles">
            <form>
              <input type="text" name="search" id="searchInput" placeholder="Enter doctor's name here">
              <!-- <button type="search" id="search"><b>SEARCH</b></button> -->
            </form>

            <div class="patient-details">
              <table>
                <tbody>
                  <?php foreach ($data['doctors'] as $doctor): ?>
                    <tr class="patient-details-row" style="display: none;">
                      <td>
                        <div class="desDiv">
                          <a href="<?php echo URLROOT; ?>/public/patient/doctor_sessions?doctor_ID=<?php echo $doctor->doctor_ID; ?>"
                            class="doctor-link">
                            <p class="patientName">
                              <?php echo $doctor->fName; ?>
                              <?php echo $doctor->lName; ?>
                            </p>
                            <p class="patientSpecialization">
                              <?php echo $doctor->specialization; ?>
                            </p>
                            <p class="patientGender">
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

                      window.location.href = `<?php echo URLROOT; ?>/public/patient/doctor_sessions?doctor_ID=${doctorID}`;
                    } else {
                      console.error("Doctor ID not found in the href attribute");
                    }
                  });
                });
              });
            </script>




            <!-- <script>
              document.getElementById("search").addEventListener("click", function () {
                  window.location.href = "new_appointment_2.html";
              });
          </script> -->

          </div>

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
            <div class="searchFilterLine"></div>
            <select class="filterSelect" id="specializationSelect">
              <option value="" disabled selected>Select Specialization</option>
              <?php foreach ($specializations as $specialization): ?>
                <option value="<?php echo $specialization; ?>">
                  <?php echo $specialization; ?>
                </option>
              <?php endforeach; ?>
            </select>

            <select class="filterSelect" id="genderSelect">
              <option value="" disabled selected>Select Gender</option>
              <?php foreach ($genders as $gender): ?>
                <option value="<?php echo $gender; ?>">
                  <?php echo $gender; ?>
                </option>
              <?php endforeach; ?>
            </select>

            <!-- <button type="search" id="advsearch"><b>ADVANCED SEARCH</b></button> -->
            <!-- <script>
              document.getElementById("advsearch").addEventListener("click", function () {
                window.location.href = "new_appointment_2.html";
              });
            </script> -->
          </div>

        </div>
      </div>



      <!-- New appointment and inquiry division -->
      <p class="addnewHeading">Add new</p>
      <div class="addnew">

        <div class="appointment">
          <div>
            <img src="<?php echo URLROOT; ?>\public\img\patient\appointment.png" alt="appointment-icon">
            <p>
              <a href="new_appointment.html" id="appointments">Schedule an Appointment</a>
              <span class="details">The modern way to schedule and meet with convenience</span>
            </p>
          </div>
        </div>

        <div class="inquiry">
          <div>
            <img src="<?php echo URLROOT; ?>\public\img\patient\message.png" alt="chat-icon">
            <p>
              <a href="inquiries_dashboard.html" id="inquiries">Make an Inquiry</a>
              <span class="details">Initiate an online inquiry with a health supervisor</span>
            </p>
          </div>
        </div>
      </div>
    </div>


</body>

</html>