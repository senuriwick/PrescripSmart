<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>On-going Session</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/on-going_session.css" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/sideMenu_navBar.css" />
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT;?>/public/img/doctor/Untitled design (5) copy 2.png" />
            </div>

            <!-- <div class="userDiv">
                <p class="mainOptions">
                    <Datag>DOCTOR</Datag>
                </p>

                <div class="profile">
                    <p>username</p>
                </div>
            </div> -->


            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="<?php echo URLROOT;?>/doctor/patients" class="active">Patients</a>
                <a href="<?php echo URLROOT;?>/doctor/viewOngoingSession">Ongoing Sessions</a>
                <a href="<?php echo URLROOT;?>/doctor/sessions">Sessions</a>
                <a href="<?php echo URLROOT;?>/doctor/profile">Profile</a>
            </div>
            <div class="othersDiv">
                <p class="sideMenuTexts">Billing</p>
                <p class="sideMenuTexts">Terms of Services</p>
                <p class="sideMenuTexts">Privacy Policy</p>
                <p class="sideMenuTexts">Settings</p>
            </div>

        </div>
        <div class="container">
            <div class="navBar">
                <div class="navBar">
                    <img src="<?php echo URLROOT;?>/public/img/doctor/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT;?>/public/img/doctor/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Doctor Name</p>
                            <p class="role">Doctor</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT;?>/doctor/patients">Patients</a></p>
                        <p><a href="<?php echo URLROOT;?>/doctor/viewOngoingSession">On-going</a></p>
                        <p><a href="<?php echo URLROOT;?>/doctor/sessions">Sessions</a></p>
                    </div>

                    <div class="patientSearch">
                        <div class="session-head">
                            <h1>Session No.#1255</h1>
                            <p>No. of patients left: <span class="countPatients">04</span></p>
                        </div>
                        <hr />
                        <div class="session-subhead"><b>On-going Appointment</b></div>
                        <div class="appoinment-details">
                            <div class="appoinment-number">
                                <span class="num-head">NO.</span><br>
                                <span class="num-main">12</span>
                            </div>
                            <div class="patient-data">
                                <div>
                                    <b>Patient Name:  </b>Dananjaya de Silva(#1233458)
                                </div>
                                <div class="btn-box">
                                    <button>VIEW PROFILE</button>
                                    <button>ADD PRESCRIPTION</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>