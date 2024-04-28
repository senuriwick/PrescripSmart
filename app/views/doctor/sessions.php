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
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/sessions.css" />
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
                        <div   id="session-details" class="sessions-box">
                        <?php foreach($data['sessionsData'] as $sessionData): ?>
                            <div class="session-card">
                                <div><b>Session ID: <?php echo $sessionData->session_ID; ?></b></div>
                                <hr>
                                <div>Date: <?php echo formatCustomDate($sessionData->sessionDate);?></div>
                                <div>Time: <?php echo formatCustomTime($sessionData->start_time);?></div>
                                <button sessionID="<?php echo $sessionData->session_ID;?>">VIEW PATIENTS</button>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <!-- <div id="session-patients" class="clicked-session">
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
                                                <img src="<?php echo URLROOT;?>/public/img/doctor/profile.png" alt="user-icon">
                                                <p class="patientName">Ms. Shenaya Perera</p>
                                            </div>
                                        </td>
                                        <td><p class="patientId">Patient ID-#1234567</p></td>

                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="session-patient">
                                                <img src="<?php echo URLROOT;?>/public/img/doctor/profile.png" alt="user-icon">
                                                <p class="patientName">Ms. Shenaya Perera</p>
                                            </div>
                                        </td>
                                        <td><p class="patientId">Patient ID-#1234567</p></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="session-modal" class="session-modal">
        <div class="session-content">
            <span class="close">&times;</span>
            <div class="session-modal-content">
            <div class="modal-head"><b>Session #1254</b></div>
                <hr/>
                
                <div class="patient-data">
                    <!-- <div>No. of patients: 09</div> -->
                    <hr/>
                    <!-- <button type="button">VIEW PATIENTS</button> -->
                </div>
                <div class="patients">
                </div>
            </div>
            <div class="cancel">
                <button>CANCEL SESSION</button>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const viewPatientsButton = document.querySelectorAll(".session-card button");
            const sessionModal = document.getElementById("session-modal");
            const closeSessionModal = sessionModal.querySelector(".close");


            // const viewPatientsButton = sessionModal.querySelector(".patient-data button");
            const sessionPatient = document.getElementById("session-patients");
            const sessiondetails=document.getElementById("session-details");


            viewPatientsButton.forEach(button => {
                const sessionID = button.getAttribute("sessionID");
                button.addEventListener("click", () => {
                    sessionModal.style.display = "block";
                    sessionModal.setAttribute("sessionid",sessionID);
                    showSessionDetails(sessionID);
                });
            });

            function showSessionDetails(sessionId){
                console.log(sessionId);
                fetch(`http://localhost/Prescripsmart/doctor/showSessionPatients?sessionid=${sessionId}`)
                .then(response =>{
                    console.log(response);
                    return response.json();
                })
                .then(data =>{
                    console.log(data);
                    showPatients(data);
                })
                .catch(error =>console.error('Error',error));
            }

            function showPatients(result){
                const sessionModal = document.getElementById("session-modal");
                const patientCountdiv = sessionModal.querySelector(".patient-data");
                patientCountdiv.innerHTML = `
                <div>No. of patients: ${result.patientCount}</div>`;
                
                var patientsdiv = sessionModal.querySelector(".patients");
                patientsdiv.innerHTML = "";
                if(result.sessionPatients.length>0){
                    result.sessionPatients.forEach(patient =>{
                        const item = document.createElement('div');
                        item.classList.add('patients-item');
                        item.textContent = patient.token_No+" "+patient.display_Name;

                        patientsdiv.appendChild(item);
                    })
                }
                
                // patientCountdiv.innetHTML = "";
                // const patientNo = document.getElementById("patinet-no");
                // patientNo.innerHTML=``;
            }

            // viewPatientsButton.addEventListener("click", () => {
            //     console.log("view patient button clicked");
            //     sessionPatient.style.display="block";
            //     sessionModal.style.display="none";
            //     sessiondetails.style.display="none";


            // });

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
        $formattedDate = $dateTime->format('l, jS M, Y');
        return $formattedDate;
}

function formatCustomTime($timeString){
    $dateTime = new DateTime($timeString);
    $formattedTime = $dateTime->format('h:i A');
    return $formattedTime;
}

?>