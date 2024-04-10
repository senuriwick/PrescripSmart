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
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/general/reset_password.css" />
</head>

<body>
  <div class="forgotPassPage">
    <div class="upperRectangle">
    </div>
    <div class="container">
      <div class="confirmationForm">

        <form action='<?php echo URLROOT ?>/patient/password_recovery' method="POST" id="send">
          <p class="confirmEmail">Recover Password</p>
          <p class="sampleEmail">
            Please use the link we sent you to reset your password. Thank you.
          </p>

          <a href="<?php echo URLROOT ?>/patient/login">Log in with old password</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
