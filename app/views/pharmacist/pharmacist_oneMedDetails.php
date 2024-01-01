<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Pharmacist One Med Details</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_oneMedDetails.css" />
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
                        <p><a href="reports.html" style="color: black; font-weight: 500;">Medications</a></p>
                    </div>
                    
                    <div class="patientSearch">
                        <div class="patient-div">
                            <a href="<?php echo URLROOT; ?>/Pharmacist/medications">
                                <img
                                  class="vector"
                                  src="<?php echo URLROOT?>/app/views/pharmacist/images/vector.png"
                                  alt="Sample Image"
                                />
                            </a>
                            <p class="med"> Medication Name : <?php echo isset($_GET['name']) ? $_GET['name']:''; ?></p>
                            <p>Status: <span class="stock"><?php echo isset($_GET['status']) ? $_GET['status']:''; ?></span></p>
                        </div>  
                    
                            <p>Reference No: <span><?php echo isset($_GET['id']) ? $_GET['id']: ''; ?></span></p>
                   
                            <p>Batch No: <span><?php echo isset($_GET['batch_number']) ? $_GET['batch_number']:''; ?></span></p>
               
                            <p>Expiry Date: <span><?php echo isset($_GET['expiry_date']) ? $_GET['expiry_date'] : '12/05/2024'; ?></span></p>
                        </div>
                        <div class="quantity">
                            <p>Qty in Stock: </p>
                            <button><img src="<?php echo URLROOT?>/app/views/pharmacist/images/minus.png" alt=""></button>
                            <input type="text" id="searchBar" name="search" value="<?php echo isset($_GET['quantity']) ? $_GET['quantity']:''; ?>">
                            <button><img src="<?php echo URLROOT?>/app/views/pharmacist/images/plus.png" alt=""></button>
                        </div>
                        <a href=""><button id="redButton">Mark as Out of Stock</button></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>