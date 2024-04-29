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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\general\in_page_navigation.css" />

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
        <div class="menu">
        <a href="<?php echo URLROOT; ?>/doctor/viewPrescriptions/<?php echo $data['patient']->patient_ID;?>" id="prescriptions">Prescriptions</a>
        <a href="<?php echo URLROOT; ?>/doctor/viewReports/<?php echo $data['patient']->patient_ID;?>" id="reports">Reports</a>
    </div>
                    <div class="patientSearch">
                        <div class="topic">
                            <label>Prescriptions(<?php echo $data['prescriptionsCount']; ?>)</label>
                        </div>
                        <div class="prescription-table">
                            <table>
                                <tbody>
                                    <?php foreach($data['prescriptionsData'] as $prescriptionData): ?>
                                    <tr class="clickable-row" prescriptionid="<?php echo $prescriptionData->prescription_ID; ?>">
                                        <td>
                                            <div class="presDiv">
                                                <img src="<?php echo URLROOT;?>/public/img/doctor/description.png" alt="download-icon">
                                                <p><?php echo $prescriptionData->diagnosis;?></p>
                                            </div>
                                        </td>
                                        <td>DR. <?php echo $prescriptionData->display_Name; ?></td>
                                        <td><?php echo $prescriptionData->prescription_Date; ?></td>
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
                <div>p</div>
                <!-- <img src="<?php echo URLROOT;?>/public/img/doctor/qr.png" alt="qr-img" /> -->
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
            <div class="footer">
            <div class="notice">(For viewing purpose only)</div>
            <div class="sign"></div>
                                    </div>
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
                    var prescriptionid = row.getAttribute("prescriptionid");
                    showDiagnosis(prescriptionid);
                    showMedications(prescriptionid);
                    showTests(prescriptionid);
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

            function showDiagnosis(prescriptionid){
                fetch(`http://localhost/Prescripsmart/doctor/showDiagnosis?prescriptionid=${prescriptionid}`)
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
                const sign = document.querySelector(".sign");

                modelhead.innerHTML = `
                <div>Prescription ID: ${result.prescription.prescription_ID}</div>
                <div>Patient: ${result.prescription.display_Name}</div>
                <div>Pres Date & Time: ${result.prescription.prescription_Date}</div>
                <div>Age: ${result.prescription.age}</div>
                <div>Referred by: Dr.${result.doctor.display_Name}</div>`;

                diagnosisContent.innerHTML = '';
                diagnosisContent.textContent = result.prescription.diagnosis;

                // sign.innerHTML ="";
                sign.innerHTML=`
                <img src="<?php echo URLROOT;?>/public/uploads/signatures/${result.doctor.signature}`;

            }

            function showMedications(prescriptionid){
                fetch(`http://localhost/Prescripsmart/doctor/showMedications?prescriptionid=${prescriptionid}`)
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

            function showTests(prescriptionid){
                fetch(`http://localhost/Prescripsmart/doctor/showTests?prescriptionid=${prescriptionid}`)
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