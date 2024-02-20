<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Reports</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/prescriptions.css" />
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
                            <p class="name"><?php echo $data['patient']->patient_name;?></p>
                            <p class="role">Patient</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT;?>/doctor/viewPrescriptions/<?php echo $data['patient']->patient_id;?>">Prescription</a></p>
                        <p><a href="<?php echo URLROOT;?>/doctor/viewReports/<?php echo $data['patient']->patient_id;?>">Reports</a></p>
                    </div>

                    <div class="patientSearch">
                        <div class="topic">
                            <label>Reports(<?php echo $data['reportsCount'];?>)</label>
                        </div>
                        <div class="prescription-table">
                            <table>
                                <tbody>
                                    <?php foreach($data['reportsData'] as $reportData): ?>
                                    <tr class="clickable-row1">
                                        <td>
                                            <div class="presDiv">
                                                <img src="<?php echo URLROOT;?>/public/img/doctor/description.png" alt="download-icon">
                                                <p><?php echo $reportData->report_descript; ?></p>
                                            </div>
                                        </td>
                                        <td><?php echo $reportData->doctor_name; ?></td>
                                        <td></td>
                                    </tr>
                                    <?php endforeach; ?>    
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal-1" class="modal">
        <div class="modal-content">
            <span class="close1">&times;</span>
            <a href="www.prescripsmart.com">www.prescripsmart.com</a>
            <div class="model-head">
                <img src="<?php echo URLROOT;?>/public/img/doctor/qr.png" alt="qr-img" />
                <h4><u>CONFIDENTIAL LAB REPORT</u></h4>
                <i class="fa-solid fa-circle-arrow-up"></i>
            </div>
            <div class="model-details">
                <div>Prescription ID: #12345</div>
                <div>Patient: S.Perera</div>
                <div>Pres Date & Time: 12/09/23 10:00 AM</div>
                <div>Age: 22 Yrs</div>
                <div>Referred by: Dr.Asanka Rathnayake</div>
            </div>
            <div class="test-box">
                <table>
                    <tbody>
                        <tr>
                            <td>TEST</td>
                            <td>RESULT</td>
                            <td>FLAG REFERENCE VALUE</td>
                        </tr>
                        <tr>
                            <td>Test 1</td>
                            <td>Result 1</td>
                            <td>Value 1</td>
                        </tr>
                        <tr>
                            <td>Test 2</td>
                            <td>Result 2</td>
                            <td>Value 2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pres-box">
                <label>Other Comments...</label>
                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </div>
            </div>
            <div class="notice">(For viewing purpose only)</div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rows1 = document.querySelectorAll("tr.clickable-row1");
            const modal1 = document.getElementById("myModal-1");
            const closeButton1 = modal1.querySelector(".close1");

            rows1.forEach(row => {
                row.addEventListener("click", () => {
                    modal1.style.display = "block";
                });
            });

            closeButton1.addEventListener("click", () => {
                modal1.style.display = "none";
            });

            window.addEventListener("click", (event) => {
                if (event.target === modal1) {
                    modal1.style.display = "none";
                }
            });
        });
    </script>
</body>