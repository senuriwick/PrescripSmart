<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Account</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\patient\profile_dashboard.css" />
</head>

<body>

    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT; ?>\public\img\patient\Untitled design (5) copy 2.png" />
            </div>

            <!-- <div class="patientDiv">
                <p class="mainOptions">PATIENT</p>

                <div class="profile">
                    <p>username</p>
                </div>
            </div> -->

            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="prescriptions_dashboard.html" id="prescriptions">Prescriptions</a>
                <a href="reports_dashboard.html" id="reports">Reports</a>
                <a href="appointments_dashboard.html" id="appointments">Appointments</a>
                <a href="inquiries_dashboard.html" id="inquiries">Inquiries</a>
                <a href="profile_dashboard.html" id="profile">Profile</a>
            </div>

            <div class="othersDiv">
                <a href="billing.html" id="billing">Billing</a>
                <a href="terms_of_service.html" id="terms">Terms of Service</a>
                <a href="privacy_policy.html" id="privacy">Privacy Policy</a>
            </div>
        </div>

        <div class="main">
            <div class="navBar">
                <img src="<?php echo URLROOT; ?>\public\img\patient\user.png" alt="user-icon">
                <p>SAMPLE USERNAME HERE</p>
            </div>

            <div class="patientInfoContainer">
                <div class="patientInfo">
                    <img src="<?php echo URLROOT; ?>\public\img\patient\profile.png" alt="profile-pic">
                    <div class="patientNameDiv">
                        <p class="name">Patient Name</p>
                        <p class="role">Patient</p>
                    </div>
                </div>

                <div class="menu">
                    <a href="profile_dashboard.html" id="account">Account</a>
                    <a href="profile_dashboard_2.html" id="personalinfo">Personal Info</a>
                    <a href="profile_dashboard_3.html" id="security">Security</a>
                </div>

                <div class="inquiriesDiv">
                    <h1>Patient ID: #1248623</h1>
                    <p class="sub1" style="font-weight: bold;">Account Information</p>
                    <div class="accInfo">
                        <div class="parallel">
                        <div class="input-group">
                            <label for="name">Username</label>
                            <input type="text" id="name" class="input" style="display: inline-block;">
                        </div>
                        <div class="input-group">
                            <label for="email">Associated Email Address/Phone Number</label>
                            <input type="text" id="email" class="input" style="display: inline-block;">
                        </div>
                        </div>
                        <div class="input-group">
                            <label for="password">Current Password</label>
                            <input type="password" id="password" class="input">
                        </div>
                    </div>

                    <p class="sub2" style="font-weight: bold;">Password Change</p>
                    <div class="accInfo">
                        <div class="parallel">
                        <div class="input-group">
                            <label for="newpassword">New Password</label>
                            <input type="password" id="pass" class="input" style="display: inline-block;">
                        </div>
                        <div class="input-group">
                            <label for="newconfirmpassword">Confirm Password</label>
                            <input type="password" id="cofirmpass" class="input" style="display: inline-block;">
                        </div>
                        </div>
                        <button type="button" id="submit">SAVE CHANGES</button>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>
</body>

</html>