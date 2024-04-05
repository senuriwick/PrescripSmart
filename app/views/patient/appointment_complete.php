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
    <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/doctor/sideMenu&navBar.css" /> -->
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

                <?php $appointment = $data['appointment']; ?>
                <?php $hash = $data['hash']?>
                <?php $patient = $data['patient']?>

                <div class="menu">
                    <a href="new_appointment.html" id="appointments">New Appointment</a>
                </div>

                <div class="searchDiv">
                        <div id = "confirmation" class="confirmationOptionsContent">
                            <h2>Appointment Scheduled</h2>
                            <p>Your appointment has been scheduled.</p>
                            <button id="viewAppointmentButton"
                                class="customConfirmationButton viewAppointmentButton">View Appointment</button>
                            <button type ="submit" id="payhere-payment" class="customConfirmationButton payNowButton">Pay Now</button>
                        </div>
                        <div id = "successfulpayment" style="display:none; color: #0069ff;">Payment Successful. Thank You!</div>
                        <button id="viewAppointmentButton2" style="display:none;" class="customConfirmationButton viewAppointmentButton">View Appointment</button>
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

        //update payment status
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
        // "amount": "<?php echo $appointment->amount; ?>",
        "amount" : "1000",
        "currency": "LKR",
        "hash": "<?php echo $hash?>",
        // "first_name": "<?php $_SESSION['USER_DATA']->first_Name ?>",
        "first_name": "Masha",
        "last_name": "Wickramasinghe",
        // "last_name": "<?php $_SESSION['USER_DATA']->last_Name ?>",
        "email": "<?php echo $patient->email_address?>",
        "phone" : "<?php echo $patient->contact_Number?>",
        "address": "<?php echo $patient->home_Address?>",
        "city": "Colombo",
        "country": "Sri Lanka"
        // "custom_2": ""
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