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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/doctor/add_prescription.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/doctor/sideMenu_navBar.css" />
    <script src="<?php echo URLROOT; ?>/public/js/doctor/main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT; ?>/public/img/doctor/Untitled design (5) copy 2.png" />
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
                <div class="navBar">
                    <img src="<?php echo URLROOT; ?>/public/img/doctor/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT; ?>/public/img/doctor/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name"><?php echo $data['patient']->display_Name; ?></p>
                            <p class="role">Patient</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT; ?>/doctor/viewPrescriptions/<?php echo $data['patient']->patient_ID; ?>">Prescription</a></p>
                        <p><a href="<?php echo URLROOT; ?>/doctor/viewReports/<?php echo $data['patient']->patient_ID; ?> ">Reports</a></p>
                    </div>

                    <div class="patientSearch">
                        <div class="topic">
                            <i class="fa-solid fa-arrow-left"></i>
                            <label>Patient Prescription</label>
                        </div>
                        <hr />
                        <form action="<?php echo URLROOT; ?>/doctor/addMedication" method="POST" autocomplete="off">
                            <div class="diagnosis">
                                <label><b>Diagnosis</b></label>
                                <input type="textbox" name="diagnosis" class="searchBar" placeholder="Enter diagnosis here....." />
                            </div>

                            <div class="medication">
                                <div class="medication-head">
                                    <lable><b>Medication</b></lable>
                                </div>
                                <div class="medication-form">
                                    <input type="text" id="searchtext" class="search-medication" oninput="getSearchResults(this.value)" placeholder="Search medication name here">
                                    <div id="searchResults" class="search-results"></div>
                                    <select id="remarks" class="remarks" name="remarks">
                                        <option value="">Select a remark</option>
                                        <option value="52/1">52/1</option>
                                        <option value="12/1">12/1</option>
                                        <option value="42/1">42/1</option>
                                        <option value="52/2">52/2</option>
                                    </select>
                                    <button id="btn-medication-add" class="btn-medication-add" onclick="addMedication(event);">Add</button>
                                    <hr />
                                    <div class="medication-added">
                                        <table id="medication-table" class="medication-table">
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="test">
                                <div class="test-head">
                                    <lable><b>Add Lab Sessions</b></lable> 
                                    <i id="toggleIcon" class="fa-solid fa-chevron-down" style="cursor: pointer;" onclick="toggleTestForm();"></i>
                                </div>
                                <div class="test-form" id="testForm" style="display:none;">
                                    <input type="text" id="searchtest" class="search-test" oninput="getSearchTest(this.value)" placeholder="Search test name here" />
                                    <div id="testResults" class="test-results"></div>
                                    <input type="text" id=testremarks class="remarks" placeholder="Remarks">
                                    <button id="btn-test-add" class="btn-test-add" onclick="addTest(event);">Add</button>
                                    <hr />
                                    <div class="test-added">
                                        <table id="test-table">
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <input type="hidden" name="patientId" value="<?php echo $data['patient']->patient_ID ?>" />
                            </div>
                            <div class="save-Btn">
                                <button type="submit">Save And Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getSearchResults(query) {
            if (query.length >= 1) {
                fetch(`http://localhost/Prescripsmart/doctor/searchMedication?query=${query}`)
                    .then(response => {
                        console.log(response);
                        return response.json();
                    })
                    .then(data => {
                        showSearchResults(data);
                        console.log(data);
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                hideSearchResults();
            }
        }

        function showSearchResults(results) {
            const resultsContainer = document.getElementById('searchResults');
            resultsContainer.innerHTML = '';

            if (results.length > 0) {
                results.forEach(result => {
                    const item = document.createElement('div');
                    item.classList.add('search-results-item');
                    item.textContent = result.material_Description;

                    item.addEventListener('click', () => {
                        document.getElementById('searchtext').value = result.material_Description;
                        hideSearchResults();
                    });

                    resultsContainer.appendChild(item);
                });

                resultsContainer.style.display = 'block';
            } else {
                hideSearchResults();
            }
        }

        function hideSearchResults() {
            document.getElementById('searchResults').style.display = 'none';
        }

        function addMedication(event) {
            event.preventDefault();

            var table = document.getElementById("medication-table");
            var rowCount = table.rows.length;

            var medications = document.getElementById("searchtext").value;
            var remarks = document.getElementById("remarks").value;
            if (!medications) {
                alert("Please enter the medications");
                return;
            } else if (!remarks) {
                alert("Please enter the remarks");
                return;
            }
            if (medications && remarks) {
                var newRow = table.insertRow(rowCount);
                var medicationCell = newRow.insertCell(0);
                var remarkCell = newRow.insertCell(1);
                var deleteCell = newRow.insertCell(2);
                medicationCell.innerHTML = `<input type="text" name="medications[]" value="${medications}" readonly>`;
                remarkCell.innerHTML = `<input type="text" name="remarks[]" value="${remarks}" readonly>`;


                var deleteBtn = document.createElement('i');
                deleteBtn.className = 'fa-solid fa-trash';
                deleteBtn.style.cursor = 'pointer';
                deleteBtn.onclick = function() {
                    removeRow(this);
                };
                deleteCell.appendChild(deleteBtn);
            }

            deleteCell.classList.add("medication-delete");
            document.getElementById("searchtext").value = "";
            document.getElementById("remarks").value = "";
        }

        function removeRow(deleteBtn) {
            var row = deleteBtn.parentNode.parentNode;
            var table = row.parentNode;
            table.removeChild(row);
        }

        function toggleTestForm() {
            var testForm = document.getElementById("testForm");
            var toggleIcon = document.getElementById("toggleIcon");

            if (testForm.style.display === "none") {
                testForm.style.display = "block";
                toggleIcon.className = "fa-solid fa-chevron-up";
            } else {
                testForm.style.display = "none";
                toggleIcon.className = "fa-solid fa-chevron-down";
            }
        }

        function getSearchTest(query){
            if(query.length>=1){

                fetch(`http://localhost/Prescripsmart/doctor/searchTest?query=${query}`)
                .then(response =>{
                    console.log(response);
                    return response.json();
                })
                .then(data =>{
                    showTestResults(data);
                    console.log(data);
                })
                .catch(error =>console.error('Error:',error));
            }else{
                hideTestResults();
            }
        }

        function showTestResults(results){
            const resultsContent = document.getElementById('testResults');
            resultsContent.innerHTML = '';

            if(results.length > 0) {
                results.forEach(results => {
                    const item = document.createElement('div');
                    item.classList.add('test-results-item');
                    item.textContent = results.name;

                    item.addEventListener('click',() =>{
                        document.getElementById('searchtest').value = results.name;
                        hideTestResults();
                    });
                    resultsContent.appendChild(item);
                });

                resultsContent.style.display = 'block';
            }else{
                hideTestResults();
            }
        }

        function hideTestResults(){
            document.getElementById('testResults').style.display = 'none';
        }

        function addTest(event){
            event.preventDefault();

            var table = document.getElementById("test-table");
            var rowCount = table.rows.length;

            var tests = document.getElementById("searchtest").value;
            var testremarks = document.getElementById("testremarks").value;
            if(!tests){
                alert("Please enter the test");
                return;
            }

            if(tests){
                var newRow = table.insertRow(rowCount);
                var testCell = newRow.insertCell(0);
                var testremarkCell = newRow.insertCell(1);
                var deleteCell = newRow.insertCell(2);
                testCell.innerHTML = `<input type="text" name="tests[]" value="${tests}" readonly>`;
                testremarkCell.innerHTML = `<input type="text" name="testremarks[]" value="${testremarks}" readonly>`;

                var deleteBtn = document.createElement('i');
                deleteBtn.className = 'fa-solid fa-trash';
                deleteBtn.style.cursor = 'pointer';
                deleteBtn.onclick = function(){
                    removeRow(this);
                };
                deleteCell.appendChild(deleteBtn);
            }

            deleteCell.classList.add("test-delete");
            documnet.getElementById("searchtest").value = "";
            documnet.getElementById("testremarks").value ="";
        }

        function removeRow(deleteBtn){
            var row = deleteBtn.parentNode.parentNode;
            var table = row.parentNode;
            table.removeChild(row);
        }
    </script>
</body>