<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Login Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/general/loginPage.css">
</head>

<body>
    <div class="loginPage">
        <div class="upperRectangle">
        </div>
        <div class="formContainer">

            <div class="loginForm">
                <p class="login-to-your-account">Login to your account</p>
                <form id="loginForm">
                    <div class="emailContainer">
                        <input type="text" id="email_address" name="email_address"
                            placeholder="Enter your email/phone number" class="inputfield">
                        <p class="inputLabel1">
                            <span class="inputLabel1-0">email/phone number </span>
                            <span class="inputLabel1-1">*</span>
                        </p>
                        <div class="error-msg" id="email_error"></div>
                    </div>
                    <div class="passwordContainer">
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            class="inputfield">
                        <p class="inputLabel2">
                            <span class="inputLabel2-0">password </span>
                            <span class="inputLabel2-1">*</span>
                        </p>
                        <div class="error-msg" id="password_error"></div>
                    </div>
                    <button type="submit" class="loginButton">Log In</button>
                </form>
                <div id="userValidation"></div>
                <a href="forgot_password.html" class="forgot-password">Forgot Password?</a>
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#loginForm').submit(function (event) {
                event.preventDefault();
                var formData = $(this).serialize(); // Serialize form data

                $('.error-msg').text('');

                $.ajax({
                    type: 'POST',
                    url: '<?php echo URLROOT ?>/general/employee_authentication',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.error) {
                            if (response.error == 'Email/Phone Number does not exist') {
                                $('#email_error').text(response.error).css({ 'color': 'red' });
                            } else if (response.error == 'Invalid password') {
                                $('#password_error').text(response.error).css({ 'color': 'red' });
                            }
                        } else {
                            $('#userValidation').text("");

                            // Redirect based on user's role
                            if (response.role === 'Admin') {
                                window.location.href = '/prescripsmart/admin/searchPatient';
                            } else if (response.role === 'Doctor') {
                                window.location.href = '/prescripsmart/doctor/sessions';
                            } else if (response.role === 'Nurse') {
                                window.location.href = '/prescripsmart/nurse/patients_dashboard';
                            } else if (response.role === 'Receptionist') {
                                window.location.href = '/prescripsmart/receptionist/searchPatient';
                            } else if (response.role === 'Lab_technician') {
                                window.location.href = '/prescripsmart/lab_tech/patient';
                            } else if (response.role === 'Pharmacist') {
                                window.location.href = '/prescripsmart/pharmacist/pharmacist_dashboard';
                            } else if (response.role === 'Health_supervisor') {
                                window.location.href = '/prescripsmart/healthSupervisor/healthSupervisor_dashboard';
                            } else {
                                window.location.href = '/prescripsmart/general/home';
                            }
                        }
                    },
                    error: function () {
                        console.log('Error occurred during AJAX request.');
                    }
                });
            });
        });
    </script>
</body>

</html>