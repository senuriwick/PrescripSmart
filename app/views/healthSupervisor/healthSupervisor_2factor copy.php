<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Health Supervisor 2Factor</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/healthSupervisor/healthSupervisor_2factor.css" />
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

            <?php $user = $data['user'] ?>
            <?php $healthSupervisor = $data['healthSupervisor'] ?>

            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT?>/app/views/pharmacist/images/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name"><?php echo $healthSupervisor->display_name ?></p>
                            <p class="role"><?php echo $user->role ?></p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT ?>/HealthSupervisor/profile">Account</a></p>
                        <p><a href="<?php echo URLROOT ?>/HealthSupervisor/personal">Personal Info</a></p>
                        <p><a href="" style="color: black; font-weight: 500;">Security</a></p>
                    </div>

                    <div class="inquiriesDiv">
                <?php $user = $data['user'] ?>
                    <h1>Employee ID: #<?php echo $user->user_ID ?></h1>
                    <p class="sub1" style="font-weight: bold;">Security Information</p>
                    <div class="accInfo">
                    <div class="parallel">
                            <div class="input-group">
                                <label for="name">Method of Sign-In</label>
                                <input type="text" id="method" class="input" style="display: inline-block;" value="<?php echo $user->method_of_signin ?>" readonly>
                            </div>
                            <div class="input-group">
                                <label for="email">Email/Phone Number</label>
                                <input type="text" id="email_phone" class="input" style="display: inline-block;"
                                    value="<?php echo $user->email_phone ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h4>Two-factor Authentication</h3>
                            <p class="para">Add an extra layer of security to your account. To sign in, you'll need to
                                provide a code along with your username and password.</p>
                            <label class="switch">
                                <input type="checkbox" id="toggleTwoFactorAuth" <?php echo $user->two_factor_auth == 'on' ? 'checked' : ''; ?>>
                                <span class="slider round"></span>
                            </label>
                    </div>
                </div>
                
            </div>
                    
                    
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
    </script>

    <script>
    $(document).ready(function () {
        $('#toggleTwoFactorAuth').change(function () {
            var toggleState = $(this).is(':checked') ? 'ON' : 'OFF';
            var user_ID = '<?php echo $user->user_id ?>';

            $.ajax({
                url: '<?php echo URLROOT?>/healthSupervisor/toggle2FA',
                method: 'POST',
                dataType: 'json',
                data: {
                    toggle_state: toggleState,
                    userID: user_ID
                },
                success: function (response) {
                    if (response.success) {
                        console.log('Toggle state changed successfully');
                    } else {
                        console.error('Error: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                }
            });
        });
    });

    </script>