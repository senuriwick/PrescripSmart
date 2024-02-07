<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>On-going Appointments</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\nurse\appointments.css" />
</head>

<body>

    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT ?>\public\img\nurse\Untitled design (5) copy 2.png" />
            </div>

            <!-- <div class="patientDiv">
                <p class="mainOptions">PATIENT</p>

                <div class="profile">
                    <p>username</p>
                </div>
            </div> -->


            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="patients_dashboard.html" id="patients">Patients</a>
                <a href="ongoing.html" id="On-going">On-going session</a>
                <a href="sessions.html" id="sessions">Sessions</a>
                <a href="appointments.html" id="appointments">Appoinments</a>
                <a href="profile.html" id="profile">Profile</a>
            </div>


            <div class="othersDiv">
                <a href="billing.html" id="billing">Billing</a>
                <a href="terms_of_service.html" id="terms">Terms of Service</a>
                <a href="privacy_policy.html" id="privacy">Privacy Policy</a>
            </div>

        </div>

        <div class="main">
            <div class="navBar">
                <img src="<?php echo URLROOT ?>\public\img\nurse\user.png" alt="user-icon">
                <p>SAMPLE USERNAME HERE</p>
            </div>

            <div class="patientInfoContainer">
                <div class="patientInfo">
                    <img src="<?php echo URLROOT ?>\public\img\nurse\profile.png" alt="profile-pic">
                    <div class="patientNameDiv">
                        <p class="name">Nurse Name</p>
                        <p class="role">Nurse</p>
                    </div>
                </div>

                <div class="menu">
                    <a href="patients_dashboard.html" id="patients">Patients</a>
                    <a href="ongoing.html" id="On-going">On-going session</a>
                    <a href="sessions.html" id="sessions">Sessions</a>
                    <a href="appointments.html" id="appointments">Appoinments</a>
                </div>

                <div class="prescriptionsDiv">
                    <?php if (empty($data['session'])): ?>
                        <p>You currenly have no on-going sessions. Thank you!</p>
                    <?php else: ?>
                        <?php $session = $data['session']; ?>
                        <?php $doctor = $data['doctor']; ?>
                        <h1>Appointments (Current Session) #
                            <?php echo $session->session_ID ?>
                        </h1>
                        <p>DR.
                            <?php echo $session->doctorName ?><br>
                            <?php echo $doctor->specialization ?><br>
                            Room 04
                        </p>

                        <?php if (empty($data['appointments'])): ?>
                            <p>No appointments found</p>
                        <?php else: ?>
                            <?php foreach ($data['appointments'] as $appointment): ?>
                                <div class="prescriptionFiles">
                                    <div class="file" onclick="redirectToAppointment(<?php echo $appointment->appointment_ID ?>)">
                                        <div class="desDiv">
                                            <p class="description">Time:
                                                <?php echo $appointment->time ?>
                                            </p>
                                        </div>
                                        <p>Appointment Ref No.
                                            <?php echo $appointment->appointment_ID ?>
                                        </p>
                                        <p>Appointment No:
                                            <?php echo $appointment->appointment_No ?>
                                        </p>
                                        <p>
                                            <?php echo ($appointment->gender == 'male') ? 'Mr.' : 'Ms.' ?>
                                            <?php echo $appointment->display_Name ?>
                                        </p>
                                        <input type="checkbox" id="tickBox">
                                        <label for="tickBox"></label>
                                    </div>
                                </div>
                                <script>
                                    function redirectToAppointment(appointmentID) {
                                        window.location.href = "<?php echo URLROOT ?>/nurse/appointment_view?reference=" + appointmentID;
                                    }
                                </script>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>