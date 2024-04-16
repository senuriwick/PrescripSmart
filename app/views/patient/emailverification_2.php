<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Resend Verification Email</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/patient/signUp-Email-3.css" />
</head>

<body>
  <div class="signUp-Email-2">
    <div class="upperRectangle">
    </div>
    <div class="container">
      <div class="confirmationForm">

        <h1>Verification email has been re-sent.</h1>
        <!-- <form action = '<?php echo URLROOT?>/patient/resend_activation_email' method = "POST" id = "resend"> -->
        <p class="text1">
          Please check your inbox and try again.<br>Thank you!
        </p>
        <!-- <input type="text" id="email" name="email" value = <?php echo $user->email_phone?> style="display: none"> -->
        <button type="submit" class="box1 disabled" id="ResendVerification" disabled>Resend Verification Email</button>
      </div>
    </div>
  </div>

  <!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
      var resendButton = document.getElementById("ResendVerification");
      var totalClicks = 0;
      var intervalId;

      function enableResendButton() {
        resendButton.disabled = false;
        resendButton.classList.remove("disabled");
        resendButton.classList.add("enabled");
        resendButton.textContent = "Resend Verification Email";
        clearInterval(intervalId);
      }

      function updateButtonLabel(seconds) {
        resendButton.textContent = "Resend Verification Email (" + seconds + "s)";
      }

      function startTimer(duration) {
        var timer = duration;
        updateButtonLabel(timer);

        intervalId = setInterval(function() {
          timer--;
          updateButtonLabel(timer);
          if (timer <= 0) {
            enableResendButton();
          }
        }, 1000);
      }


      enableResendButton();

      resendButton.addEventListener("click", function() {
        totalClicks++;
        if (totalClicks <= 3) {
          this.disabled = true;
          this.classList.add("disabled");
          this.classList.remove("enabled");
          startTimer(60);
        } else {
          this.disabled = true;
          this.classList.add("disabled");
          this.classList.remove("enabled");
        }
      });
    });
  </script> -->

</body>
