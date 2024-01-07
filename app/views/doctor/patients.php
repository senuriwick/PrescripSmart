<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Patients</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../public/css/doctor/patients.css" />
    <link rel="stylesheet" href="../public/css/doctor/sideMenu&navBar.css" />
    <script src="../public/js/doctor/main.js"></script>
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

                <a href="<?php echo URLROOT; ?>/doctor/patients" class="active">Patients</a>
                <a href="<?php echo URLROOT; ?>/doctor/viewOngoingSession">Ongoing Sessions</a>
                <a href="<?php echo URLROOT; ?>/doctor/sessions">Sessions</a>
                <a href="<?php echo URLROOT; ?>/doctor/profile">Profile</a>
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
                    <img src="../public/img/doctor/user.png" alt="user-icon">
                    <p>USERNAME</p>
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
                        <h1>Search Patient</h1>
                        <form>
                            <input type="text" class="searchBar" id="searchInput" placeholder="Enter patient name or Id" />

                        </form>
                        <hr />
                        <div class="patient-details">
                            <table>
                                <tbody>
                                <?php foreach($data['patientsData'] as $patientData): ?>
                                    <tr class="patient-details-row">
                                        
                                        <td>
                                            <div class="desDiv">
                                                <img src="../public/img/doctor/profile.png" alt="user-icon">
                                                <p class="patientName"><?php echo $patientData->patient_name; ?></p>
                                                <i class="fa-solid fa-chevron-down" data-target="content<?php echo $patientData->patient_id; ?>" onclick="show(this)"></i>                                            
                                            </div>
                                        </td>
                                        
                                        <td>Patient ID - <?php echo $patientData->patient_id ?></td>
                                        <td><a href="<?php echo URLROOT; ?>/doctor/addPrescription/<?php echo $patientData->patient_id;?>"><button>Add Prescription</button></a></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="3">
                                            <div id="content<?php echo $patientData->patient_id; ?>" class="patient-data" style="display: none;">
                                                <p>Age: <?php echo $patientData->Age; ?></p>
                                                <p>Height: <?php echo $patientData->height; ?> cm</p>
                                                <p>Weight: <?php echo $patientData->weight; ?> kg</p>
                                                <a href="<?php echo URLROOT; ?>/doctor/addPrescription"><button>Add prescription</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                  const searchInput = document.getElementById("searchInput");
                              
                                  searchInput.addEventListener("input", function () {
                                    const searchTerm = searchInput.value.toLowerCase();
                                    const regex = new RegExp(searchTerm, 'i');
                                    const patientRows = document.querySelectorAll(".patient-details-row");
                              
                                        patientRows.forEach(function (row) {
                                            const patientName = row.querySelector(".patientName").textContent.toLowerCase();
                                        //   if (patientName.includes(searchTerm)) {
                                        //     row.style.display = "table-row";
                                        //   } else {
                                        //     row.style.display = "none";

                                            if (regex.test(patientName)) {
                                                    row.style.display = "table-row";
                                                } else {
                                                    row.style.display = "none";
                                                }
                                      });
                                    });
                                  });
                                
                              </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>