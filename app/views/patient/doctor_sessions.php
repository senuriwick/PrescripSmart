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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\patient\new_appointment_2.css" />
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

                <div>
                    <?php $doctor_ID = $_GET['doctor_ID']; ?>
                    <?php $session = $data['session']; ?>

                    <?php
                    $doctorname = '';
                    $doctorspec = '';

                    if (!empty($data['session'])) {
                        $doctorname = $data['session'][0]->doctorName;
                        $doctorspec = $data['session'][0]->specialization;
                    }
                    ?>
                    <!-- <p style="font-size: small; color: gray;">Search Results (1)<br>Dr.
                        <?php echo $doctorname; ?>
                    </p> -->

                    <?php if (!empty($data['session'])): ?>
                        <p style="font-size: small; color: gray;">Search Results (1)<br>Dr.
                            <?php echo $doctorname; ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="searchDiv">
                    <?php if (!empty($data['session'])): ?>
                        <h1 style="font-size: 24px; color:  #0069FF;">DR.
                            <?php echo $doctorname; ?>
                        </h1>
                        <p style="line-height: 0.4;">
                            <?php echo $doctorspec; ?>
                        </p>
                        <div class="line1"></div>
                    <?php endif; ?>

                    <div class="boxes-container">

                        <?php
                        if (!empty($data['session'])) {
                            foreach ($data['session'] as $session): ?>
                                <div class="box1">
                                    <p class="sessionname">Session #
                                        <?php echo $session->session_ID; ?>
                                    </p>
                                    <p class="text">
                                        Date:
                                        <?php echo $session->sessionDate; ?>
                                        <br />
                                        Time:
                                        <?php echo $session->time; ?>
                                        <br />
                                        Appointment No:
                                        <?php echo $session->current_appointment; ?>
                                    </p>
                                    <div class="line2"></div>
                                    <button type="button" class="rectangle-70-mtM"
                                        onclick="bookNow(<?php echo $session->session_ID; ?>)">
                                        BOOK NOW
                                    </button>


                                    <script>
                                        function bookNow(sessionID) {
                                            var confirmationURL = "<?php echo URLROOT; ?>/patient/appointment_confirmation";
                                            confirmationURL += "?sessionID=" + encodeURIComponent(sessionID);

                                            window.location.href = confirmationURL;
                                        }
                                    </script>


                                </div>
                            <?php endforeach;
                        } else {
                            echo "No sessions found";
                        } ?>

                    </div>

                </div>
            </div>
        </div>
    </div>


</body>

</html>