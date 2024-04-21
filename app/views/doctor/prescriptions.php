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
                            <p class="name"><?php echo $data['patient']->display_Name;?></p>
                            <p class="role">Patient</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT;?>/doctor/viewPrescriptions/<?php echo $data['patient']->patient_ID;?>">Prescription</a></p>
                        <p><a href="<?php echo URLROOT; ?>/doctor/viewReports/<?php echo $data['patient']->patient_ID;?>">Reports</a></p>
                    </div>

                    <div class="patientSearch">
                        <div class="topic">
                            <label>Prescriptions(<?php echo $data['prescriptionsCount']; ?>)</label>
                        </div>
                        <div class="prescription-table">
                            <table>
                                <tbody>
                                    <?php foreach($data['prescriptionsData'] as $prescriptionData): ?>
                                    <tr class="clickable-row" diagnosisid="<?php echo $prescriptionData->diagnosis_id; ?>">
                                        <td>
                                            <div class="presDiv">
                                                <img src="<?php echo URLROOT;?>/public/img/doctor/description.png" alt="download-icon">
                                                <p><?php echo $prescriptionData->diagnosis;?></p>
                                            </div>
                                        </td>
                                        <td>DR. <?php echo $prescriptionData->fName; ?></td>
                                        <td><?php echo $prescriptionData->date; ?></td>
                                    </tr>
                                    <?php endforeach;?>
                                    <tr>
                                        <td colspan="3" class="td-cols">
                                            <a href="<?php echo URLROOT;?>/doctor/addPrescription/<?php echo $data['patient']->patient_ID; ?>">+ Add Prescription</a>
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
                <img src="<?php echo URLROOT;?>/public/img/doctor/qr.png" alt="qr-img" />
                <h4><u>CONFIDENTIAL PRESCRIPTION</u></h4>
                <i class="fa-solid fa-circle-arrow-up"></i>
            </div>
            <div class="model-details" id="model-details">
                <!-- load from the script -->
            </div>
            <div class="pres-box">
                <label>Diagnosis</label>
                <div id="diagnosis"></div>
            </div>
            <div class="pres-box">
                <label>Medication</label>
                <table id="medications">
                    <tbody>
                    <!-- load from the script -->
                    </tbody>
                </table>
            </div>
            <div class="pres-box">
                <label>Lab Tests</label>
                <table id="tests">
                    <tbody>
                        <!-- load from the script -->
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
                    var diagnosisid = row.getAttribute("diagnosisid");
                    showDiagnosis(diagnosisid);
                    showMedications(diagnosisid);
                    showTests(diagnosisid);
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

            function showDiagnosis(diagnosisid){
                fetch(`http://localhost/Prescripsmart/doctor/showDiagnosis?diagnosisid=${diagnosisid}`)
                    .then(response =>{
                        console.log(response);
                        return response.json();
                    })
                    .then(data =>{
                        showDiagnosisDetails(data);
                        console.log(data);
                    })
                    .catch(error => console.error('Error:',error));
            }

            function showDiagnosisDetails(result){
                const diagnosisContent = document.getElementById('diagnosis');
                const modelhead = document.getElementById('model-details');

                modelhead.innerHTML = `
                <div>Prescription ID: ${result.diagnosis_id}</div>
                <div>Patient: ${result.display_Name}</div>
                <div>Pres Date & Time: ${result.date}</div>
                <div>Age: ${result.age}</div>
                <div>Referred by: Dr.${result.fName}</div>`;

                diagnosisContent.innerHTML = '';
                diagnosisContent.textContent = result.diagnosis;
            }

            function showMedications(diagnosisid){
                fetch(`http://localhost/Prescripsmart/doctor/showMedications?diagnosisid=${diagnosisid}`)
                    .then(response =>{
                        console.log(response);
                        return response.json();
                    })
                    .then(data =>{
                        showMedicationsDetails(data);
                        console.log(data);
                    })
                    .catch(error => console.error('Error',error));
            }

            function showMedicationsDetails(results){

                var table = document.getElementById('medications');
                table.innerHTML = '';
                var rowCount = table.rows.length;


                results.forEach(result =>{
                    var newRow = table.insertRow(rowCount);
                    var medicationCell = newRow.insertCell(0);
                    var remarksCell = newRow.insertCell(1);
                    medicationCell.textContent = result.medication;
                    remarksCell.textContent = result.remark;
                });
            }

            function showTests(diagnosisid){
                fetch(`http://localhost/Prescripsmart/doctor/showTests?diagnosisid=${diagnosisid}`)
                    .then(response =>{
                        console.log(response);
                        return response.json();
                    })
                    .then(data =>{
                        console.log(data);
                        showTestDetails(data);
                    })
                    .catch(error => console.error('Error',error));
            }

            function showTestDetails(results){
                table = document.getElementById('tests');
                table.innerHTML ='';
                var rowCount = table.rows.length;

                if(results){
                    results.forEach(result =>{
                    var newRow = table.insertRow(rowCount);
                    var testCell = newRow.insertCell(0);
                    var testremarkCell = newRow.insertCell(1);
                    testCell.textContent = result.name;
                    testremarkCell.textContent = result.remarks;
                })
                }else{
                    var newRow = table.insertRow(rowCount);
                    newRow.textContent = "No test recomended";
                }
            }
        });
    </script>
</body>