<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Add Prescription</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../public/css/doctor/add_prescription.css" />
    <link rel="stylesheet" href="../public/css/doctor/sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="../public/img/doctor/Untitled design (5) copy 2.png" />
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

                <a href="<?php echo URLROOT;?>/doctorPatients/patients" class="active">Patients</a>
                <a href="on-going_session.html">Ongoing Sessions</a>
                <a href="<?php echo URLROOT;?>/doctorPatients/sessions">Sessions</a>
                <a href="profile.html">Profile</a>
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
                    <img src="../public/img/doctor/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="../public/img/doctor/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Patient Name</p>
                            <p class="role">Patient</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT; ?>/doctorPatients/viewPrescriptions">Prescription</a></p>
                        <p><a href="<?php echo URLROOT;?>/doctorPatients/viewReports">Reports</a></p>
                    </div>

                    <div class="patientSearch">
                        <div class="topic">
                            <i class="fa-solid fa-arrow-left"></i>
                            <label>Patient Prescription</label>
                        </div>
                        <hr />
                        <div class="diagnosis">
                            <form>
                                <label><b>Diagnosis</b></label>
                                <input type="textbox" class="searchBar" placeholder="Enter diagnosis here....." />
                            </form>
                        </div>

                        <div class="medication">
                            <div class="medication-head">
                                <lable><b>+ Medication</b></lable>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="medication-form">
                                <form>
                                    <input type="text" class="search-medication"
                                        placeholder="Search medication name here" />
                                    <hr />
                                    <div class="medication-suggetions">
                                        <p>Medication Suggetion 01</p>
                                        <button>Add</button>
                                    </div>
                                    <div class="medication-suggetions">
                                        <p>Medication Suggetion 02</p>
                                        <button>Add</button>
                                    </div>
                                </form>
                                <hr />
                                <div class="medication-added">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Medication Added 1</td>
                                                <td>Dosage</td>
                                                <td>Remarks</td>
                                                <td class="medication-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Medication Added 1</td>
                                                <td>Dosage</td>
                                                <td>Remarks</td>
                                                <td class="medication-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Medication Added 1</td>
                                                <td>Dosage</td>
                                                <td>Remarks</td>
                                                <td class="medication-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <div class="test">
                            <div class="test-head">
                                <lable><b>+ Add Lab Sessions</b></lable>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="test-form">
                                <form>
                                    <input type="text" class="search-test"
                                        placeholder="Search test name here" />
                                    <hr />
                                    <div class="test-suggetions">
                                        <p>Test Suggetion 01</p>
                                        <button>Add</button>
                                    </div>
                                    <div class="test-suggetions">
                                        <p>Test Suggetion 02</p>
                                        <button>Add</button>
                                    </div>
                                </form>
                                <hr />
                                <div class="test-added">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Test Added 1</td>
                                                <td>Remarks</td>
                                                <td class="test-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Test Added 1</td>
                                                <td>Remarks</td>
                                                <td class="test-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Test Added 1</td>
                                                <td>Remarks</td>
                                                <td class="test-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <div class="save-Btn">
                            <button>Save And Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>