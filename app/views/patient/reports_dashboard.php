<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Reports</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\patient\reports_dashboard.css" />
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

      <div class="patientInfoContainer">
        <div class="patientInfo">
          <img src="<?php echo URLROOT; ?>\public\img\patient\profile.png" alt="profile-pic">
          <div class="patientNameDiv">
            <p class="name">Patient Name</p>
            <p class="role">Patient</p>
          </div>
        </div>

        <div class="menu">
          <a href="prescriptions_dashboard.html" id="prescriptions">Prescriptions</a>
          <a href="reports_dashboard.html" id="reports">Reports</a>
          <a href="appointments_dashboard.html" id="appointments">Appointments</a>
        </div>

        <div class="reportsDiv">
          <h1>Reports</h1>
          <?php foreach ($data['reports'] as $report): ?>
            <div class="reportFiles">

              <div class="file">
                <div class="desDiv">
                  <img src="<?php echo URLROOT; ?>\public\img\patient\description.png" alt="description-icon">
                  <p class="description">Report #<?php echo $report->report_ID; ?>
                  </p>
                </div>
                <p>Issued on:
                  <?php echo $report->report_Date; ?>
                </p>
                <p>Referred by Dr.
                  <?php echo $report->fName; ?>
                  <?php echo $report->lName; ?>
                </p>
                <img src="<?php echo URLROOT; ?>\public\img\patient\Eye.png" alt="eye-icon"
                  data-container-pid="<?= $report->report_ID ?>">
                <img src="<?php echo URLROOT; ?>\public\img\patient\download.png" alt="download-icon">
              </div>
            </div>

            <div id="myModal<?= $report->report_ID ?>" class="modal">
              <div class="modal-content">
                <span class="close">&times;</span>
                <a href="www.prescripsmart.com">www.prescripsmart.com</a>
                <div class="model-head">
                  <img src="<?php echo URLROOT; ?>/public/img/doctor/qr.png" alt="qr-img" />
                  <h4><u>CONFIDENTIAL LAB REPORT</u></h4>
                  <i class="fa-solid fa-circle-arrow-up"></i>
                </div>
                <div class="model-details">
                  <div>Prescription ID: #<?php echo $report->prescription_ID; ?></div>
                  <div>Patient: S.Perera</div>
                  <div>Pres Date & Time: <?php echo $report->prescription_Date; ?> 10:00 AM</div>
                  <div>Age: 22 Yrs</div>
                  <div>Referred by: Dr.<?php echo $report->fName; ?> <?php echo $report->lName; ?></div>
                </div>
                <div class="test-box">
                  <table>
                    <tbody>
                      <tr>
                        <td>TEST</td>
                        <td>RESULT</td>
                        <td>FLAG REFERENCE VALUE</td>
                      </tr>
                      <tr>
                        <td>Test 1</td>
                        <td>Result 1</td>
                        <td>Value 1</td>
                      </tr>
                      <tr>
                        <td>Test 2</td>
                        <td>Result 2</td>
                        <td>Value 2</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="pres-box">
                  <label>Other Comments...</label>
                  <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                  </div>
                </div>
                <div class="notice">(For viewing purpose only)</div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>






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
    </div>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const eyeIcons = document.querySelectorAll('.file img[src*="Eye.png"]');

    eyeIcons.forEach(icon => {
      const reportID = icon.getAttribute('data-container-pid');
      const modal = document.getElementById(`myModal${reportID}`);
      const closeButton = modal.querySelector(".close");

      icon.addEventListener("click", () => {
        modal.style.display = 'block';
      });

      closeButton.addEventListener("click", () => {
        modal.style.display = "none";
      });

      window.addEventListener("click", (event) => {
        if (event.target === modal) {
          modal.style.display = "none";
        }
      });
    });

    // const modal = document.getElementById("myModal");
    // const closeButton = modal.querySelector(".close");
  });
</script>
</body>
</html>