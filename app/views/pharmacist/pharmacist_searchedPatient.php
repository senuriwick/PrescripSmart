
<?php require APPROOT."/views/inc/components/header.php" ?>
    <!-- <link rel="stylesheet" href="styles/pharmacist_dashboard.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_dashboard.css" />
    <!-- <link rel="stylesheet" href="styles/sideMenu&navBar.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />

    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
        <div class="logoDiv">
            <div>P</div>
            <h5>PrescripSmart</h5>
        </div>

            <div class="manageDiv">
                <p class="mainOptions">Pharmacist Tools</p>

                <a href="#">Patients</a>
                <a href="<?php echo URLROOT; ?>/Pharmacist/medications">Medications</a>
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
                            <p class="name">Pharmacist Name</p>
                            <p class="role">Pharmacist</p>
                        </div>
                    </div>

                    <div class="menu">

                        <p style="color:black">Patients</p>
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/medications">Medications</a></p>
                    </div>
                    <hr class="divider">
                    <div class="prescriptionsDiv">
                        <h2>Search Patient</h2>
                        <form method="post" action="<?php echo URLROOT; ?>/Pharmacist/searchPatient">
                            <input type="text" id="search" name="search" placeholder="Enter medicine name" class="inputfield">
                            <button type="submit" id="searchButton">SEARCH</button>
                        </form>
                    </div>
                    <hr class="divider">  

                    <?php foreach($data['patients'] as $patient): ?>
                        <div class="patientFile">
                            <div class="fileInfo">
                                <img class="person-circle" src="<?php echo URLROOT?>/app/views/pharmacist/images/personcircle.png" alt="patient-pic">
                                <p><?php echo $patient->name; ?></p>
                            </div>
                            <p id="patientId">Patient ID <span><?php echo $patient->id; ?></span></p>
                            <a href="<?php echo URLROOT ?>/Pharmacist/allPrescriptions?patient_id=<?php echo $patient->id; ?>" id="viewButton"><button>View Prescriptions</button></a>
                        </div>
                    <?php endforeach; ?>
        </div>

                    
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT."/views/inc/components/footer.php" ?>
 