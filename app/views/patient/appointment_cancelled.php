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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/patient/appointment_cancelled.css" />
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
                        <div id="successPopup">
                            <div>
                                <p>Your appointment has been cancelled.</p>
                                <button id="goToDashboardButton" class="cancelbutton">Go back to dashboard</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const successPopup = document.getElementById('successPopup');

            const goToDashboardButton = document.getElementById('goToDashboardButton');

            goToDashboardButton.addEventListener('click', function () {
                successPopup.style.display = "block";
                window.location.href = "appointments_dashboard";
            });
        });
    </script>

</body>

</html>