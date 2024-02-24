<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Security</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\nurse\profile_dashboard_3.css" />
</head>

<body>

    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT ?>\public\img\nurse\Untitled design (5) copy 2.png" />
            </div>

            <!-- <div class="patientDiv">
                <p class="mainOptions">PATIENT</p>

                <div class="profile">
                    <p>username</p>
                </div>
            </div> -->

            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>
                <a href="patients_dashboard.html" id="patients">Patients</a>
                <a href="ongoing.html" id="On-going">On-going session</a>
                <a href="sessions.html" id="sessions">Sessions</a>
                <a href="appointments.html" id="appointments">Appoinments</a>
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
                <img src="<?php echo URLROOT ?>\public\img\nurse\user.png" alt="user-icon">
                <p>SAMPLE USERNAME HERE</p>
            </div>

            <div class="patientInfoContainer">
                <div class="patientInfo">
                    <img src="<?php echo URLROOT ?>\public\img\nurse\profile.png" alt="profile-pic">
                    <div class="patientNameDiv">
                        <p class="name">Nurse Name</p>
                        <p class="role">Nurse</p>
                    </div>
                </div>

                <div class="menu">
                    <a href="profile_dashboard.html" id="account">Account</a>
                    <a href="profile_dashboard_2.html" id="personalinfo">Personal Info</a>
                    <a href="profile_dashboard_3.html" id="security">Security</a>
                </div>

                <div class="inquiriesDiv">
                <?php $user = $data['user'] ?>
                    <h1>Employee ID: #<?php echo $user->user_ID ?></h1>
                    <p class="sub1" style="font-weight: bold;">Security Information</p>
                    <div class="accInfo">
                    <div class="parallel">
                            <div class="input-group">
                                <label for="name">Method of Sign-In</label>
                                <input type="text" id="method" class="input" style="display: inline-block;" value=<?php echo $user->method_of_signin ?>>
                            </div>
                            <div class="input-group">
                                <label for="email">Email/Phone Number</label>
                                <input type="text" id="email_phone" class="input" style="display: inline-block;"
                                    value=<?php echo $user->email_phone ?>>
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
        </div>

    </div>
    </div>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#toggleTwoFactorAuth').change(function () {
            var toggleState = $(this).is(':checked') ? 'on' : 'off';
            var user = '<?php echo $user->user_ID?>';
            var user_ID = user;

            $.ajax({
                url: '<?php echo URLROOT?>/nurse/toggle2FA',
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

</body>

</html>