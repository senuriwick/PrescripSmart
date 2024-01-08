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

                <?php $appointment_ID = $_GET['referrence']; ?>

                <div class="menu">
                    <a href="new_appointment.html" id="appointments">New Appointment</a>
                </div>

                <div class="searchDiv">
                    <div id="confirmationOptions" class="confirmationOptions">
                        <div class="confirmationOptionsContent">
                            <h2>Appointment Scheduled</h2>
                            <p>Your appointment has been scheduled.</p>
                            <button id="viewAppointmentButton"
                                class="customConfirmationButton viewAppointmentButton">View Appointment</button>
                            <button id="payNowButton" class="customConfirmationButton payNowButton">Pay Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById("viewAppointmentButton").style.display = "block";
            document.getElementById("payNowButton").style.display = "block";
        });

        document.getElementById("viewAppointmentButton").addEventListener("click", function () {
            // Redirect to the specific appointment details page
            window.location.href = "view_appointment?appointment_id=<?php echo $appointment_ID; ?>";
            // window.location.href = 'view_appointment?appointment_id=' + <?php echo $appointment_ID; ?>;
        });

        document.getElementById("payNowButton").addEventListener("click", function () {
            // Add "Pay Now" action here
            alert("Pay Now");
        });
    </script>
</body>

</html>