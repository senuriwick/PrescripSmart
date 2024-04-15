<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Sign Up page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/patient/signUp.css" />
    <script src="/js/validation.js" defer></script>
</head>

<body>
    <div class="sign-up-page">
        <div class="upperRectangle">
        </div>
        <div class="container">
            <div class="sign-up-form">
                <h1>Create your account</h1>
                <p>All your prescriptions. In one place.</p>

                <button type="button" class="sign-up-email" id="continue">Sign Up with Email</button>
                <button type="submit" class="sign-up-phone" id="phoneSignUpButton">Sign Up with Phone Number</button>

                <div class="line">
                </div>
                <p class="already-have-an-account-sign-in-here">
                    <span class="already-have-an-account-sign-in-here-0">Already have an account? Sign in</span>
                    <span class="already-have-an-account-sign-in-here-1">&nbsp;</span>
                    <a href="<?php echo URLROOT ?>/patient/login" class="already-have-an-account-sign-in-here-2">here</a>
                </p>
            </div>

            <p class="terms-and-conditions">
                <span class="terms-and-conditions-0">By signing up you agree to the&nbsp; </span>
                <a href="<?php echo URLROOT; ?>/general/terms_of_service" class="terms-and-conditions-1">Terms of
                    Service</a>
                <span class="terms-and-conditions-2">&nbsp;and&nbsp; </span>
                <a href="<?php echo URLROOT; ?>/general/privacy_policy" class="terms-and-conditions-3">Privacy
                    Policy</a>
            </p>
        </div>
    </div>

    <script>
        document.getElementById("continue").addEventListener("click", function () {
            window.location.href = "<?php echo URLROOT ?>/patient/registerwithEmail";
        });
    </script>

    <script>
        document.getElementById("phoneSignUpButton").addEventListener("click", function () {
            window.location.href = "<?php echo URLROOT ?>/patient/registerwithPhone";
        });
    </script>

</body>