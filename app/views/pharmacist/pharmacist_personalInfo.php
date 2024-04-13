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
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_personalInfo.css" />
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
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/profile">Account</a></p>
                        <p><a href="" style="color: black;font-weight: 500;">Personal Info</a></p>
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/security">Security</a></p>
                    </div>

                    <?php $pharmacist = $data['pharmacist'] ?>

                    <form action="<?php echo URLROOT; ?>/pharmacist/personalInfoUpdate" method="POST">
                        <div class="pharmacist_profile">
                            <div class="empid">Employee Id :#123456
                                <div class="accountinfotext">Account Information</div>
                            </div>
                            <hr />
                            <div class="details">
                                <form>
                                    <label for="">First Name</label><br>
                                    <input type="text" id="fName" value="<?php echo $pharmacist->first_name; ?>">
                                </form>
                                <form>
                                    <label for="">Last Name</label><br>
                                    <input type="text" id="lName" value="<?php echo $pharmacist->last_name; ?>">
                                </form>
                            </div>
                            <div class="details">
                                <form>
                                    <label for="">Display Name</label><br>
                                    <input type="text" id="displayName"value="<?php echo $pharmacist->display_name; ?>">
                                </form>
                            </div>
                            <p>This will be how your name will be displayed in the dashboard.</p>
                            <div class="details">
                                <form>
                                    <label for="">Home Address</label><br>
                                    <input type="text" id="address" value="<?php echo $pharmacist->home_address; ?>">
                                </form>
                            </div>
                            <div class="details">
                                <form>
                                    <label for="">NIC  Number</label><br>
                                    <input type="text" id="nic" value="<?php echo $pharmacist->nic; ?>">
                                </form>
                                <form>
                                    <label for="">Contact Number</label><br>
                                    <input type="text" id="contact" value="<?php echo $pharmacist->contact_number; ?>">
                                </form>
                            </div>
                            <div class="details">
                                <form>
                                    <label for="">Pharmacist Registration Number</label><br>
                                    <input type="text" id="regNo" value="<?php echo $pharmacist->pharmacist_registrationNo; ?>">
                                </form>
                                <form>
                                    <label for="">Qualification</label><br>
                                    <input type="text" id="qualification" value="<?php echo $pharmacist->qualifications; ?>">
                                </form>
                            </div>
                            <div class="details">
                                <button>Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>