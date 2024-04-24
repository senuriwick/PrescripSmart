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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/patient/appointment_complete.css" />
</head>

<body>

    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
        <?php include 'top_navigation_panel.php'; ?>

            <div class="adminInfoContainer">
            <?php include 'information_container.php'; ?>
            <div class="menu">
                    <a href="new_appointment.html" id="appointments">New Appointment</a>
                </div>

                <?php $appointment = $data['appointment']; ?>
                <?php $hash = $data['hash']?>
                <?php $patient = $data['patient']?>


                <div class="searchDiv">
                        <div id = "confirmation" class="confirmationOptionsContent">
                            <h1>Appointment Scheduled</h1>
                            <p>Your appointment has been scheduled.</p>
                            <div class = "buttons">
                            <button id="viewAppointmentButton"
                                class="customConfirmationButton viewAppointmentButton">View Appointment</button>
                            <button type ="submit" id="payhere-payment" class="customConfirmationButton payNowButton">Pay Now</button>
                            </div>
                        </div>
                        <div id = "successfulpayment" class = "success" style="display:none;">Payment Successful. Thank You!</div>
                        <button id="viewAppointmentButton2" style="display:none;" class="customConfirmationButton viewAppointmentButton2">View Appointment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById("viewAppointmentButton").style.display = "block";
            document.getElementById("payhere-payment").style.display = "block";
        });

        document.getElementById("viewAppointmentButton").addEventListener("click", function () {
            window.location.href = "view_appointment?appointment_id=<?php echo $appointment->appointment_ID; ?>";
        });

    </script>

  
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

<script>
    const successMessage = document.getElementById('successfulpayment');
    const confirmationMessage = document.getElementById('confirmation');
    const viewAppointment = document.getElementById('viewAppointmentButton2');

    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        confirmationMessage.style.display = 'none';
        successMessage.style.display = 'block';
        viewAppointment.style.display = 'block';

        updateDatabase(orderId);

        viewAppointment.addEventListener("click", function () {
            window.location.href = "view_appointment?appointment_id=<?php echo $appointment->appointment_ID; ?>";
        });
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