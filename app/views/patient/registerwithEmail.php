<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Sign Up With Email</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/patient/signUp-Email.css" />
</head>

<body>
  <div class="signUp-Email">
    <div class="upperRectangle">
    </div>
    <div class="container">
      <div class="register-form">

        <form action="<?php echo URLROOT ?>/patient/registrationEmail" method="POST" id="signup">
          <h1>Sign up with email</h1>

          <p class="sign-up-with-phone-number-instead">
            <span class="sign-up-with-phone-number-instead-sub-0">Sign up with&nbsp;</span>
            <a href="<?php echo URLROOT ?>/patient/registerwithPhone"
              class="sign-up-with-phone-number-instead-sub-1">phone number&nbsp;</a>
            <span class="sign-up-with-phone-number-instead-sub-2"> instead</span>
          </p>

          <div class="box1">
            <p class="first-name ">
              <span class="first-name-sub-0">first name </span>
              <span class="first-name-sub-1">*</span>
            </p>
            <input type="text" id="first_name" name="first_name" placeholder="Enter your first name"
              class="firstNameInput" required>
          </div>

          <div class="box2">
            <p class="last-name ">
              <span class="last-name-sub-0">last name </span>
              <span class="last-name-sub-1">*</span>
            </p>
            <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" class="lastNameInput"
              required>
          </div>

          <div class="box3">
            <p class="email-address">
              <span class="email-address-sub-0">email address </span>
              <span class="email-address-sub-1">*</span>
            </p>
            <input type="text" id="email_address" name="email_address" placeholder="Enter your email address"
              class="emailInput" required>
            <div class="error-msg" id="user_error"></div>
          </div>

          <div class="box4">
            <p class="password">
              <span class="password-sub-0">password </span>
              <span class="password-sub-1">*</span>
            </p>
            <input type="password" id="password" name="password" placeholder="Create a Password" class="passwordInput"
              required>
            <div class="error-msg" id="password_error"></div>
          </div>

          <div id="userValidation"></div>

          <button type="submit" class="box5" id="continue" disabled>Continue</button>

        </form>
      </div>

      <p class="Conditions">
        <span class="Conditions-sub-0">By signing up you agree to the&nbsp;</span>
        <a href="<?php echo URLROOT; ?>/general/terms_of_service" class="Conditions-sub-1">Terms of Service</a>
        <span class="Conditions-sub-2">&nbsp;and&nbsp;</span>
        <a href="<?php echo URLROOT; ?>/general/privacy_policy" class="Conditions-sub-3">Privacy Policy</a>
      </p>

    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  $(document).ready(function () {
    $('#signup').submit(function (event) {
      event.preventDefault();
      var formData = $(this).serialize();

      $('.error-msg').text('');

      var password = $('#password').val();
      var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

      if (!passwordRegex.test(password)) {
        $('#password_error').text('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.').css({ 'color': 'red', 'font-size': '14px' });
        $('#continue').prop('disabled', true).removeClass('green');
        return;
      }

      $('#password_error').text('');
      $('#continue').prop('disabled', false).addClass('green');

      $.ajax({
        type: 'POST',
        url: '<?php echo URLROOT ?>/patient/registrationEmail',
        data: formData,
        dataType: 'json',
        success: function (response) {
          if (response.error) {
            $('#user_error').text(response.error).css({ 'color': 'red', 'font-size': '18px' });
            $('#continue').prop('disabled', true).removeClass('green');
          } else {
            $('#userValidation').text("");
            window.location.href = '<?php echo URLROOT ?>/patient/emailverification?reference=' + response.reference; // Redirect on success
          }
        },
        error: function () {
          console.log('Error occurred during AJAX request.');
        }
      });
    });

    $('#password').on('input', function () {
      if ($(this).val() === '') {
        $('#password_error').text('');
      }
    });

    $('#signup').on('input change', function () {
      var valid = this.checkValidity();
      $('#continue').prop('disabled', !valid).toggleClass('green', valid);
    });

  });

</script>


</body>

</html>