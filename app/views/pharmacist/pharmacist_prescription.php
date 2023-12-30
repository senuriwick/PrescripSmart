<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Pharmacist Prescription</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_prescription.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
    <div id="dim-overlay"></div>
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

                <a href="<?php echo URLROOT; ?>/Pharmacist/dashboard">Patients</a>
                <a href="">Medications</a>
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
                    <p style="color:black">Patients</p>
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/medications">Medications</a></p>
                    </div>
                    
                    <div class="patientSearch">
                        <div class="patient-div">
                            <a href="pharmacist_dashboard.html">
                                <img
                                  class="vector"
                                  src="<?php echo URLROOT?>/app/views/pharmacist/images/vector.png"
                                  alt="Sample Image"
                                />
                            </a>
                            <img class="person-circle" src="<?php echo URLROOT?>/app/views/pharmacist/images/personcircle.png" alt="patient-pic">
                            <div class="patient-desc">
                                <p>Sheneya Perera</p>
                                <p>Patient Id 12345</p>
                                <p>22 Years</p>
                            </div>
                        </div>
                        <div class="topic">
                            <label>Prescriptions(4)</label>
                        </div>
                        <div class="prescription-table">
                            <table>
                                <tbody>
                                    <tr class="">   
                                        <td>
                                            <div class="presDiv" onclick="openPopup()">
                                                <img src="<?php echo URLROOT?>/app/views/pharmacist/images/description.png" alt="download-icon">
                                                <p>Pres. Description</p>
                                            </div>
                                        </td>
                                        <td>Dr.Doctor Name</td>
                                        <td>DD-MM-YYYY</td>
                                    </tr>
                                    <tr class="clickable-row">
                                        <td>
                                            <div class="presDiv" onclick="openPopup()">
                                                <img src="<?php echo URLROOT?>/app/views/pharmacist/images/description.png" alt="download-icon">
                                                <p>Pres. Description</p>
                                            </div>
                                        </td>
                                        <td>Dr.Doctor Name</td>
                                        <td>DD-MM-YYYY</td>
                                    </tr>
                                    <tr class="clickable-row">
                                        <td>
                                            <div class="presDiv" onclick="openPopup()">
                                                <img src="<?php echo URLROOT?>/app/views/pharmacist/images/description.png" alt="download-icon">
                                                <p>Pres. Description</p>
                                            </div>
                                        </td>
                                        <td>Dr.Doctor Name</td>
                                        <td>DD-MM-YYYY</td>
                                    </tr>
                                    <tr class="clickable-row">
                                        <td>
                                            <div class="presDiv" onclick="openPopup()">
                                                <img src="<?php echo URLROOT?>/app/views/pharmacist/images/description.png" alt="download-icon">
                                                <p>Pres. Description</p>
                                            </div>  
                                        </td>
                                        <td>Dr.Doctor Name</td>
                                        <td>DD-MM-YYYY</td>
                                    </tr>

                                    </a>
                                </tbody>
                            </table>
                            <div id="popup">
                                <div class="grid-container">
                                    <img id="qr" src="images/qr-code.png" alt="">
                                
                                    <h2>CONFIDENTIAL PRESCRIPTION</h2>
                                    <img onclick="closePopup()" class="close" src="images/close-button.png" alt="">
                            
                                    
                                </div>
                                <div class="grid-container">
                                    <p>Reception ID: <span>#2155675</span></p>
                                    <p class="patient">patient: <span>Ms. S Perera</span></p>
                                </div>
                                <div class="grid-container">
                                    <p>Pres. Date & Time: <span>10.20A.M 12/09/23 </span></p>
                                    <p id="age">Age: <span>22</span>Yrs</p>
                                </div>
                                <div class="grid-container">
                                    <p>Referred by: Dr.<span>Asanka Rathnayke</span></p>
                                </div>
                                <div class="diagnosis">
                                    <p>Diagnosis</p>
                                </div>
                                <div class="diagnosis">
                                    <p>Medication</p>
                                    <div class="med">
                                        <div>
                                            <p>Name</p>
                                            <p>Dosage</p>
                                            <p>Remarks</p>
                                        </div>
                                        <div>
                                            <p>Name</p>
                                            <p>Dosage</p>
                                            <p>Remarks</p>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="diagnosis">
                                    <p>Lab Tests</p>
                                    <div class="med">
                                        <div class="lab">
                                            <p>Name</p>
                                            <p>Remarks</p>
                                        </div>
                                    </div>
                                    
                                </div>
                                <p>
                                    (For view purposes only)
                                </p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="javascripts/pharmcist_prescription.js"></script>
</body>
</html>
