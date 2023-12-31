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
    <link rel="stylesheet" href="../public/css/doctor/personalinfo.css" />
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
                <a href="<?php echo URLROOT;?>/doctor/viewReports">Sessions</a>
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