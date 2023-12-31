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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../public/css/doctor/sessions.css" />
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
                    <img src="../public/img/doctor/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="../public/img/doctor/profile.png" alt="profile-pic">
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
                        <div   id="session-details" class="sessions-box">
                        <?php foreach($data['sessionsData'] as $sessionData): ?>
                            <div class="session-card">
                                <div><b><?php echo $sessionData->session_id; ?></b></div>
                                <hr>
                                <div><?php echo formatCustomDate($sessionData->session_date);?></div>
                                <div><?php echo formatCustomTime($sessionData->session_time);?></div>
                                <button>VIEW SESSION</button>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div id="session-patients" class="clicked-session">
                            <div class="session-number">
                                <h1>Session #1234</h1>
                                <p>Number of patients <span style="color: blue;">04</span></p>
                            </div>
                            <hr>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="session-patient">
                                                <img src="../public/img/doctor/profile.png" alt="user-icon">
                                                <p class="patientName">Ms. Shenaya Perera</p>
                                            </div>
                                        </td>
                                        <td><p class="patientId">Patient ID-#1234567</p></td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="session-patient">
                                                <img src="../public/img/doctor/profile.png" alt="user-icon">
                                                <p class="patientName">Ms. Shenaya Perera</p>
                                            </div>
                                        </td>
                                        <td><p class="patientId">Patient ID-#1234567</p></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="session-modal" class="session-modal">
        <div class="session-content">
            <span class="close">&times;</span>
            <div class="modal-head"><b>Session #1254</b></div>
            <div class="session-modal-content">
                <div class="doctor-data">
                    <img src="../public/img/doctor/profile.png" alt="user-icon">
                    <div class="doctor-data1">
                        <div class="name"><b>DR.ASANKA RATHNAYAKE</b></div>
                        <div class="role">Consultant Physician</div>
                    </div>
                </div>
                <hr />
                <div>Date: Sunday, 17th Sept,2023</div>
                <div>Time: 08.00 AM</div>
                <div class="patient-data">
                    <div>No. of patients: 09</div>
                    <button type="button">VIEW PATIENTS</button>
                </div>
            </div>
            <div class="cancel">
                <button>CANCEL SESSION</button>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const viewSessionButtons = document.querySelectorAll(".session-card button");
            const sessionModal = document.getElementById("session-modal");
            const closeSessionModal = sessionModal.querySelector(".close");

            const viewPatientsButton = sessionModal.querySelector(".patient-data button");
            const sessionPatient = document.getElementById("session-patients");
            const sessiondetails=document.getElementById("session-details");


            viewSessionButtons.forEach(button => {
                button.addEventListener("click", () => {
                    sessionModal.style.display = "block";
                    

                });
            });

            viewPatientsButton.addEventListener("click", () => {
                console.log("view patient button clicked");
                sessionPatient.style.display="block";
                sessionModal.style.display="none";
                sessiondetails.style.display="none";


            });

            closeSessionModal.addEventListener("click", () => {
                sessionModal.style.display = "none";
            });

            window.addEventListener("click", (event) => {
                if (event.target === sessionModal) {
                    sessionModal.style.display = "none";
                }
            });

        });

    </script>
</body>
</html>

<?php
    function formatCustomDate($dataString){
        $dateTime = new DateTime($dataString);
        $formattedDate = $dateTime->format('d, M, Y');
        return $formattedDate;
}

function formatCustomTime($timeString){
    $dateTime = new DateTime($timeString);
    $formattedTime = $dateTime->format('h:i A');
    return $formattedTime;
}

?>