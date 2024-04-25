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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\healthSupervisor\healthSupervisor_profile.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
                <?php include 'information_container.php'; ?>
                <?php include 'in_page_navigation_account.php'; ?>

<<<<<<< HEAD
                <?php $healthSupervisor = $data['healthSupervisor'] ?>

                <div class="inquiriesDiv">
                    <h1>Employee ID: #<?php echo $healthSupervisor->user_ID ?>
=======
                <?php $nurse = $data['nurse'] ?>

                <div class="inquiriesDiv">
                    <h1>Employee ID: #<?php echo $nurse->user_ID ?>
>>>>>>> 8518232331a30ce64766164a40cd1a3daadc0254
                    </h1>
                    <p class="sub1" style="font-weight: bold;">Account Information</p>

                    <div class="accInfo">
                        <form action="<?php echo URLROOT; ?>/pharmacist/accountInfoUpdate" method="POST">
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="name">Username</label>
                                    <input type="text" id="username" class="input" name="username"
<<<<<<< HEAD
                                        value="<?php echo $healthSupervisor->username ?>" style="display: inline-block;">
                                </div>
                                <div class="input-group">
                                    <label for="email">Associated Email Address/Phone Number</label>
                                    <?php if ($healthSupervisor->method_of_signin == "Email"): ?>
                                        <input type="text" id="email" class="input" name="email" readonly
                                            value="<?php echo $healthSupervisor->email_phone ?>" style="display: inline-block;">
                                    <?php else: ?>
                                        <input type="text" id="phone" class="input" name="phone" readonly
                                            value="<?php echo $healthSupervisor->email_phone ?>" style="display: inline-block;">
=======
                                        value="<?php echo $nurse->username ?>" style="display: inline-block;">
                                </div>
                                <div class="input-group">
                                    <label for="email">Associated Email Address/Phone Number</label>
                                    <?php if ($nurse->method_of_signin == "Email"): ?>
                                        <input type="text" id="email" class="input" name="email" readonly
                                            value="<?php echo $nurse->email_phone ?>" style="display: inline-block;">
                                    <?php else: ?>
                                        <input type="text" id="phone" class="input" name="phone" readonly
                                            value="<?php echo $nurse->email_phone ?>" style="display: inline-block;">
>>>>>>> 8518232331a30ce64766164a40cd1a3daadc0254
                                    <?php endif; ?>
                                </div>

                            </div>
                            <button type="submit" id="submit">SAVE CHANGES</button>
                        </form>
                    </div>

                    <p class="sub2" style="font-weight: bold;">Reset Password</p>
                    <div class="accInfo">
                        <form action="<?php echo URLROOT; ?>/pharmacist/passwordReset" method="POST">
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
                            <div id="weakPassword"></div>
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
                var newPassword = $('#newpassword').val();
                var confirmPassword = $('#confirmpassword').val();

                var uppercaseRegex = /[A-Z]/;
                var lowercaseRegex = /[a-z]/;
                var numberRegex = /[0-9]/;
                var specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;

                var hasUppercase = uppercaseRegex.test(newPassword);
                var hasLowercase = lowercaseRegex.test(newPassword);
                var hasNumber = numberRegex.test(newPassword);
                var hasSpecialChar = specialCharRegex.test(newPassword);

                console.log("Uppercase:", hasUppercase);
                console.log("Lowercase:", hasLowercase);
                console.log("Number:", hasNumber);
                console.log("Special Char:", hasSpecialChar);

                var isValidPassword = newPassword.length >= 8 && hasUppercase && hasLowercase && hasNumber && hasSpecialChar;

                console.log("Is Valid Password:", isValidPassword);

                if (newPassword !== '' && confirmPassword !== '') {
                    if (!isValidPassword) {
                        $('#weakPassword').text("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character").css({ 'color': 'red' });
                    } else {
                        $('#weakPassword').text("");
                    }

                    $.ajax({
<<<<<<< HEAD
                        url: '/prescripsmart/Pharmacist/checkPassword',
=======
                        url: '/prescripsmart/healthSupervisor/checkPassword',
>>>>>>> 8518232331a30ce64766164a40cd1a3daadc0254
                        method: 'POST',
                        data: { password: enteredPassword },
                        dataType: 'json',
                        success: function (response) {
                            if (response.match) {
                                $('#passwordMatch').text("You're good to go!").css({ 'color': 'green' });
                            } else {
                                $('#passwordMatch').text("Incorrect password!").css({ 'color': 'red' });
                            }

                            if (newPassword === confirmPassword) {
                                $('#newpasswordMatch').text("Passwords match!").css({ 'color': 'green' });
                            } else {
                                $('#newpasswordMatch').text("Passwords do not match!").css({ 'color': 'red' });
                            }

                            if (newPassword === confirmPassword && isValidPassword && response.match) {
                                $('#reset').prop('disabled', false).css({ 'background-color': 'green', 'border-color': 'green' });
                            } else {
                                $('#reset').prop('disabled', true).css({ 'background-color': 'lightgrey', 'border-color': 'lightgrey' });
                            }
                        }
                    });
                } else {
                    $('#passwordMatch').text("");
                    $('#newpasswordMatch').text("");
                    $('#reset').prop('disabled', true).css({ 'background-color': 'lightgrey', 'border-color': 'lightgrey' });
                }
            }

            $('#password, #newpassword, #confirmpassword').on('input', checkPasswords);
        });
    </script>


</body>
</html>