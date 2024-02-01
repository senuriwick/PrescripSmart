<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Sign Up Page via Email</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700"/>
  <link rel="stylesheet" href="<?php echo URLROOT?>/public/css/patient/signUp-Phone.css"/>
</head>

<body>
<div class="signUp-Phone">
  <div class="upperRectangle">
  </div>
  <div class="container">
    <div class="register-form">
      <p class="sign-up-with-phone-number">Sign up with phone number</p>
      <p class="sign-up-with-email-instead">
        <span class="sign-up-with-email-instead-sub-0">Sign up with&nbsp;</span>
        <a href="<?php echo URLROOT?>/patient/registerwithEmail" class="sign-up-with-email-instead-sub-1">email address&nbsp;</a>
        <span class="sign-up-with-email-instead-sub-2"> instead</span>
      </p>
      <div class="box1">
        <p class="first-name ">
          <span class="first-name-sub-0">first name </span>
          <span class="first-name-sub-1">*</span>
        </p>
        <input type="text" id="first-name" name="first-name" placeholder="Enter your first name" class="firstNameInput">
      </div>
      <div class="box2">
        <p class="last-name ">
          <span class="last-name-sub-0">last name </span>
          <span class="last-name-sub-1">*</span>
        </p>
        <input type="text" id="last-name" name="last-name" placeholder="Enter your last name" class="lastNameInput">
      </div>
      <div class="box3">
        <p class="phone-number">
          <span class="phone-number-sub-0">email address </span>
          <span class="phone-number-sub-1">*</span>
        </p>
        <input type="text" id="phone-number" name="phone-number" placeholder="Enter your phone number" class="phoneInput">
      </div>
      <div class="box4">
        <p class="password">
          <span class="password-sub-0">password </span>
          <span class="password-sub-1">*</span>
        </p>
        <input type="password" id="password" name="password" placeholder="Create a Password" class="passwordInput">
      </div>
      <button type="button" class="box5" id="continue">Continue</button>

                <script>
                    document.getElementById("continue").addEventListener("click", function () {
                        window.location.href = "signUp-Phone-2.html";
                    });
                </script>
    </div>
    <p class="Conditions">
      <span class="Conditions-sub-0">By signing up you agree to the </span>
      <a href="termsAndConditions.html" class="Conditions-sub-1">Terms of Service</a>
      <span class="Conditions-sub-2">&nbsp;and&nbsp;</span>
      <a href="privacyPolicy.html" class="Conditions-sub-3">Privacy Policy</a>
    </p>
  </div>
</div>
</body>