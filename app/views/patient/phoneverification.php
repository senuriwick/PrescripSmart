<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Sign Up page 3</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/patient/signUp-Phone-2.css" />
</head>

<body>
    <div class="signUp-Phone-2">
        <div class="upperRectangle">
        </div>
        <div class="container">
            <form action="<?php echo URLROOT ?>/patient/verifyotp" method="POST">
                <div class="confirmationForm">
                    <?php $user = $data['user']; ?>

                    <p class="confirmPhone">Confirm your phone number</p>
                    <p class="sampleEmail">
                        <span class="sampleEmail-sub-0">
                            We sent a 6-digit code to
                            <br />

                        </span>
                        <span class="samplePhone">
                            <?php echo $user->email_phone ?>
                        </span>
                    </p>
                    <div class="line1">
                    </div>
                    <p class="text1">
                        Please confirm your phone number by entering
                        <br />
                        the code we just sent to you.
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

            </form>
        </div>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        $(document).ready(function () {
            var resendTimeout;

            function enableResendLink() {
                $('.text2-sub-1').removeClass('disabled');
                $('.text2-sub-1').css('pointer-events', '');
                clearInterval(resendTimeout);
            }

            $('.text2-sub-1').click(function (event) {
                event.preventDefault();

                var phoneNumber = '<?php echo $user->email_phone; ?>';
                var phone = phoneNumber;

                var user = '<?php echo $user->user_ID; ?>'
                var userID = user;

                $.ajax({
                    type: 'POST',
                    url: '<?php echo URLROOT ?>/patient/resendotp',
                    data: { phone: phone },
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