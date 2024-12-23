<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Sign Up Completed</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700"/>
  <link rel="stylesheet" href="<?php echo URLROOT?>/public/css/patient/signUp-4.css"/>
</head>
<body>
<div class="signUp-page-4">
  <div class="upperRectangle">
    <!-- <p class="text1">SAMPLE USER NAME HERE </p> -->
    <div class="line">
    </div>
    <img class="vector-Tus" src="./assets/vector-YED.png"/>
  </div>
  <div class="group">
    <img class="material-symbols-arrow-drop-down-circle-outline-j6h" src="./assets/material-symbols-arrow-drop-down-circle-outline-gfb.png"/>
    <div class="whiteBox">
    </div>
    <div class="textForm">
      <h1>Registration Successful!</h1>
      <button type="button" class="visitProfile" id="visitProfile">Login Now</button>

                <script>
                    document.getElementById("visitProfile").addEventListener("click", function () {
                        window.location.href = "<?php echo URLROOT?>/patient/login";
                    });
                </script>
    <div class="group8">
      <p class="terms-of-service-HBw">
        <a href="<?php echo URLROOT; ?>/general/terms_of_service" class="terms-of-service-HBw-sub-0">Terms of Service</a>
        <span class="terms-of-service-HBw-sub-1"> </span>
      </p>
      <p class="privacy-policy-wZK">
        <span class="privacy-policy-wZK-sub-0"> </span>
        <a href="<?php echo URLROOT; ?>/general/privacy_policy" class="privacy-policy-wZK-sub-1">Privacy Policy</a>
      </p>
    </div>
</div>
</body>