<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Password Recovery</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/general/reset_successful.css" />
</head>

<body>
  <div class="forgotPassPage">
    <div class="upperRectangle">
    </div>
    <div class="container">
      <div class="confirmationForm">

        <form action='<?php echo URLROOT ?>/patient/password_recover' method="POST" id="send">
          <h1>Password Changed</h1>
          <p class="sampleEmail">Please use your new password to login to your account. Thank you.
          </p>
          <button type="button" class="box1" id="continue">Login Now</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('continue').addEventListener('click', function() {
        window.location.href = '<?php echo URLROOT ?>/patient/login';
    });
  </script>

</body>
</html>
