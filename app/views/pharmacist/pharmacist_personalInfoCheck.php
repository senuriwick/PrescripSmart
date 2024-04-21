<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>pharmacist personalDetails</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_personalInfoCheck.css" />
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

                <a href="<?php echo URLROOT ?>/Pharmacist/dashboard" class="active"><img src="<?php echo URLROOT?>/app/views/pharmacist/images/patient2.png" alt="" class="pat">Patients</a>
                <a href="<?php echo URLROOT ?>/Pharmacist/medications"><img src="<?php echo URLROOT?>/app/views/pharmacist/images/syringe.png" alt="" class="pat">Medications</a>
                <a href="<?php echo URLROOT ?>/Pharmacist/profile"><img src="<?php echo URLROOT?>/app/views/pharmacist/images/man.png" alt="" class="pat">Profile</a>
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

            <?php $pharmacist = $data['pharmacist'] ?>
            <?php $user = $data['user'] ?>


            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT?>/app/views/pharmacist/images/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name"><?php echo $pharmacist->display_name ?></p>
                            <p class="role"><?php echo $user->role ?></p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/profile">Account</a></p>
                        <p><a href="" style="color: black;font-weight: 500;">Personal Info</a></p>
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/security">Security</a></p>
                    </div>

                    
                    <div class="inquiriesDiv">
                    <form action="<?php echo URLROOT; ?>/pharmacist/personalInfoUpdate" method="POST">
                        <h1>Pharmacist ID: #
                            <?php echo $pharmacist->pharmacist_id ?>
                        </h1>
                        <p class="sub1" style="font-weight: bold;">Personal Information</p>
                        <div class="accInfo">
                            <div class="parallel">

                                <div class="input-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fName" name="fName" class="input"
                                        style="display: inline-block;" value="<?php echo $pharmacist->first_name; ?>">
                                    <!-- <img src="<?php echo URLROOT; ?>\public\img\patient\pencilsquare-6QZ.png" alt="edit-icon"> -->
                                </div>
                                <div class="input-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lName" name="lName" class="input"
                                        style="display: inline-block;" value="<?php echo $pharmacist->last_name; ?>">
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="displayname">Display Name</label>
                                <input type="text" id="displayName" name="displayName" class="input"
                                    value="<?php echo $pharmacist->display_name; ?>">
                                <p class="text">*The name displayed on your dashboard</p>
                            </div>
                            <div class="input-group">
                                <label for="address">Home Address</label>
                                <input type="text" id="address" name="address" class="input2"
                                    value=" <?php echo $pharmacist->home_address; ?>">
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">National Identity Card No.</label>
                                    <input type="text" id="nic" name="nic" class="input"
                                        style="display: inline-block;" value="<?php echo $pharmacist->nic; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="contactno">Contact Number</label>
                                    <input type="text" id="contact" name="contact" class="input"
                                        style="display: inline-block;" value="<?php echo $pharmacist->contact_number; ?>">
                                </div>
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">Pharmacist Registration NO</label>
                                    <input type="text" id="regNo" name="regNo" class="input"
                                        style="display: inline-block;" value="<?php echo $pharmacist->pharmacist_registrationNo; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="address">Qualifications</label>
                                    <input type="text" id="qualification" name="qualification" class="input"
                                        value=" <?php echo $pharmacist->qualifications; ?>">
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="submit" name="submit">SAVE CHANGES</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>