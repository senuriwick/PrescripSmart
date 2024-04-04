<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Sessions</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\nurse\sessions.css" />
</head>

<body>
<pre><?=print_r($_SESSION)?></pre>

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

            <div class="adminInfoContainer">
                <div class="adminInfo">
                    <img src="<?php echo URLROOT ?>\public\img\nurse\profile.png" alt="profile-pic">
                    <div class="patientNameDivDiv">
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

                <?php $sessions = $data['sessions']; ?>

                <?php if (!empty($sessions)): ?>
                    <div>
                        <p style="font-size: medium; color: gray;">You have been assigned to the following sessions.</p>
                    </div>

                    <?php
                    // Group sessions by doctor
                    $sessionsByDoctor = [];
                    foreach ($sessions as $session) {
                        $doctorName = $session->doctorName; // Accessing object property
                        if (!isset($sessionsByDoctor[$doctorName])) {
                            $sessionsByDoctor[$doctorName] = [];
                        }
                        $sessionsByDoctor[$doctorName][] = $session;
                    }
                    ?>

                    <?php foreach ($sessionsByDoctor as $doctorName => $doctorSessions): ?>
                        <div class="searchDiv">
                            <h1 style="font-size: 24px; color: #0069FF;">Dr.
                                <?php echo $doctorName; ?>
                            </h1>
                            <!-- <p style="line-height: 0.4;"><?php echo $sessions[0]->$specialization ?></p> -->
                            <div class="line1"></div>

                            <?php foreach ($doctorSessions as $session): ?>
                                <div class="boxes-container">
                                    <div class="box1">
                                        <p class="sessionname">Session #<?php echo $session->session_ID; ?></p>
                                        <p class="text">
                                            Date:
                                            <?php echo $session->sessionDate; ?>
                                            <br />
                                            Time:
                                            <?php echo $session->start_time ?> -
                                            <?php echo $session->end_time ?>
                                        </p>
                                        <div class="line2"></div>
                                        <button type="button" class="rectangle-70-mtM">ROOM
                                            <?php echo $session->room_no; ?>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <div>
                        <p style="font-size: medium; color: gray;">No sessions found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>