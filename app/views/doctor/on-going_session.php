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
                                    <button id="profile" value="<?php echo $data['ongoingPatient']->patient_ID;?>">VIEW PROFILE</button>
                                    <a href="<?php echo URLROOT;?>/doctor/addPrescription/<?php echo $data['ongoingPatient']->patient_ID;?>"><button>ADD PRESCRIPTION</button></a>
                                </div>
                            </div>
                        </div><?php }else{?>
                            <div class="session-subhead"><center>No on-going Appointment</center></div>
                            <?php }?>
                    </div>
                    <div class="profile-modal">
                        <div class="modal-content">
                        <span class="close">&times;</span>
                            <div class="data">
                            <!-- <div class="name"><b></b></div>
                            <div class="id"></div> -->
                        </div>
                            <hr/>
                            <div class="details">
                                <!-- <div class="patient-details">
                                <div>age: </div>
                                <div>hight:</div>
                                <div>weight:</div></div>
                                <center><button>View Medical History</button></center> -->

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const buttonbox = document.querySelector(".btn-box")
                    const profilebutton = buttonbox.children[0];
                    const profileModal = document.querySelector(".profile-modal");
                    const closebutton = profileModal.querySelector(".close");

                    profilebutton.addEventListener("click",()=>{
                        profileModal.style.display = "block";
                        var patientId = profilebutton.value;

                        fetch(`http://localhost/Prescripsmart/doctor/ongoingSessionPatient?patientid=${patientId}`)
                        .then(response=>{
                            console.log(response);
                            return response.json();
                        })
                        .then(data=>{
                            console.log(data);
                            showProfileDetails(data);
                        })
                        .catch(error=>console.error("Error",error));

                        function showProfileDetails(patient){
                            var datadiv = profileModal.querySelector(".data");
                            datadiv.innerHTML = "";
                            datadiv.innerHTML = `
                            <div class="name"><b>Patient Name: ${patient.display_Name}</b></div>
                            <div class="id">patient ID: ${patient.patient_ID}</div></div>`;

                            var detailsdiv = profileModal.querySelector(".details");
                            detailsdiv.innerHTML="";
                            detailsdiv.innerHTML =`
                            <div class="patient-details">
                                <div>Age: ${patient.age} years</div>
                                <div>Height: ${patient.height} cm</div>
                                <div>weight: ${patient.weight} kg</div></div>
                                <a href="<?php echo URLROOT; ?>/doctor/viewPrescriptions/${patient.patient_ID}"><center><button>View Medical History</button></center><a>`;
                            
                        }
                    });

                    closebutton.addEventListener("click",() =>{
                        profileModal.style.display = "none";
                    });

                    window.addEventListener("click",(event)=>{
                        if(event.target ===profileModal){
                            profileModal.style.display = "none";
                        }
                    });
                });
     </script>   
</body>