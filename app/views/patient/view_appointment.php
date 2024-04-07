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
              <form action="<?php echo URLROOT; ?>/Patient/delete_appointment/<?= $appointment_ID ?>" method="POST"
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

                confirmYesButton.addEventListener('click', function () {
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
                    <p class="paid-fkV" style="color: red; font-weight: 800;">
                      <?php echo $appointment->payment_status ?>
                    </p>
                    <!-- <img class="checksquare-h4u" src="CheckSquare.png"/> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php include 'add_new_container.php'; ?>
      </div>
    </div>
  </div>
  </div>
</body>
</html>