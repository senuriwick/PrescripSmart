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
    <!-- <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/sideMenu_navBar.css" /> -->
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>
        <!-- <div class="container"> -->
            
                <!-- <div class="navBar">
                    <img src="<?php echo URLROOT;?>/public/img/doctor/user.png" alt="user-icon">
                    <p><?php echo $_SESSION['USER_DATA']->username?></p>
                </div> -->
            
            <div class="main">
                <!-- <div class="main-Container"> -->
                <?php include 'top_navigation_panel.php'; ?>

                <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>

                    <div class="patientSearch">
                        <?php if($data['ongoingSession']&&$data['ongoingPatient']){?>
                        <div class="session-head">
                            <h1>Session No.#<?php echo $data['ongoingSession']->session_ID;?></h1>
                            <p>No. of patients left: <span class="countPatients"><?php echo $data['ongoingSession']->current_appointment-$data['ongoingPatient']->token_No;?></span></p>
                        </div>
                        <hr />
                        <div class="session-subhead"><b>On-going Appointment</b></div>
                        <div class="appoinment-details">
                            <div class="appoinment-number">
                                <span class="num-head">NO.</span><br>
                                <span class="num-main"><?php echo $data['ongoingPatient']->token_No;?></span>
                            </div>
                            <div class="patient-data">
                                <div>
                                    <b>Patient Name:  </b><?php echo $data['ongoingPatient']->display_Name;?> (#<?php echo $data['ongoingPatient']->patient_ID;?>)
                                </div>
                                <div class="btn-box">
                                    <button>VIEW PROFILE</button>
                                    <a href="<?php echo URLROOT;?>/doctor/addPrescription/<?php echo $data['ongoingPatient']->patient_ID;?>"><button>ADD PRESCRIPTION</button></a>
                                </div>
                            </div>
                        </div><?php }else{?>
                            <div class="session-subhead"><center>No on-going Session</center></div>
                            <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>