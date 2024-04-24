<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/patient/two_factor_auth.css" />
</head>

<body>
    <div class="signUp-Phone-2">
        <div class="upperRectangle">
        </div>
        <div class="container">
            <form id="twofactor-form" action="<?php echo URLROOT ?>/general/twofactorverification" method="POST">
                <div class="confirmationForm">
                    <?php $user = $data['user']; ?>

                    <p class="confirmPhone">Two Factor Authentication</p>
                    <p class="sampleEmail">
                        <span class="sampleEmail-sub-0">
                            Please enter the 6-digit code we sent to your
                            <?php if ($user->method_of_signin == "Email") { ?>
                                email address
                            <?php } else { ?>
                                phone number
                            <?php } ?>
                            <br />
                        </span>
                    </p>

                    <input type="number" id="code" name="code" placeholder="Enter your code here" class="group-12-sKw">
                    <input type="text" id="phone" name="phone" value=<?php echo $user->email_phone ?>
                        style="display: none">
                    <button type="submit" id="button" class="group-13-X9b">Verify</button>
                </div>

                <p class="text2">
                    <span class="text2-sub-0">Didn’t receive a code?&nbsp;</span>
                    <a href class="text2-sub-1">Resend code</a>
                </p>
                <div id="error-message" class="error-message"></div>

            </form>
        </div>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        $(document).ready(function () {
            $('#twofactor-form').submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize(); 

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
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
                        } else if (response.error) {
                            $('#error-message').text(response.error);
                        }
                    },
                    error: function () {
                        console.log('Error occurred during AJAX request.');
                    }
                });
            });

            var resendTimeout;

            function enableResendLink() {
                $('.text2-sub-1').removeClass('disabled');
                $('.text2-sub-1').css('pointer-events', '');
                clearInterval(resendTimeout);
            }

            $('.text2-sub-1').click(function (event) {
                event.preventDefault();

                var email_phone = '<?php echo $user->email_phone; ?>';
                var emailphone = email_phone;

                $.ajax({
                    type: 'POST',
                    <?php if ($user->method_of_signin == "Phone") { ?>
                       url: '<?php echo URLROOT ?>/general/resend_security_sms',
                    <?php } else { ?>
                       url: '<?php echo URLROOT ?>/general/resend_security_email',
                    <?php } ?>
                   data: { emailPhone: emailphone },
                    dataType: 'json',
                    success: function (response) {
                        console.log('OTP resent successfully');
                    },
                    error: function () {
                        console.log('Error occurred while resending OTP');
                    }
                });

                $(this).addClass('disabled').css('pointer-events', 'none');
                resendTimeout = setTimeout(enableResendLink, 60000); // 60 seconds
            });
        });
    </script>

</body>

</html>