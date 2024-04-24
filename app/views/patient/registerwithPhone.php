<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Sign Up With Phone</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/patient/signUp-Phone.css" />
</head>

<body>
  <div class="signUp-Phone">
    <div class="upperRectangle">
    </div>
    <div class="container">
      <div class="register-form">

        <form action="<?php echo URLROOT ?>/patient/registrationPhone" method="POST" id="signup">

          <h1>Sign up with phone number</h1>
          <p class="sign-up-with-email-instead">
            <span class="sign-up-with-email-instead-sub-0">Sign up with&nbsp;</span>
            <a href="<?php echo URLROOT ?>/patient/registerwithEmail" class="sign-up-with-email-instead-sub-1">email
              address&nbsp;</a>
            <span class="sign-up-with-email-instead-sub-2"> instead</span>
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
            <p class="phone-number">
              <span class="phone-number-sub-0">phone number </span>
              <span class="phone-number-sub-1">*</span>
            </p>
            <input type="text" id="phone_number" name="phone_number" placeholder="e.g: +947xxxxxxxx" class="phoneInput"
              required>
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

          <button type="submit" class="box5" id="continue">Continue</button>

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
          url: '<?php echo URLROOT ?>/patient/registrationPhone',
          data: formData,
          dataType: 'json',
          success: function (response) {
            if (response.error) {
              $('#user_error').text(response.error).css({ 'color': 'red', 'font-size': '18px' });
              $('#continue').prop('disabled', true).removeClass('green');
            } else {
              $('#userValidation').text("");
              window.location.href = '<?php echo URLROOT ?>/patient/phoneverification?reference=' + response.reference; // Redirect on success
            }
          },
          error: function () {
            console.log('Error occurred during AJAX request.');
          }
        });
      });

      $('#signup').on('input change', function () {
        var valid = this.checkValidity();
        $('#continue').prop('disabled', !valid).toggleClass('green', valid);
      });

    });
  </script>

</body>
</html>