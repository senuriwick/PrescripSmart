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
    <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\nurse\appointments_2.css" />
</head>

<body>

    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT ?>\public\img\nurse\Untitled design (5) copy 2.png" />
            </div>

            <!-- <div class="patientDiv">
                <p class="mainOptions">NURSE</p>

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
                    <div>
                        <div class="section-header">
                            <h1>Appointment (#214568)</h1>
                        </div>


                    </div>
                    <div class="prescriptionFiles">
                        <?php $appointment = $data['appointment']; ?>
                        <?php $doctor = $data['doctor']; ?>
                        <?php $patient = $data['patient'] ?>
                        <div class="file">
                            <div class="group">
                                <div class="number">
                                    <span class="number-sub-0">
                                        NO.<br>
                                        <?php echo $appointment->appointment_No ?>
                                    </span>
                                </div>
                            </div>

                            <div class="text">
                                <div class="auto-group-oxxo-Sau">
                                    <p>
                                        Time:
                                        <?php echo $appointment->time ?><br>
                                        Date:
                                        <?php echo $appointment->date ?><br>
                                        Patient:
                                        <?php echo ($patient->gender == 'male') ? 'Mr.' : 'Ms.' ?>
                                        <?php echo $patient->display_Name ?><br>
                                        Doctor: Dr.
                                        <?php echo $doctor->fName ?>
                                        <?php echo $doctor->lName ?><br>
                                        Payment Status:
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


            </div>
        </div>
    </div>
    </div>