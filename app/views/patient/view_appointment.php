<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Appointments</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\patient\view_appointment.css" />
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
 
        <div class="prescriptionsDiv">
          <div>
            <div class="section-header">
              <?php $appointment_ID = $_GET['appointment_id']; ?>
              <?php $appointment = $data['appointment']; ?>
              <h1>Appointment (#
                <?php echo $appointment->appointment_ID; ?>)
              </h1>
              <button id="cancelButton" class="buttonstyle">Cancel Appointment</button>
            </div>

            <div id="policyPopup" class="popup">
              <div class="popup-content">
                <h2>Cancellation Policy</h2>
                <p>Your cancellation policy message goes here.</p>
                <button id="closePolicy" class="buttonstyle">Close</button>
              </div>
            </div>

            <div id="confirmationPopup" class="popup">
              <div class="popup-content">
                <p>Are you sure you want to cancel this appointment?</p>
                <button id="confirmYesButton">Yes</button>
                <button id="confirmNoButton">No</button>
              </div>
            </div>

            <div style="display:none">
                        <form action="<?php echo URLROOT; ?>/Patient/view_appointment" method="POST"
                            id="addapp">
                            <input type="hidden" name="appointment_ID" value="<?php echo $appointment_ID ?>">
                            <input type="submit" style="display:none" id="insertapp">
                        </form>
                    </div>

            <script>
              document.addEventListener('DOMContentLoaded', function () {
                const cancelButton = document.getElementById('cancelButton');
                const confirmationPopup = document.getElementById('confirmationPopup');
                const confirmYesButton = document.getElementById('confirmYesButton');
                const confirmNoButton = document.getElementById('confirmNoButton');
                const policyPopup = document.getElementById('policyPopup');


                cancelButton.addEventListener('click', function () {
                  policyPopup.style.display = 'block';
                  // confirmationPopup.style.display = 'block';
                });


                confirmNoButton.addEventListener('click', function () {
                  confirmationPopup.style.display = 'none';
                });

                confirmYesButton.addEventListener('click', function () {
                  confirmationPopup.style.display = 'none';
                  // successPopup.style.display = 'block';
                });

                // goToDashboardButton.addEventListener('click', function () {
                //   window.location.href = 'appointments_dashboard.html';
                // });

                document.getElementById("closePolicy").addEventListener("click", function () {
                  document.getElementById("policyPopup").style.display = "none";
                  confirmationPopup.style.display = 'block';

                });

                confirmYesButton.addEventListener('click', function() {
                  let addapp = document.getElementById("addapp");
                  let insertapp = document.getElementById("insertapp");

                  // Trigger the form submission
                  insertapp.click();
                })
              });

            </script>
          </div>
          <div class="prescriptionFiles">
            <div class="file">
              <div class="group">
                <div class="number">
                  <span class="number-sub-0">
                    NO.<br>
                    <?php echo $appointment->appointment_ID; ?>
                  </span>
                </div>
              </div>

              <div class="text">
                <div class="auto-group-oxxo-Sau">
                  <p>Time:
                    <?php echo $appointment->time; ?><br>Date:
                    <?php echo $appointment->date; ?><br>Patient:
                    <?php echo $appointment->patient_ID; ?><br>Doctor:
                    <?php echo $appointment->doctor_ID; ?><br>Payment Status:
                  </p>
                  <div class="auto-group-ppa1-jrq">
                    <p class="paid-fkV" style="color: red; font-weight: 800;">PAID</p>
                    <!-- <img class="checksquare-h4u" src="CheckSquare.png"/> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
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
  </div>
</body>

</html>