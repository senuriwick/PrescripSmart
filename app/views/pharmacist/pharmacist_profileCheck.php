<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Pharmacist profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_profile.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                <a href="<?php echo URLROOT ?>/Pharmacist/dashboard">Patients</a>
                <a href="<?php echo URLROOT ?>/Pharmacist/medications">Medications</a>
                <a href="#">Profile</a>
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
                        <p><a href="" style="color: black;font-weight: 500;">Account</a></p>
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/personal">Personal Info</a></p>
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/security">Security</a></p>
                    </div>

                <?php $patient = $data['userPharm'] ?>

                <div class="inquiriesDiv">
                    <h1>Patient ID: #
                        <?php echo $patient->user_id ?>
                    </h1>
                    <p class="sub1" style="font-weight: bold;">Account Information</p>

                    <div class="accInfo">
                        <form action="<?php echo URLROOT; ?>/pharmacist/accountInfoUpdate" method="POST">
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="name">Username</label>
                                    <input type="text" id="username" class="input" name="username"
                                        value="<?php echo $patient->username ?>" style="display: inline-block;">
                                </div>
                                <div class="input-group">
                                    <label for="email">Associated Email Address/Phone Number</label>
                                    <?php if ($patient->signIn_method == "email"): ?>
                                        <input type="text" id="email" class="input" name="email" readonly
                                            value="<?php echo $patient->email ?>" style="display: inline-block;">
                                    <?php else: ?>
                                        <input type="text" id="phone" class="input" name="phone" readonly
                                            value="<?php echo $patient->phoneNumber ?>" style="display: inline-block;">
                                    <?php endif; ?>
                                </div>

                            </div>
                            <button type="submit" id="submit">SAVE CHANGES</button>
                        </form>
                    </div>

                    <p class="sub2" style="font-weight: bold;">Reset Password</p>
                    <div class="accInfo">
                        <form action="<?php echo URLROOT; ?>/Pharmacist/passwordReset" method="POST">
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
    // Attach input event handler to the current password input field
    $('#password').on('input', function () {
        checkCurrentPassword();
    });

    // Attach input event handlers to new password and confirm password fields
    $('#newpassword, #confirmpassword').on('input', function () {
        checkPasswords();
    });

    function checkCurrentPassword() {
        var currentPassword = $('#password').val();

        $.ajax({
            url: '<?php echo URLROOT; ?>/Pharmacist/checkCurrentPassword',
            type: 'POST',
            data: { currentPassword: currentPassword },
            success: function (response) {
                $('#passwordMatch').html(response);

                // If the current password is correct, re-run the checkPasswords function
                if (response.trim().toLowerCase() === "you're good to go!") {
                    checkPasswords();
                }
            },
            error: function () {
                // Handle errors
            }
        });
    }

    function checkPasswords() {
        var newPassword = $('#newpassword').val();
        var confirmPassword = $('#confirmpassword').val();
        var passwordMatchMessage = $('#newpasswordMatch');
        var resetButton = $('#reset');

        // Check if new password and confirm password match
        if (newPassword === confirmPassword) {
            passwordMatchMessage.text("Passwords match!").css({ 'color': 'green' });

            // Enable the reset password button if new password and confirm password match
            resetButton.prop('disabled', false).css({ 'background-color': 'green', 'border-color': 'green' });
        } else {
            passwordMatchMessage.text("Passwords do not match!").css({ 'color': 'red' });

            // Disable the reset password button if new password and confirm password do not match
            resetButton.prop('disabled', true).css({ 'background-color': 'lightgrey', 'border-color': 'lightgrey' });
        }

        // If the current password is incorrect, disable the reset password button
        var currentPasswordMessage = $('#passwordMatch');
        if (currentPasswordMessage.text().trim().toLowerCase() !== "you're good to go!") {
            resetButton.prop('disabled', true).css({ 'background-color': 'lightgrey', 'border-color': 'lightgrey' });
        }
    }

    // Disable form submission until the current password is checked
    $('#reset').prop('disabled', true).css({ 'background-color': 'lightgrey', 'border-color': 'lightgrey' });

    // Attach form submission handler
    $('#passwordResetForm').on('submit', function (e) {
        // Prevent the default form submission
        e.preventDefault();

        // Submit the form if everything is correct
        if ($('#reset').prop('disabled') === false) {
            this.submit();
        }
    });
});

</script>



</body>

</html>