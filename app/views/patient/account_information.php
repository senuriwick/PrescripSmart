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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                <?php $patient = $data['patient'] ?>

                <div class="inquiriesDiv">
                    <h1>Patient ID: #
                        <?php echo $patient->patient_ID ?>
                    </h1>
                    <p class="sub1" style="font-weight: bold;">Account Information</p>

                    <div class="accInfo">
                        <form action="<?php echo URLROOT; ?>/patient/accountInfoUpdate" method="POST">
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="name">Username</label>
                                    <input type="text" id="username" class="input" name="username"
                                        value="<?php echo $patient->username ?>" style="display: inline-block;">
                                </div>
                                <div class="input-group">
                                    <label for="email">Associated Email Address/Phone Number</label>
                                    <?php if ($patient->signIn_Method == "email"): ?>
                                        <input type="text" id="email" class="input" name="email" readonly
                                            value="<?php echo $patient->email_address ?>" style="display: inline-block;">
                                    <?php else: ?>
                                        <input type="text" id="phone" class="input" name="phone" readonly
                                            value="<?php echo $patient->contact_Number ?>" style="display: inline-block;">
                                    <?php endif; ?>
                                </div>

                            </div>
                            <button type="submit" id="submit">SAVE CHANGES</button>
                        </form>
                    </div>

                    <p class="sub2" style="font-weight: bold;">Reset Password</p>
                    <div class="accInfo">
                        <form action="<?php echo URLROOT; ?>/patient/passwordReset" method="POST">
                            <div class="input-group">
                                <label for="password">Current Password</label>
                                <input type="password" id="password" placeholder="Enter your current password here"
                                    name="password" class="input">
                            </div>
                            <div id="passwordMatch"></div>

                            <div class="parallel">

                                <div class="input-group">
                                    <label for="newpassword">New Password</label>
                                    <input type="password" id="newpassword" class="input"
                                        placeholder="Enter your new password here" name="newpassword"
                                        style="display: inline-block;">
                                </div>

                                <div class="input-group">
                                    <label for="newconfirmpassword">Confirm Password</label>
                                    <input type="password" id="confirmpassword" class="input"
                                        placeholder="Re-enter your new password here" name="confirmpassword"
                                        style="display: inline-block;">
                                </div>
                            </div>
                            <div id="newpasswordMatch"></div>
                            <button type="submit" id="reset">RESET PASSWORD</button>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>
    </div>
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var inputFields = document.querySelectorAll('input[type="text"], input[type="number"], input[type="date"]');
            var submitBtn = document.getElementById('submit');

            inputFields.forEach(function (input) {
                input.addEventListener('input', function () {
                    submitBtn.style.backgroundColor = "#0069FF";
                    submitBtn.style.borderColor = "#0069FF";
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            function checkPasswords() {
                var enteredPassword = $('#password').val();
                var databasePassword = "<?php echo $patient->password ?>";
                var newPassword = $('#newpassword').val();
                var confirmPassword = $('#confirmpassword').val();

                if (newPassword !== '' && confirmPassword !== '') {
                    if (enteredPassword === databasePassword) {
                        $('#passwordMatch').text("You're good to go!").css({ 'color': 'green' });
                    } else {
                        $('#passwordMatch').text("Incorrect password!").css({ 'color': 'red' });
                    }

                    if (newPassword === confirmPassword) {
                        $('#newpasswordMatch').text("Passwords match!").css({ 'color': 'green' });;
                    } else {
                        $('#newpasswordMatch').text("Passwords do not match!").css({ 'color': 'red' });;
                    }
                } else {
                    $('#passwordMatch').text("");
                    $('#newpasswordMatch').text("");
                    $('#reset').prop('disabled', true).css({ 'background-color': 'lightgrey', 'border-color': 'lightgrey' });
                }

                if (newPassword === confirmPassword && enteredPassword === databasePassword) {
                    $('#reset').prop('disabled', false).css({ 'background-color': 'green', 'border-color': 'green' });
                } else {
                    $('#reset').prop('disabled', true).css({ 'background-color': 'lightgrey', 'border-color': 'lightgrey' });
                }
            }
            $('#password, #newpassword, #confirmpassword').on('input', checkPasswords);
        });

    </script>


</body>

</html>