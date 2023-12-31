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
    <link rel="stylesheet" href="../public/css/lab_tech/sideMenu&navBar.css" />
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
                <a href="profile.html">Profile</a>
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
                            <input type="text" class="searchBar" placeholder="Enter patient name or Id" />
                        </form>
                        <hr />
                        <div class="patient-details">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="desDiv">
                                                <img src="../public/img/lab_tech/profile.png" alt="user-icon">
                                                <p class="patientName">Ms. Shenaya Perera</p>
                                                <i class="fa-solid fa-chevron-down" data-target="content1" onclick="show(this)"></i>                                            </div>
                                        </td>
                                        
                                        <td>Patient ID - #123456</td>
                                        <td><a href="#"><button>View Test</button></a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div id="content1" class="patient-data" style="display: none;">
                                                <p>Age: 30</p>
                                                <p>Height: 170 cm</p>
                                                <p>Weight: 60 kg</p>
                                                <a href="#"><button>View Test</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="desDiv">
                                                <img src="../public/img/lab_tech/profile.png" alt="user-icon">
                                                <p class="patientName">Mr. John Due</p>
                                                <i class="fa-solid fa-chevron-down" data-target="content2" onclick="show(this)"></i>                                            </div>
                                        </td>
                                        <td>Patient ID - #123457</td>
                                        <td><button>View Test</button></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div id="content2" class="patient-data" >
                                                <p>Age: 30</p>
                                                <p>Height: 170 cm</p>
                                                <p>Weight: 60 kg</p>
                                                <a href="#"><button>View Test</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <div class="patient-test-data" id="patient-test-data" style="display: none;">
                        <div class="patientInfo">
                            <img src="../public/img/lab_tech/profile.png" alt="profile">
                            <div class="infoDetail">
                                <p class="name">Ms. Shenaya Perera</p>
                                <p class="id">Patient ID-#12345</p>
                                <p class="age">22 years</p>
                            </div>
                        </div>
                        <hr>
                        <h1>Test (4)</h1>
                        <div class="test-details-box">
                            <div class="test-details">
                                <p class="test-descript">Test Description : <span style="font-weight: normal;">Sample here</span></p>
                                <p class="rest-data">Date : 10/10/2023</p>
                                <p class="rest-data">Refered by : Doctor name</p>
                                <p class="rest-data">Remarks : Docter comments here</p>
                            </div>
                            <div class="buttons">
                                <button style="background-color:#397A49;">Uploads Report</button>
                                <button style="background-color: #0069FF;">Mark As Done</button>
                            </div>
                        </div>
                        <div class="test-details-box">
                            <div class="test-details">
                                <p class="test-descript">Test Description : <span style="font-weight: normal;">Sample here</span></p>
                                <p class="rest-data">Date : 10/10/2023</p>
                                <p class="rest-data">Refered by : Doctor name</p>
                                <p class="rest-data">Remarks : Docter comments here</p>
                            </div>
                            <div class="buttons" id="buttons">
                                <button  id="upload-button" style="background-color:#397A49;">Uploads Report</button>
                                <button style="background-color: #0069FF;">Mark As Done</button>
                            </div>
                        </div>
                    </div>
                    <div class="upload-model" id="upload-model" style="display: none;">
                        <div class="model-content">
                            <span class="close">&times;</span>
                            <form>
                                <input type="file" placeholder="Uplode Report">
                            </form>
                            <button>Upload</button>
                        </div>
                    </div>
                    <div class="patient-test-data" id="upload-patient-test-data" style="display: none;">
                        <div class="patientInfo">
                            <img src="../public/img/lab_tech/profile.png" alt="profile">
                            <div class="infoDetail">
                                <p class="name">Ms. Shenaya Perera</p>
                                <p class="id">Patient ID-#12345</p>
                                <p class="age">22 years</p>
                            </div>
                        </div>
                        <hr>
                        <h1>Test (4)</h1>
                        <div class="test-details-box">
                            <div class="test-details">
                                <p class="test-descript">Test Description : <span style="font-weight: normal;">Sample here</span></p>
                                <p class="rest-data">Date : 10/10/2023</p>
                                <p class="rest-data">Refered by : Doctor name</p>
                                <p class="rest-data">Remarks : Docter comments here</p>
                            </div>
                            <div class="buttons">
                                <button style="background-color:#397A49;">Uploads Report</button><i class="fa-regular fa-trash-can"></i>
                                <button style="background-color: #0069FF;">Mark As Done</button>
                            </div>
                        </div>
                        <div class="test-details-box">
                            <div class="test-details">
                                <p class="test-descript">Test Description : <span style="font-weight: normal;">Sample here</span></p>
                                <p class="rest-data">Date : 10/10/2023</p>
                                <p class="rest-data">Refered by : Doctor name</p>
                                <p class="rest-data">Remarks : Docter comments here</p>
                            </div>
                            <div class="buttons" id="buttons">
                                <button  id="upload-button" style="background-color:#397A49;">Uploads Report</button>
                                <button style="background-color: #0069FF;">Mark As Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function (){
            const viewtestbutton=document.querySelectorAll("td button");
            const patienttestdata=document.getElementById("patient-test-data");
            const patientdetails = document.getElementById("patientSearch");
            const uploadbutton = patienttestdata.querySelector(".buttons button");
            // const markbutton=patienttestdata.querySelector(".mark");
            const uploadmodel=document.getElementById("upload-model");
            const closebutton=uploadmodel.querySelector(".close");

            const modeluploadbutton=uploadmodel.querySelector(".model-content button");
            const uploadedcontent=document.getElementById("upload-patient-test-data");

            viewtestbutton.forEach(button =>{
                button.addEventListener("click",()=>{
                    patienttestdata.style.display="block";
                    patientdetails.style.display="none";
                    uploadmodel.style.display="none";
                })
            });

            uploadbutton.addEventListener("click",()=>{
                patientdetails.style.display="none";
                patienttestdata.style.display="block";
                uploadmodel.style.display="block";
                
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
                uploadedcontent.style.display="block";
                patientdetails.style.display="none";
                patienttestdata.style.display="none";
            })
        });
    </script>
</body>
</html>
