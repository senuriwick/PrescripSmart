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
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/lab_tech/patient.css" />
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
                <?php include 'information_container.php'; ?>
                <?php include 'in_page_navigation.php'; ?>
                    <div class="patient-test-data" id="patient-test-data">
                        <div class="patientInfo2">
                            <img src="<?php echo URLROOT;?>/public/uploads/profile_images/<?php echo $data['patientDetails']->profile_photo;?>" alt="profile">
                            <div class="infoDetail">
                                <p class="name"><?php echo $data['patientDetails']->display_Name;?></p>
                                <p class="id">Patient ID-<?php echo $data['patientDetails']->patient_ID;?></p>
                                <p class="age"><?php echo $data['patientDetails']->age;?> years</p>
                            </div>
                        </div>
                        <hr>
                        <h1>Test (<?php echo $data['testCount'];?>)</h1>

                        <?php foreach($data['testData'] as $test):?>

                        <div class="test-details-box">
                            <div class="test-details">
                                <p class="test-descript">Test Description : <span style="font-weight: normal;"><?php echo $test->name;?></span></p>
                                <p class="rest-data">Date : <?php echo $test->date_of_conduct;?></p>
                                <p class="rest-data">Refered by : DR. <?php echo $test->display_Name;?></p>
                                <?php if ($test->remarks!=""){?><p class="rest-data">Remarks : <?php echo $test->remarks;}?></p>
                            </div>
                            <div method="POST" class="buttons">
                                <button  id="uploadBtn" style="background-color:#397A49; display: none;" value="<?php echo $test->report_ID;?>"> Upload Report</button>
                                <button  id="markBtn" style="background-color: #0069FF;" value="<?php echo $test->report_ID;?>">Mark As Done</button>
                            </div>
                            <br>
                        </div>
                        <?php endforeach;?>

                    </div>
                    <div class="upload-model" id="upload-model" style="display: none;">
                        <div class="model-content">
                            <span class="close">&times;</span>
                            <form method="POST" action="<?php echo URLROOT;?>/LAbTechnician/reportUpload" enctype="multipart/form-data">
                                <input type="file" name="file" placeholder="Uplode Report">
                                <input type="hidden" name="patientid" value="<?php echo $data['patientDetails']->patient_ID;?>">
                                <input type="hidden" name="reportid" id="reportid">
                                <button type="submit" name="upload" >Upload</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function (){
            const patienttestdata=document.getElementById("patient-test-data");
            const testboxs = patienttestdata.querySelectorAll(".test-details-box");

            testboxs.forEach(testbox =>{

                const buttons = testbox.querySelector(".buttons");
                const uploadbutton = buttons.children[0];
                const markbutton = buttons.children[1];
                // const deleteicon = buttons.children[1];
                const uploadmodel=document.getElementById("upload-model");
                // const patientid = uploadbutton.getAttribute("name");
                const closebutton=uploadmodel.querySelector(".close");

                const modeluploadbutton=uploadmodel.querySelector(".model-content button");
                const uploadedcontent=document.getElementById("upload-patient-test-data");
                const reportidInput = document.getElementById("reportid");

                // Set visibility based on localStorage
        const buttonState = localStorage.getItem('buttonState' + markbutton.value);
        if (buttonState === 'upload') {
            markbutton.style.display = "none";
            uploadbutton.style.display = "block";
        }


                uploadbutton.addEventListener("click",()=>{
                    patienttestdata.style.display="block";
                    uploadmodel.style.display="block";
                    reportidInput.value = uploadbutton.value;

                });

                closebutton.addEventListener("click",()=>{
                    uploadmodel.style.display="none";
                });

                window.addEventListener("click",(event)=>{
                    if(event.target===uploadmodel){
                        uploadmodel.style.display="none";
                    }
                });

                modeluploadbutton.addEventListener("click",()=>{
                    uploadmodel.style.display="none";
                });

                markbutton.addEventListener("click",()=>{

                    var report_id = markbutton.value;
                    
                    fetch('<?php echo URLROOT;?>/LabTechnician/markedRead',{
                        method: 'POST',
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded',
                        },
                        body:'reportid='+report_id
                    })
                    .then(response=>response.text())
                    .then(data =>{
                        console.log('success:',data);
                        // Update local storage to remember the state change
                localStorage.setItem('buttonState' + markbutton.value, 'upload');
                window.location.reload();
                    })
                    .catch((error)=>{
                        console.log('Error:',error);
                    });
                    // window.location.reload();
                    // markbutton.style.display="none";
                    // uploadbutton.style.display="block";

                
                });

                // deleteicon.addEventListener("click",()=>{
                //     var report_id = markbutton.value;
                //     console.log(report_id);

                //     fetch('<?php echo URLROOT;?>/LabTechnician/deletereport',{
                //         method:'POST',
                //         headers: {
                //             'Content-Type':'application/x-www-form-urlencoded',
                //         },
                //         body:'reportid='+report_id
                //     })
                //     .then(response=>response.text())
                //     .then(data =>{
                //         console.log('report deleted:',data);
                //     })
                //     .catch((error)=>{
                //         console.log('Error:',error);
                //     });
                // });

            });
            
            
        });


    </script>
</body>
</html>
