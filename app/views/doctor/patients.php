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
<?php $currentPage = $data['currentPage'];
  $totalPages = $data['totalPages'];
//   $allPatients = $data['allPatients'];
  ?>
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
                            <input type="text" class="searchBar" id="searchInput" placeholder="Enter patient name or Id" oninput="searchPatient(this.value)" />

                        </form>
                        <hr />
                        <div class="patient-details" id="patient-details">
                            <table>
                                <tbody id="table"><?php if($data['ongoingSession']){?>
                                <?php foreach($data['patients'] as $patient): ?>
                                    <tr class="patient-details-row">
                                        
                                        <td>
                                            <div class="desDiv">
                                                <img src="<?php echo URLROOT;?>/public/uploads/profile_images/<?php echo $patient->profile_photo;?>" alt="user-icon">
                                                <p class="patientName"><?php echo $patient->display_Name; ?></p>
                                                <p>Patient ID - <?php echo $patient->patient_ID ?></p>
                                                <i class="fa-solid fa-chevron-down" data-target="content<?php echo $patient->patient_ID; ?>" onclick="show(this)"></i>                                            
                                            </div>
                                        </td>
                                        
                                        <!-- <td>Patient ID - <?php echo $patient->patient_ID ?></td> -->
                                        <td><a href="<?php echo URLROOT; ?>/doctor/addPrescription/<?php echo $patient->patient_ID;?>"><button>Add Prescription</button></a></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="3">
                                            <div id="content<?php echo $patient->patient_ID; ?>" class="patient-data" style="display: none;">
                                            <div class = "details">
                                                <p>Age: <?php echo $patient->age; ?></p>
                                                <p>Height: <?php echo $patient->height; ?> cm</p>
                                                <p>Weight: <?php echo $patient->weight; ?> kg</p>
                                                <a href="<?php echo URLROOT; ?>/doctor/viewPrescriptions/<?php echo $patient->patient_ID;?>"><button class="history">View Medical History</button></a>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                    <?php }else{?>
                                        <p><center>no patients</p></center><?php }?>
                                </tbody>
                                
                                
                            </table>
                            <div class="pagination">
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <a href="<?php echo URLROOT ?>/doctor/patients/<?php echo $i ?>" <?php if ($currentPage == $i)
                                                    echo 'class="active"'; ?>><?php echo $i ?></a>
                                        <?php endfor; ?>
                                        </div>
                            <script>
                                // document.addEventListener("DOMContentLoaded", function () {
                                //   const searchInput = document.getElementById("searchInput");
                              
                                //   searchInput.addEventListener("input", function () {
                                //     const searchTerm = searchInput.value.toLowerCase();
                                //     const regex = new RegExp(searchTerm, 'i');
                                //     const patientRows = document.querySelectorAll(".patient-details-row");
                              
                                //         patientRows.forEach(function (row) {
                                //             const patientName = row.querySelector(".patientName").textContent.toLowerCase();
                                //         //   if (patientName.includes(searchTerm)) {
                                //         //     row.style.display = "table-row";
                                //         //   } else {
                                //         //     row.style.display = "none";

                                //             if (regex.test(patientName)) {
                                //                     row.style.display = "table-row";
                                //                 } else {
                                //                     row.style.display = "none";
                                //                 }
                                //       });
                                //     });
                                //   });

                                function searchPatient(query){
                                    if(query.length>=1){
                                        fetch(`http://localhost/Prescripsmart/doctor/searchPatient?query=${query}`)
                                        .then(response =>{
                                            console.log(response);
                                            return response.json();

                                        })
                                        .then(data =>{
                                            console.log(data);
                                            showPatients(data);
                                        })
                                        .catch(error =>console.error('Error:',error));


                                    }else{
                                        location.reload();
                                    }
                                                                    }

                                function showPatients(resultPatients){
                                    // console.log(resultPatients);
                                    var patientTable = document.getElementById("patient-details");
                                    var patientrow = document.getElementById("table");
                                    patientrow.innerHTML="";

                                    if(resultPatients.length > 0){
                                        
                                        resultPatients.forEach(patient =>{
                                            patientHTML=`
                                            <tr class="patient-details-row">
                                            
                                            <td>
                                                <div class="desDiv">
                                                    <img src="<?php echo URLROOT;?>/public/uploads/profile_images/${patient.profile_photo}" alt="user-icon">
                                                    <p class="patientName">${patient.display_Name}</p>
                                                    <i class="fa-solid fa-chevron-down" data-target="content${patient.patient_ID}" onclick="show(this)"></i>                                            
                                                </div>
                                            </td>
                                            
                                            <td>Patient ID - ${patient.patient_ID}</td>
                                            <td><a href="<?php echo URLROOT; ?>/doctor/addPrescription/${patient.patient_ID}"><button>Add Prescription</button></a></td>
                                            </tr>
                                            
                                            <tr>
                                                <td colspan="3">
                                                    <div id="content${patient.patient_ID}" class="patient-data" style="display: none;">
                                                        <p>Age: ${patient.age}</p>
                                                        <p>Height: ${patient.height}cm</p>
                                                        <p>Weight: ${patient.weight} kg</p>
                                                        <a href="<?php echo URLROOT; ?>/doctor/viewPrescriptions/${patient.patient_ID}"><button class="history">View Medical History</button></a>
                                                    </div>
                                                </td>
                                            </tr>`;
                                            patientrow.innerHTML+=patientHTML;
                                    });
                                        
                                    }
                                    // else{
                                    //     location.reload();
                                    // }
                                }
                              </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>