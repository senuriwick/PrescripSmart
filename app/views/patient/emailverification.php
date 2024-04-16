<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Email Verification</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/patient/signUp-Email-2.css" />
</head>

<body>
  <div class="signUp-Email-2">
    <div class="upperRectangle">
    </div>
    <div class="container">
      <div class="confirmationForm">

        <?php $user = $data['user']; ?>
        <form action = '<?php echo URLROOT?>/patient/resend_activation_email' method = "POST" id = "resend">
        <h1>Confirm your email address</h1>
        <p class="sampleEmail">
            We sent an email to
            <br />
            <strong><?php echo $user->email_phone ?></strong>
        </p>
        <div class="line1">
        </div>
        <p class="text1">
          Please confirm your email address by clicking
          <br />
          the link we just sent to your inbox
        </p>

        <input type="text" id="email" name="email" value = <?php echo $user->email_phone?> style="display: none">
        <button type="submit" class="box1" id="ResendVerification">Resend Verification Email</button>
        </form>
      </div>
    </div>
  </div>
</body>