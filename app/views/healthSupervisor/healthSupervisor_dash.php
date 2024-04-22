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
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/healthSupervisor/healthSupervisor_dash.css" />
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

                <a href="">Inquiries</a>
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

            <?php $user = $data['user'] ?>
            <?php $healthSupervisor = $data['healthSupervisor'] ?>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT?>/public/img/healthSupervisor/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name"><?php echo $healthSupervisor->display_name ?></p>
                            <p class="role"><?php echo $user->role ?></p>
                        </div>
                    </div>

                    <div class="menu">
                        <p style="color:black">Inquiries</p>
                        <p><a href="<?php echo URLROOT ?>/HealthSupervisor/history">History</a></p>
                    </div>
                    <hr class="divider">
                    <div class="patientFile">
                        <h2>Inquiries(<?php echo $data['totalNewInquiries'] ?>)</h2>
                        <?php foreach($data['newInquiries'] as $inquiry): ?>
                        <div class="inquiry">
                          <img src="<?php echo URLROOT?>/public/img/healthSupervisor/envelope.png" alt="">
                          <p id="idNO"><?php echo $inquiry->inquiry_ID; ?></p>
                          <p><?php echo $inquiry->name; ?></p>
                          <p><?php echo $inquiry->Date; ?></p>
                          <a href="<?php echo URLROOT ?>/HealthSupervisor/inquiryDetails?id=<?php echo $inquiry->inquiry_ID; ?>"><button>View</button></a>

                        </div>
                        <?php endforeach; ?>  
                    </div>
 
                    <div class="pagination">
                        <?php if (isset($data['totalPages'])): ?>
                            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                                <a href="<?php echo URLROOT; ?>/healthSupervisor/dashboard/<?php echo $i; ?>" <?php echo ($i == $data['currentPage']) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                
                </div>
            </div>
        </div>
    </div>