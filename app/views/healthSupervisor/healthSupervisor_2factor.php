<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Pharmacist 2Factor</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_2factor.css" />
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

        <?php $user = $data['user']; ?>
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
                        <p><a href="<?php echo URLROOT ?>/HealthSupervisor/personal">Personal Info</a></p>
                        <p><a href="" style="color: black; font-weight: 500;">Security</a></p>
                    </div>

                    <div class="pharmacistprofile">
                        <div class="empid">Employee Id :#123456
                            <div class="accountinfotext">Security Information</div>
                        </div>
                        <hr />
                        <div class="detail">
                            <div>
                                <form>
                                    <label>Method of Sign In</label><br>
                                    <input type="text" placeholder="<?php echo $user->signIn_method; ?>">
                                </form>
                            </div>
                            <div>
                                <form class="sample_username">
                                    <input type="text" placeholder="<?php echo $user->email_phone; ?>">
                                </form>
                            </div>
                       
                        </div>
                        
                        <hr/>
                        <div class="detail">
                            <div>
                                <form>
                                    <label>Two-Factor Authentication</label><br>
                                </form>
                                <p class="text">Add an extra layer of security to your account. To sign in, you'll need to provide a code along with your username and password</p>

                                <label class="switch">
                                <input type="checkbox" id="toggleTwoFactorAuth" <?php echo $user->two_factor_auth == 'ON' ? 'checked' : ''; ?> >
                                <span class="slider round"></span>
                            </label>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>