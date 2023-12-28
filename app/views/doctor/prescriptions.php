<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Prescriptions</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../public/css/doctor/prescriptions.css" />
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

                <a href="patients.html" class="active">Patients</a>
                <a href="on-going_session.html">Ongoing Sessions</a>
                <a href="sessions.html">Sessions</a>
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
                        <p><a href="prescriptions.html">Prescription</a></p>
                        <p><a href="reports.html">Reports</a></p>
                    </div>

                    <div class="patientSearch">
                        <div class="topic">
                            <label>Prescriptions(<?php echo $data['prescriptionsCount']; ?>)</label>
                        </div>
                        <div class="prescription-table">
                            <table>
                                <tbody>
                                    <?php foreach($data['prescriptionsData'] as $prescriptionData): ?>
                                    <tr class="clickable-row">
                                        <td>
                                            <div class="presDiv">
                                                <img src="../public/img/doctor/description.png" alt="download-icon">
                                                <p><?php echo $prescriptionData->pres_descript;?></p>
                                            </div>
                                        </td>
                                        <td><?php echo $prescriptionData->doctor_name; ?></td>
                                        <td><?php echo $prescriptionData->date; ?></td>
                                    </tr>
                                    <?php endforeach;?>
                                    <tr>
                                        <td colspan="3" class="td-cols">
                                            <a href="<?php echo URLROOT;?>/doctorPatients/addPrescription">+ Add Prescription</a>
                                        </td>
                                    </tr>

                                    </a>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <a href="www.prescripsamert.com">www.prescripsamert.com</a>
            <div class="model-head">
                <img src="qr.png" alt="qr-img" />
                <h4><u>CONFIDENTIAL PRESCRIPTION</u></h4>
                <i class="fa-solid fa-circle-arrow-up"></i>
            </div>
            <div class="model-details">
                <div>Prescription ID: #12345</div>
                <div>Patient: S.Perera</div>
                <div>Pres Date & Time: 12/09/23 10:00 AM</div>
                <div>Age: 22 Yrs</div>
                <div>Reffered by: Dr.Asanka Rathnayake</div>
            </div>
            <div class="pres-box">
                <label>Diagnosis</label>
                <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </div>
            </div>
            <div class="pres-box">
                <label>Medication</label>
                <table>
                    <tbody>
                        <tr>
                            <td>Med name</td>
                            <td>Dosage</td>
                            <td>Remarks</td>
                        </tr>
                        <tr>
                            <td>Med Name</td>
                            <td>Dosage</td>
                            <td>Remarks</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="pres-box">
                <label>Lab Tests</label>
                <table>
                    <tbody>
                        <tr>
                            <td>Test name</td>
                            <td>Remarks</td>
                        </tr>
                        <tr>
                            <td>Test Name</td>
                            <td>Remarks</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="notice">(For viewing purpose only)</div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rows = document.querySelectorAll("tr.clickable-row");
            const modal = document.getElementById("myModal");
            const closeButton = modal.querySelector(".close");

            rows.forEach(row => {
                row.addEventListener("click", () => {
                    modal.style.display = "block";
                });
            });

            closeButton.addEventListener("click", () => {
                modal.style.display = "none";
            });

            window.addEventListener("click", (event) => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        });
    </script>
</body>