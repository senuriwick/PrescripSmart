<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Pharmacist New Med</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_newMed.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT?>/app/views/pharmacist/images/logo.png" />
            </div>

            <div class="userDiv">
                <p class="mainOptions">
                    <Datag>PHARMACIST</Datag>
                </p>
            </div>

            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="<?php echo URLROOT; ?>/Pharmacist/dashboard">Patients</a>
                <a href="">Medications</a>
                <a href="<?php echo URLROOT ?>/Pharmacist/profile">Profile</a>
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
                    <img src="<?php echo URLROOT?>/app/views/pharmacist/images/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT?>/app/views/pharmacist/images/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Pharmacist Name</p>
                            <p class="role">Pharmacist</p>
                        </div>
                    </div>

                    <div class="menu">
                    <p><a href="<?php echo URLROOT; ?>/Pharmacist/dashboard">Patients</a></p>
                        <p><a href="" style="color: black; font-weight: 500;">Medications</a></p>
                    </div>
                    <hr>
                    <div class="ashBlock">
                        <h2>Add new medication</h2>
                        <form method="post" action="<?php echo URLROOT; ?>/Pharmacist/insertNewMedication">
                            <div class="newRow">
                                <div>
                                    <div>
                                        <p>Name<span class="important">*</span></p>
                                        <input type="text" id="searchBar" name="name" placeholder="Enter medication Name" class="inputfield">
                                    </div>
                                    <div>
                                        <p>Expiry Date<span class="important">*</span></p>
                                        <input type="text" id="searchBar" name="expiry" placeholder="Enter Date(YYYY-MM-DD)" class="inputfield">
                                    </div>
                                    <div>
                                        <p>Quantity<span class="important">*</span></p>
                                        <input type="text" id="searchBar" name="quantity" placeholder="Enter Quantity" class="inputfield">
                                    </div>
                                    
                                </div>

                                <div class="rightDetails">
                                    <div>
                                        <p>Dosage<span class="important">*</span></p>
                                        <input type="text" id="searchBar" name="dosage" placeholder="Enter Dosage" class="inputfield">
                                    </div>

                                    <div>
                                        <p>Batch Number<span class="important">*</span></p>
                                        <input type="text" id="searchBar" name="batch" placeholder="Enter Batch Number">
                                    </div>

                                    <div>
                                        <p>Status<span class="important">*</span></p>
                                        <select id="searchBar" name="status">
                                            <option value="Inactive">Inactive</option>
                                            <option value="Active">Active</option>
                                            <option value="Out of Stock">Out of Stock</option>
                                        </select>
                                    </div>


                                    
                                </div>
                        
                            </div>
                            <button type="submit" id="addNew">ADD</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>