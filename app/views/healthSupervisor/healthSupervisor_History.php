<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>HealthSupervisor History</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/healthSupervisor/healthSupervisor_History.css" />
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
                <a href="">History</a>
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
                        <p><a href="<?php echo URLROOT ?>/HealthSupervisor/dashboard">Inquiries</a></p>
                        <p style="color:black">History</p>
                    </div>
                    <hr class="divider">
                    <div class="patientFile">
                        <h2>Inquiries History(<?php echo $data['count'] ?>)</h2>
                        <?php foreach($data['inquiries'] as $readInquiry): ?>
                        <div class="inquiry">
                          <img src="<?php echo URLROOT?>/public/img/healthSupervisor/envelope.png" alt="">
                          <p id="idNO"><?php echo $readInquiry->inquiry_ID ?></p>
                          <p><?php echo $readInquiry->name ?></p>
                          <p><?php echo $readInquiry->Date ?></p>
                          <input type="checkbox" id="scales" name="scales" checked />
                        </div>
                        <?php endforeach ?>
                        
                    
                </div>
            </div>
        </div>
    </div>
</body>