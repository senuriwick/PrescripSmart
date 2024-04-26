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
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/patients.css" />
    <!-- <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/sideMenu_navBar.css" /> -->
    <script src="<?php echo URLROOT;?>/public/js/doctor/main.js"></script>
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
                        <h1>Search Patient</h1>
                        <form>
                            <input type="text" class="searchBar" id="searchInput" placeholder="Enter patient name or Id" />

                        </form>
                        <hr />
                        <div class="patient-details">
                            <table>
                                <tbody><?php if($data['ongoingSession']){?>
                                <?php foreach($data['patientsData'] as $patientData): ?>
                                    <tr class="patient-details-row">
                                        
                                        <td>
                                            <div class="desDiv">
                                                <img src="<?php echo URLROOT;?>/public/img/doctor/profile.png" alt="user-icon">
                                                <p class="patientName"><?php echo $patientData->display_Name; ?></p>
                                                <i class="fa-solid fa-chevron-down" data-target="content<?php echo $patientData->patient_ID; ?>" onclick="show(this)"></i>                                            
                                            </div>
                                        </td>
                                        
                                        <td>Patient ID - <?php echo $patientData->patient_ID ?></td>
                                        <td><a href="<?php echo URLROOT; ?>/doctor/addPrescription/<?php echo $patientData->patient_ID;?>"><button>Add Prescription</button></a></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="3">
                                            <div id="content<?php echo $patientData->patient_ID; ?>" class="patient-data" style="display: none;">
                                                <p>Age: <?php echo $patientData->age; ?></p>
                                                <p>Height: <?php echo $patientData->height; ?> cm</p>
                                                <p>Weight: <?php echo $patientData->weight; ?> kg</p>
                                                <a href="<?php echo URLROOT; ?>/doctor/addPrescription/<?php echo $patientData->patient_ID;?>"><button>Add prescription</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php }else{?>
                                        <p>no patients</p><?php }?>
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