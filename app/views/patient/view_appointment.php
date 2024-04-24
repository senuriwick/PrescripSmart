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

        <?php $appointment_ID = $_GET['appointment_id']; ?>
        <?php $appointment = $data['appointment']; ?>
        <?php $hash = $data['hash']; ?>
        <?php $patient = $data['patient'] ?>
        <?php
        $date = new DateTime($appointment->date);
        $formatted_date = $date->format("D, jS M, Y");
        $time = date("h:i A", strtotime($appointment->time));
        ?>

        <div class="prescriptionsDiv">
          <div>
            <div class="section-header">
              <img src="<?php echo URLROOT; ?>\public\img\patient\back_arrow_icon.png" alt="back-icon" id="back">
              <h1>Appointment (#<?php echo $appointment->appointment_ID; ?>)
              </h1>
              <button id="cancelButton" class="buttonstyle">Cancel Appointment</button>
            </div>

            <div id="policyPopup" class="popup">
              <div class="popup-content">
                <h2>Cancellation Policy</h2>
                <p><span class="bold">1.1 Appointment Notification</span><br>If you cannot make your scheduled appointment, please inform the
                  Healthcare Establishment promptly.<br><br><span class="bold">1.2 
                  Rescheduling</span><br>If you need to reschedule, contact the Healthcare Establishment directly. They have
                  the sole discretion to approve rescheduling.
                  Rescheduling may incur an additional fee determined by the Healthcare Establishment.<br><br><span class="bold">1.3 Cancellation
                  by Medical Practitioner</span><br>If the medical practitioner cancels the appointment, the Healthcare
                  Establishment will:<br>
                  Provide a new appointment, or<br>Refund the Healthcare Establishment's fee and the medical
                  practitioner's fee, as per their rules and regulations.<br><br><span class="bold">1.4 Refund Policy</span><br>Refunds for rescheduled
                  or cancelled appointments are subject to the Healthcare Establishment's discretion and policies.
                </p>
                <button id="closePolicy" class="buttonstyle">Close</button>
              </div>
            </div>

            <div id="confirmationPopup" class="popup">
              <div class="popup-content">
                <p>Are you sure you want to cancel this appointment?</p>
                <button id="confirmYesButton" class="confirm yes">Yes</button>
                <button id="confirmNoButton" class="confirm no">No</button>
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
                const backIconContainer = document.getElementById('back');


                backIconContainer.addEventListener('click', function () {
                  window.history.back();
                  window.location.href = "<?php echo URLROOT?>/patient/appointments_dashboard"
                });

                cancelButton.addEventListener('click', function () {
                  policyPopup.style.display = 'block';
                });

                confirmNoButton.addEventListener('click', function () {
                  confirmationPopup.style.display = 'none';
                });

                confirmYesButton.addEventListener('click', function () {
                  confirmationPopup.style.display = 'none';
                });

                document.getElementById("closePolicy").addEventListener("click", function () {
                  document.getElementById("policyPopup").style.display = "none";
                  confirmationPopup.style.display = 'block';

                });

                confirmYesButton.addEventListener('click', function () {
                  let addapp = document.getElementById("addapp");
                  let insertapp = document.getElementById("insertapp");

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
                    <?php echo $appointment->token_No; ?>
                  </span>
                </div>
              </div>

              <div class="text">
                <div class="auto-group">
                  <p><span class="bold">Time:</span> <?php echo $time; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="bold">Date:</span> <?php echo $formatted_date; ?><br>
                    <span class="bold">Doctor:</span> Dr.<?php echo $appointment->first_Name; ?>
                    <?php echo $appointment->last_Name; ?><br>
                    <span class="bold">Payment Status:</span>
                  <div class="payment-status-box <?php echo strtolower($appointment->payment_status); ?>">
                    <p class="paid">
                      <?php echo $appointment->payment_status; ?>
                    </p>
                  </div>
                  <?php if ($appointment->payment_status == "UNPAID"):?>
                    <button type ="submit" id="payhere-payment" class = "paymentButton">Pay Now</button>
                    <?php endif ;?>
                  </p>
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


<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

<script>
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        updateDatabase(orderId);
        window.location.reload();
    };

    payhere.onDismissed = function onDismissed() {
        console.log("Payment dismissed");
    };

    payhere.onError = function onError(error) {
        console.log("Error:"  + error);
    };

    var payment = {
        "sandbox": true,
        "merchant_id": "1226371", 
        "return_url": "<?php echo URLROOT?>/patient/appointments_dashboard",   
        "cancel_url": "<?php echo URLROOT?>/patient/appointments_dashboard",  
        "notify_url": "<?php echo URLROOT?>/patient/notify_url",
        "order_id": "<?php echo $appointment->appointment_ID; ?>",
        "items": "New channeling appointment",
        "amount": "<?php echo $appointment->amount; ?>",
        "currency": "LKR",
        "hash": "<?php echo $hash?>",
        "first_name": "<?php echo $patient->first_Name ?>",
        "last_name": "<?php echo $patient->last_Name ?>",
        "email": "<?php echo $patient->email_address?>",
        "phone" : "<?php echo $patient->contact_Number?>",
        "address": "<?php echo $patient->home_Address?>",
        "city": "Colombo",
        "country": "Sri Lanka"
    };

    document.getElementById("payhere-payment").onclick = function (e) {
        payhere.startPayment(payment);
    };


    function updateDatabase(orderId) {
        var xhr = new XMLHttpRequest();

        xhr.open('POST', '<?php echo URLROOT?>/patient/update_payment', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    console.log('Database updated successfully');
                } else {
                    console.error('Error updating database');
                }
            }
        };
        xhr.send('orderId=' + encodeURIComponent(orderId));
    }

</script>

</body>

</html>