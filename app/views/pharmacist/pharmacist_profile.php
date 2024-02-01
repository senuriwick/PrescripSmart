<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Pharmacist profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_profile.css" />
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

                <a href="<?php echo URLROOT ?>/Pharmacist/dashboard">Patients</a>
                <a href="<?php echo URLROOT ?>/Pharmacist/medications">Medications</a>
                <a href="#">Profile</a>
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
                    <img src="<?php echo URLROOT?>/app/views/pharmacist/images/user.png"alt="user-icon">
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
                        <p><a href="" style="color: black;font-weight: 500;">Account</a></p>
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/personal">Personal Info</a></p>
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/security">Security</a></p>
                    </div>

                    <div class="pharmacistprofile">
                        <div class="empid">Employee Id <span><?php echo $data['pharmacistProfile']->employee_id; ?></span>
                            <div class="accountinfotext">Account Information</div>
                        </div>
                        <hr />
                        <div class="detail">
                            <div>
                                <form>
                                    <label>Username</label><br>
                                    <input type="text" placeholder="<?php echo $data['pharmacistProfile']->username; ?>">
                                </form>
                            </div>
                            <div>
                                <form>
                                    <label>Associated EmailAddress/phoneNumber</label><br>
                                    <input type="text" placeholder="<?php echo $data['pharmacistProfile']->email_phone; ?>">
                                </form>
                            </div>
                            <div>
                                <form>
                                    <label>Current Password</label><br>
                                    <input type="password" placeholder="<?php echo $data['pharmacistProfile']->password; ?>">
                                </form>
                            </div>
                        </div>
                        

                        <hr/>
                        <div class="detail">
                            <form id="passwordForm" action="<?php echo URLROOT; ?>/Pharmacist/updatePassword" method="post">
                                <div>

                                    <label>New password</label><br>
                                    <input type="password" id="newPassword" name="newPassword" placeholder="********">
                                    </form>
                                    
                                </div>
                                <div>
                                    <form action=""><label>Confirm password</label><br>
                                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="**********"></form>
                                </div>
                                <button type="button" onclick="validatePasswords()">SAVE CHANGES</button>
                            </form>
                        </div>

                        <script src="<?php echo URLROOT; ?>/public/js/pharmacist/profile.js"></script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>