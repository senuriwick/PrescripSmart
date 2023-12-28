
<<<<<<< HEAD
    
<?php require APPROOT."/views/inc/header.php" ?>
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_dashboard.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
=======
<<<<<<<< HEAD:app/views/pharmacist/pharmacist_addNewMed.php
<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Pharmacist New Med</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_addNewMed.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
========
    
<?php require APPROOT."/views/inc/components/header.php" ?>
    <!-- <link rel="stylesheet" href="styles/pharmacist_dashboard.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_dashboard.css" />
    <!-- <link rel="stylesheet" href="styles/sideMenu&navBar.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/app/views/pharmacist/styles/sideMenu&navBar.css" />
>>>>>>>> 1ac9d80b1e93f046d19b28334bd38c87a6a2795a:app/views/pharmacist/pharmacist_dashboard.php
>>>>>>> 1ac9d80b1e93f046d19b28334bd38c87a6a2795a
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
<<<<<<< HEAD
                <img class="logoImg" src="<?php echo URLROOT?>/app/views/pharmacist/images/logo.png" />
=======
<<<<<<<< HEAD:app/views/pharmacist/pharmacist_addNewMed.php
                <img class="logoImg" src="<?php echo URLROOT?>/app/views/pharmacist/images/logo.png"/>
========
                <img class="logoImg" src="<?php echo URLROOT?>/app/views/pharmacist/images/logo.png" />
>>>>>>>> 1ac9d80b1e93f046d19b28334bd38c87a6a2795a:app/views/pharmacist/pharmacist_dashboard.php
>>>>>>> 1ac9d80b1e93f046d19b28334bd38c87a6a2795a
            </div>

            <div class="userDiv">
                <p class="mainOptions">
                    <Datag>PHARMACIST</Datag>
                </p>
            </div>
<<<<<<< HEAD
            
            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="" class="active">Patients</a>
                <a href="<?php echo URLROOT ?>/Pharmacist/medications">Medications</a>
=======

            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="<?php echo URLROOT; ?>/Pharmacist/dashboard">Patients</a>
                <a href="">Medications</a>
>>>>>>> 1ac9d80b1e93f046d19b28334bd38c87a6a2795a
                <a href="<?php echo URLROOT ?>/Pharmacist/profile">Profile</a>
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
                    <img src="<?php echo URLROOT?>/app/views/pharmacist/images/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT?>/app/views/pharmacist/images/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Patient Name</p>
                            <p class="role">Patient</p>
                        </div>
                    </div>

                    <div class="menu">
<<<<<<< HEAD
                        <p style="color:black">Patients</p>
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/medications">Medications</a></p>
                    </div>
                    <hr class="divider">
                    <div class="prescriptionsDiv">
                        <h2>Search Patient</h2>
                        <input type="text" id="searchBar" name="search" placeholder="Enter patient's name or ID" class="inputfield">
                        <a href=""><button id="searchButton">SEARCH</button></a>
                    </div>
=======
                    <p><a href="<?php echo URLROOT; ?>/Pharmacist/dashboard">Patients</a></p>
                        <p><a href="reports.html" style="color: black; font-weight: 500;">Medications</a></p>
                    </div>
                    <hr>
                    <div class="prescriptionsDiv">
                        <h2>Search Medication</h2>
                        <input type="text" id="searchBar" name="search" placeholder="Enter medication name/Id" class="inputfield">
                        <a href=""><button id="searchButton">SEARCH</button></a>
                    </div>
<<<<<<<< HEAD:app/views/pharmacist/pharmacist_addNewMed.php
                    <div class="center-content">
                        <p class="grey-text">Sorry, Not Found</p>
                    </div>
                    <hr class="divider">
                    <a href="pharmacist_newMed.html"><button id="newButton">ADD NEW MEDICATION</button></a>
========
>>>>>>> 1ac9d80b1e93f046d19b28334bd38c87a6a2795a
                    <hr class="divider">
                    <?php foreach($data['patients'] as $patient): ?>
                    <div class="patientFile">
                        <div class="fileInfo">
                            <img class="person-circle" src="<?php echo URLROOT?>/app/views/pharmacist/images/personcircle.png" alt="patient-pic">
                            <p><?php echo $patient->name; ?></p>
                        </div>
                        <p id="patientId">Patient ID <span><?php echo $patient->id; ?></span></p>
                        <a href="pharmacist_prescription.html" id="viewButton"><button>View Prescriptions</button></a>
                    </div>
                    <?php endforeach; ?>
                    
<<<<<<< HEAD
=======
>>>>>>>> 1ac9d80b1e93f046d19b28334bd38c87a6a2795a:app/views/pharmacist/pharmacist_dashboard.php
>>>>>>> 1ac9d80b1e93f046d19b28334bd38c87a6a2795a
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
<?php require APPROOT."/views/inc/footer.php" ?>
=======
<?php require APPROOT."/views/inc/components/footer.php" ?>
>>>>>>> 1ac9d80b1e93f046d19b28334bd38c87a6a2795a
 