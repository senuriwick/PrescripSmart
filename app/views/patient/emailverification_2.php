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
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/patient/signUp-Email-2.css" />

  <style>
    .box1:disabled {
      background-color: grey; 
      color: grey; 
      cursor: not-allowed; 
    }
  </style>

</head>

<body>
  <div class="signUp-Email-2">
    <div class="upperRectangle">
    </div>
    <div class="container">
      <div class="confirmationForm">

        <!-- <p class="confirmEmail">Verification email has been re-sent.</p> -->
        <div class="line1">
        </div>
        <p class="text1">
            Verification email has been re-sent.
          <br />
          Please check your inbox and try again. Thank you!
        </p>

        <button type="submit" class="box1" id="ResendVerification" disabled >Resend Verification Email</button>
      </div>
    </div>
  </div>
</body>