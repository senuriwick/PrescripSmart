<?php require APPROOT."/views/inc/header.php" ?>
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_allMedications.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT?>/app/views/pharmacist/images/logo.png" />
            </div>

            <div class="userDiv">
                <p class="mainOptions">
                    <Datag>PHARMACIST</Datag>
                </p>
            </div>
            
            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="<?php echo URLROOT ?>/Pharmacist/dashboard" class="active">Patients</a>
                <a href="">Medications</a>
                <a href="<?php echo URLROOT ?>/Pharmacist/profile">Profile</a>
            </div>
            <div class="othersDiv">
                <a href="http://">Billing</a>
                <a href="http://">Terms of Services</a>
                <a href="http://">Privacy Policy</a>
                <a href="http://">Settings</a>
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
                        <p><a href="<?php echo URLROOT; ?>/Pharmacist/dashboard">Patients</a></p>
                        <p><a href="" style="font-weight: 500;color: black;">Medications</a></p>
                    </div>
                    <hr class="divider">
                    <div class="prescriptionsDiv">
                        <h2 class="heading">Search Patient</h2>
                        <input type="text" id="searchBar" name="search" placeholder="Enter patient's name or ID" class="inputfield">
                        <a href="<?php echo URLROOT; ?>/Pharmacist/pharmacistMedication"><button id="searchButton">SEARCH</button></a>
                    </div>
                    <hr class="divider">
                    <div class="allMed">
                        <h3 class="heading">Inventory(1458)</h3>
                      
                        <?php foreach($data['medications'] as $medication): ?>
                        <div class="patientFile">
                            
                            <p class="id"><?php echo $medication->batch_number; ?></p>
                            <p><?php echo $medication->name; ?></p>
                            <p id="patientId"><?php echo $medication->dosage; ?></p>
                            <!-- <a href="<?php echo URLROOT ?>/Pharmacist/oneMedDetails" id="viewButton"><button>Manage</button></a> -->
                            <a href="<?php echo URLROOT ?>/Pharmacist/oneMedDetails?batch_number=<?php echo $medication->batch_number; ?>&name=<?php echo $medication->name; ?>&dosage=<?php echo $medication->dosage; ?>&id=<?php echo $medication->id; ?>&expiry_date=<?php echo $medication->expiry_date; ?>&quantity=<?php echo $medication->quantity; ?>&status=<?php echo $medication->status; ?>" id="viewButton"><button>Manage</button></a>
                        </div>
                        <?php endforeach; ?>
                        <!-- <div class="patientFile">
                            
                            <p class="id">#1245866</p>
                            <p>Medication Name Here</p>
                            <p id="patientId">A description Here</p>
                            <a href="pharmacist_oneMedDetails.html" id="viewButton"><button>Manage</button></a>
                        </div>
                        <div class="patientFile">
                            
                            <p class="id">#1245866</p>
                            <p>Medication Name Here</p>
                            <p id="patientId">A description Here</p>
                            <a href="pharmacist_oneMedDetails.html" id="viewButton"><button>Manage</button></a>
                        </div>
                        <div class="patientFile">
                            
                            <p class="id">#1245866</p>
                            <p>Medication Name Here</p>
                            <p id="patientId">A description Here</p>
                            <a href="pharmacist_oneMedDetails.html" id="viewButton"><button>Manage</button></a>
                        </div> -->
        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT."/views/inc/footer.php" ?>