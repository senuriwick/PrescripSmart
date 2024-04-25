<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Login Page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700"/>
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/general/loginPage.css">
</head>

<body>
<div class="loginPage">
    <div class="upperRectangle">
    </div>
    <div class="formContainer">

      <div class="loginForm">
        <h1>Login to your account</h1>

      <form action="<?php echo URLROOT;?>/receptionist/login" id="loginForm"  method="post">
            <div class="emailContainer">
            <input type="text" id="email_address" name="email_address" placeholder="Enter your email/phone number" class="inputfield">
            <p class="inputLabel1">
                <span class="inputLabel1-0">email/phone number</span>
                <span class="inputLabel1-1">*</span>
            </p>
            </div>

            <div class="passwordContainer">
            <input type="password" id="password" name="password" placeholder="Enter your password" class="inputfield">
            <p class="inputLabel2">
                <span class="inputLabel2-0">password </span>
                <span class="inputLabel2-1">*</span>
            </p>
            </div>
        <button type="submit" class="loginButton">Log In</button>
      </form>

      <a href="<?php echo URLROOT ?>/receptionist/forget_password" class="forgot-password">Forgot Password?</a>
    </div>
    <p class="dont-have-an-account-sign-up-here">
      <span class="dont-have-an-account-sign-up-here-sub-0">Don’t have an account? Sign up</span>
      <span class="dont-have-an-account-sign-up-here-sub-1">&nbsp;</span>
      <a href="<?php echo URLROOT ?>/admin/register_select" class="dont-have-an-account-sign-up-here-sub-2">here</a>
    </p>    
  </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function () {
  $('#loginForm').submit(function (event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $('.error-msg-email').text('');
    $('.error-msg-password').text('');

    $.ajax({
      type: 'POST',
      url: '<?php //echo URLROOT ?>/receptionist/authenticate',
      data: formData,
      dataType: 'json',

      success: function (response) {
        if (response.success) {
          if (response.two_factor_required) {
            var emailOrPhone = $('#email_address').val();
            window.location.href = '/prescripsmart/patient/two_factor_authentication?user=' + encodeURIComponent(emailOrPhone);
          } else {
            window.location.href = '/prescripsmart/receptionist/searchAppointment';
          }
        } else if (response.error) {
          if (response.error === 'Email/Phone Number does not exist') {
            $('#email_error').text(response.error).css({ 'color': 'red' });
          } else if (response.error === 'Invalid password') {
            $('#password_error').text(response.error).css({ 'color': 'red' });
          }
        } else {
          console.log('Unexpected response:', response);
          header("Location: /prescripsmart/general/error_page");
        }
      },
      error: function () {
        console.log('Error occurred during AJAX request.');
      }
    });
  });
});

  </script> -->
</body>
</html>
