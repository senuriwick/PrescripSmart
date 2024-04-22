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
    <link rel="stylesheet" href="../public/css/lab_tech/patient.css" />
    <link rel="stylesheet" href="../public/css/lab_tech/sideMenu_navBar.css" />
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="../public/img/lab_tech/Untitled design (5) copy 2.png" />
            </div>

            <!-- <div class="userDiv">
                <p class="mainOptions">
                    <Datag>LAB TECHNICIAN</Datag>
                </p>

                <div class="profile">
                    <p>username</p>
                </div>
            </div> -->


            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="<?php echo URLROOT; ?>/LabTechnician/patient" class="active">Patients</a>
                <a href="<?php echo URLROOT;?>/labTechnician/profile">Profile</a>
            </div>
            <div class="othersDiv">
                <p class="sideMenuTexts">Terms of Services</p>
                <p class="sideMenuTexts">Privacy Policy</p>
                <p class="sideMenuTexts">Settings</p>
            </div>

        </div>
        <div class="container">
            <div class="navBar">
                <div class="navBar">
                    <img src="../public/img/lab_tech/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="../public/img/lab_tech/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Lab technician Name</p>
                            <p class="role">Lab technician</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT; ?>/LabTechnician/patient">Patients</a></p>
                    </div>

                    <div class="patientSearch" id="patientSearch">
                        <h1>Search Patient</h1>
                        <form>
                            <input type="text" class="searchBar" id="searchInput" placeholder="Enter patient name or Id" />
                        </form>
                        <hr />
                        <div class="patient-details">
                            <table>
                                <tbody>
                                    <?php foreach ($data['reportsToUpload'] as $reportToUpload): ?>
                                    <tr class="patient-detail-row">
                                        <td>
                                            <div class="desDiv">
                                                <img src="../public/img/lab_tech/profile.png" alt="user-icon">
                                                <p class="patientName"><?php echo $reportToUpload->display_Name;?></p>
                                            </div>
                                        </td>
                                        
                                        <td>Patient ID-<?php echo $reportToUpload->patient_ID;?></td>
                                        <td><a href="<?php echo URLROOT; ?>/LabTechnician/reports/<?php echo $reportToUpload->patient_ID;?>"><button >View Test</button></a></td>
                                    </tr>
                                    
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function (){
            const searchInput = document.getElementById("searchInput");

            searchInput.addEventListener("input",function(){
                const searchTerm = searchInput.value.toLowerCase();
                const regex = new RegExp(searchTerm, 'i');
                const patientRows = document.querySelectorAll(".patient-detail-row");

                patientRows.forEach(function (row){
                    const patientName = row.querySelector(".patientName").textContent.toLowerCase();
                    if(regex.test(patientName)){
                        row.style.display= "table-row";
                    }else{
                        row.style.display= "none";
                    }
                });
            });
       
        });

    </script>
</body>
</html>
