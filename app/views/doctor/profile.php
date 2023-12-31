<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Doctor profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../public/css/doctor/profile.css" />
    <link rel="stylesheet" href="../public/css/doctor/sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="../public/img/doctor/Untitled design (5) copy 2.png" />
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

                <a href="<?php echo URLROOT;?>/doctor/patients" class="active">Patients</a>
                <a href="<?php echo URLROOT;?>/doctor/viewOngoingSession">Ongoing Sessions</a>
                <a href="<?php echo URLROOT;?>/doctor/sessions">Sessions</a>
                <a href="<?php echo URLROOT;?>/doctor/profile">Profile</a>
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
                    <img src="../public/img/doctor/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="../public/img/doctor/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Doctor Name</p>
                            <p class="role">Doctor</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT;?>/doctor/profile">Account</a></p>
                        <p><a href="<?php echo URLROOT;?>/doctor/personalInfo">Personal Info</a></p>
                        <p><a href="#">Security</a></p>
                    </div>

                    <div class="doctorprofile">
                        <div class="empid">Employee Id :#123456
                            <div class="accountinfotext">Account Information</div>
                        </div>
                        <hr />
                        <div class="detail">
                            <div>Username
                                <div class="test-box">
                                    <div class="test-box-data">
                                        Shanika Ayasmanthi<i class="fa-solid fa-pen"></i>
                                    </div>
                                </div>
                            </div>
                            <div>Associated Email Address/ Phone Number
                                <div class="test-box">
                                    011456875
                                </div>
                            </div>
                            <div>Current password
                                <div class="test-box">
                                    **********
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="detail">
                            <div>
                                <form>
                                    <label>New password</label><br>
                                    <input type="password" placeholder="********">
                                </form>
                            </div>
                            <div>
                                <form>
                                    <label>Confirm password</label><br>
                                    <input type="password" placeholder="**********">
                                </form>
                            </div>
                            <div><button>SAVE CHANGES</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>