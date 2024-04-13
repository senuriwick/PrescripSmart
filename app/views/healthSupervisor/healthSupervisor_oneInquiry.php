<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>HealthSupervisor Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/healthSupervisor/healthSupervisor_oneInquiry.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT?>/public/img/healthSupervisor/logo.png" />
            </div>

            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="<?php echo URLROOT ?>/HealthSupervisor/dashboard">Inquiries</a>
                <a href="<?php echo URLROOT ?>/HealthSupervisor/history">History</a>
                <a href="<?php echo URLROOT ?>/HealthSupervisor/profile">Profile</a>
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
                    <img src="<?php echo URLROOT?>/public/img/healthSupervisor/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT?>/public/img/healthSupervisor/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">HealthSupervisor Name</p>
                            <p class="role">HealthSupervisor</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p style="color:black">Inquiries</p>
                        <p><a href="<?php echo URLROOT ?>/HealthSupervisor/history">History</a></p>
                    </div>
                    <hr class="divider">
                    <div class="patientFile">
                        <div class="patient-div">
                            <a href="<?php echo URLROOT ?>/HealthSupervisor/dashboard">
                                <img
                                class="vector"
                                src="<?php echo URLROOT?>/app/views/pharmacist/images/vector.png"
                                alt="Sample Image"
                                />
                            </a>
                            <h2>Inquiries(5)</h2>
                            <button id="mark">Mark As Read</button>
                        </div>  

                        <?php if (isset($data['inquiry'])) : ?>
                        <?php $inquiry = $data['inquiry'] ?>
                        <div class="row">
                            <div>
                                <p class="label">Email Address</p>
                                <input type="text" id="searchBar" name="name" placeholder="<?php echo $inquiry -> email ?>" class="inputfield">
                            </div>
                            <div>
                                <p class="label">Name</p>
                                <input type="text" id="searchBar" name="name" placeholder="<?php echo $inquiry -> name ?>" class="inputfield">
                            </div>
                        </div>
                        <div>
                            <p class="label">Message</p>
                            <textarea id="searchBar" name="name" placeholder="<?php echo $inquiry -> message ?>" class="inputfield"></textarea>
                        </div>

                        <?php else : ?>
                         <p>No inquiry details found.</p>
                        <?php endif; ?>
                        
                        <a href="<?php echo URLROOT ?>/HealthSupervisor/markAsRead?id=<?php echo $inquiry -> inquiry_ID; ?>"><button class="reply">Reply</button>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>