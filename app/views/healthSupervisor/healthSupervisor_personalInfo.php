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
                    <img src="<?php echo URLROOT?>/app/views/pharmacist/images/user.png"alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT?>/app/views/pharmacist/images/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Health Supervisor Name</p>
                            <p class="role">Health Supervisor</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT ?>/HealthSupervisor/profile">Account</a></p>
                        <p><a href="" style="color: black;font-weight: 500;">Personal Info</a></p>
                        <p><a href="<?php echo URLROOT ?>/HealthSupervisor/security">Security</a></p>
                    </div>

                    <div class="pharmacist_profile">
                        <div class="empid">Employee Id :#123456
                            <div class="accountinfotext">Account Information</div>
                        </div>
                        <hr />
                        <div class="details">
                            <form>
                                <label for="">First Name</label><br>
                                <input type="text" placeholder="First name">
                            </form>
                            <form>
                                <label for="">Last Name</label><br>
                                <input type="text" placeholder="Last name">
                            </form>
                        </div>
                        <div class="details">
                            <form>
                                <label for="">Display Name</label><br>
                                <input type="text" placeholder="Display name">
                            </form>
                        </div>
                        <p>This will be how your name will be displayed in the dashboard.</p>
                        <div class="details">
                            <form>
                                <label for="">Home Address</label><br>
                                <input type="text" placeholder="Home Address">
                            </form>
                        </div>
                        <div class="details">
                            <form>
                                <label for="">NIC  Number</label><br>
                                <input type="number" placeholder="200045465455">
                            </form>
                            <form>
                                <label for="">Contact Number</label><br>
                                <input type="tel" placeholder="0214569889">
                            </form>
                        </div>
                        <div class="details">
                            <form>
                                <label for="">Doctor Registration Number</label><br>
                                <input type="number" placeholder="548968451">
                            </form>
                            <form>
                                <label for="">Qualification</label><br>
                                <input type="text" placeholder="Qualification">
                            </form>
                        </div>
                        <div class="details">
                            <form>
                                <label for="">Department</label><br>
                                <input type="text" placeholder="Department">
                            </form>
                            <form>
                                <label for="">Specialization</label><br>
                                <input type="text" placeholder="Specialization">
                            </form>
                        </div>
                        <div class="details">
                            <button>Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>