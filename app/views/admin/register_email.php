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
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admin/signUp-Email.css">

</head>

<body>
<div class="signUp-Email">
  <div class="upperRectangle">
  </div>
  <div class="container">
    <div class="register-form">

      
      <p class="sign-up-with-email">Sign up with email</p>
      <p class="sign-up-with-phone-number-instead">
        <span class="sign-up-with-phone-number-instead-sub-0">Sign up with&nbsp;</span>
        <a href="signUp-Phone.html" class="sign-up-with-phone-number-instead-sub-1">phone number&nbsp;</a>
        <span class="sign-up-with-phone-number-instead-sub-2"> instead</span>
      </p>

      <form action="<?php echo URLROOT; ?>/admin/register_email" method="post">

      <div class="box1">

        <p class="first-name ">
          <span class="first-name-sub-0">first name </span>
          <span class="first-name-sub-1">*</span>
        </p>
        <input type="text" id="first-name" name="first_name" placeholder="Enter your first name" class="firstNameInput">
      </div>

      <div class="box2">
        <p class="last-name ">
          <span class="last-name-sub-0">last name </span>
          <span class="last-name-sub-1">*</span>
        </p>
        <input type="text" id="last-name" name="last_name" placeholder="Enter your last name" class="lastNameInput">
      </div>

      <div class="box3">
        <p class="email-address">
          <span class="email-address-sub-0">email address </span>
          <span class="email-address-sub-1">*</span>
        </p>
        <input type="text" id="email-address" name="email_address" placeholder="Enter your email address" class="emailInput">
      </div>

      <div class="box4">
        <p class="password">
          <span class="password-sub-0">password </span>
          <span class="password-sub-1">*</span>
        </p>
        <input type="password" id="password" name="password" placeholder="Create a Password" class="passwordInput">
      </div>

      <button type="submit" class="box5" id="continue">Continue</button>

        

      </form>
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