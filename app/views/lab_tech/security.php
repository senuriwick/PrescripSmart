<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Account Security</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../public/css/lab_tech/profile.css" />
    <link rel="stylesheet" href="../public/css/lab_tech/sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="../public/img/lab_tech/Untitled design (5) copy 2.png" />
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

                <a href="<?php echo URLROOT;?>/labTechnician/patients" class="active">Patients</a>
                <a href="<?php echo URLROOT;?>/labTechnician/profile">Profile</a>
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
                    <img src="../public/img/lab_tech/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="../public/img/lab_tech/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Lab Technician Name</p>
                            <p class="role">Lab Technician</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT;?>/labTechnician/profile">Account</a></p>
                        <p><a href="<?php echo URLROOT;?>/labTechnician/personalInfo">Personal Info</a></p>
                        <p><a href="<?php echo URLROOT;?>/labTechnician/security">Security</a></p>
                    </div>

                    <div class="labprofile">
                        <div class="empid">Employee Id :#123456
                            <div class="accountinfotext">Account Information</div>
                        </div>
                        <hr />
                        <div class="detail">
                            <div>
                                <form>
                                    <label>Method of Sign-In</label><br>
                                    <input type="email || phonenumber" placeholder="email">
                                </form>
                            </div>
                            <div>
                                <form>
                                    <label></label><br>
                                    <input type="email ||  phonenumber" placeholder="sample email or phone number here">
                                </form>
                            </div>
                            
                        </div>
                            <!-- <div>Current password
                                <div class="test-box">
                                    **********
                                </div>
                            </div> -->
                        <!-- </div> -->
                        <hr/>
                        <div class="detail">
                            <div>Two-factor Authentication
                            </div>
                        <br>
                        
                             <div style="color:#445172BF">
                            Add an extra layer of security to your account. To sign in, you'll need to provide a code along with your username and password.
                            </div><br>
                            <div class="detail"><div><button>SETUP 2FA</button></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>