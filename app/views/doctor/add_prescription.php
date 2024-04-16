<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Add Prescription</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/add_prescription.css" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/sideMenu_navBar.css" />
    <script src="<?php echo URLROOT;?>/public/js/doctor/main.js"></script>
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
                            <p class="name"><?php echo $data['patient']->patient_name;?></p>
                            <p class="role">Patient</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT; ?>/doctor/viewPrescriptions/<?php echo $data['patient']->patient_id;?>">Prescription</a></p>
                        <p><a href="<?php echo URLROOT;?>/doctor/viewReports/<?php echo $data['patient']->patient_id;?> ">Reports</a></p>
                    </div>

                    <div class="patientSearch">
                        <div class="topic">
                            <i class="fa-solid fa-arrow-left"></i>
                            <label>Patient Prescription</label>
                        </div>
                        <hr />
                        <div class="diagnosis">
                            <form  method="post">
                                <label><b>Diagnosis</b></label>
                                <input type="textbox" class="searchBar" placeholder="Enter diagnosis here....." />
                            </form>
                        </div>

                        <div class="medication">
                            <div class="medication-head">
                                <lable><b>+ Medication</b></lable>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="medication-form">
                                <form>
                                    <input type="text" oninput="getsearchResults(this.value)" id="searchtext" class="search-medication" 
                                        placeholder="Search medication name here" />
                                    <hr />
                                    <div class="medication-suggetions" id="medication-suggetions">
                                        <p></p>
                                        <button>Add</button>
                                    </div>
                                    
                                </form>
                                <hr />
                                <div class="medication-added">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Medication Added 1</td>
                                                <td>Dosage</td>
                                                <td>Remarks</td>
                                                <td class="medication-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Medication Added 1</td>
                                                <td>Dosage</td>
                                                <td>Remarks</td>
                                                <td class="medication-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Medication Added 1</td>
                                                <td>Dosage</td>
                                                <td>Remarks</td>
                                                <td class="medication-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <div class="test">
                            <div class="test-head">
                                <lable><b>+ Add Lab Sessions</b></lable>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div class="test-form">
                                <form>
                                    <input type="text" class="search-test"
                                        placeholder="Search test name here" />
                                    <hr />
                                    <div class="test-suggetions">
                                        <p>Test Suggetion 01</p>
                                        <button>Add</button>
                                    </div>
                                    <div class="test-suggetions">
                                        <p>Test Suggetion 02</p>
                                        <button>Add</button>
                                    </div>
                                </form>
                                <hr />
                                <div class="test-added">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td>Test Added 1</td>
                                                <td><form action=""><input type="text" placeholder="Remarks"/></form></td>
                                                <td class="test-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Test Added 1</td>
                                                <td>Remarks</td>
                                                <td class="test-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Test Added 1</td>
                                                <td>Remarks</td>
                                                <td class="test-delete"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <div class="save-Btn">
                            <button>Save And Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //  document.addEventListener("DOMContentLoaded", function () {
        //     const searchInput = document.getElementById("searchtext");
        //     const medicationSuggestions = document.querySelector(".medication-suggestions");

        //     searchInput.addEventListener("input", function () {
        //         if (searchInput.value.trim() !== "") {
        //             medicationSuggestions.style.display = "block";
        //         } else {
        //             medicationSuggestions.style.display = "none";
        //         }
        //     });
    // });
        // document.addEventListener("DOMContentLoaded",function(){
        //     const searchInput = document.getElementById("searchtext");
        //     searchInput.addEventListener("input",function(){
        //         const searchTerm = searchInput.value.toLowerCase();
        //         const regex = new RegExp(searchTerm, 'i');
        //         const medicationRows = document.querySelectorAll(".medication-suggetions");
        //         medicationRows.foreach(function(div){
        //             const medicationName = div.getElementById("medication-name").textContent.toLowerCase();
        //             if(regex.test(medicationName)){
        //                 div.style.display = "div";
        //             }else{
        //                 div.style.display="none";
        //             }

        //         });

        //     });
        // });
            function getsearchResults(query){
                if(query.length >=1){
                    fetch(`<?php URLROOT;?>/doctor/searchMedication?query=${query}`)
                    .then(response => response.json())
                    .then(data => showsearchResults(data))
                    .catch(error => .console.error('Error:',error));
                }else {
                    hidesearchResults();
                }
            }

            function showsearchResults(results){
                const resultsContainer = document.getElementById('medication-suggetions');
                resultsContainer.innerHTML = '';

                if(results.length >0){
                    results.forEach(result => {
                        const item = document.createElement('div');
                        item.classList.add('medication-suggetions-item');
                        item.textContent = result.value;

                        item.addEventListner('click' ,() => {
                            document.getElementById('searchtext').value = result.value;
                            hidesearchResults();

                    });
                    resultsContainer.appendChild(item);

                    });
                    resultsContainer.style.display = 'block';
                }else{
                    hidesearchResults();
                }
            }

            function hidesearchResults(){
                documnet.getElementById('medication-suggetions').style.display = 'none';
            }
    </script>    
</body>