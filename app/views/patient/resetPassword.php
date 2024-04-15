<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Login Page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/general/passwordReset.css">
</head>

<body>
  <?php $user = $_GET['user']; ?>
  <div class="loginPage">
    <div class="upperRectangle">
    </div>
    <div class="formContainer">

      <div class="loginForm">
        <h1>Reset your password</h1>
        <form action='<?php echo URLROOT ?>/patient/reset_user_password' method="POST" id="send">

          <input type="hidden" id="user" name="user" value="<?php echo $user; ?>">

          <div class="emailContainer">
            <input type="password" id="new_password" name="new_password" placeholder="Enter your new password"
              class="inputfield" required>
            <p class="inputLabel1">New Password</p>
          </div>

          <div class="passwordContainer">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" class="inputfield" required>
            <p class="inputLabel2">Confirm Password
            </p>
          </div>

          <button type="submit" class="loginButton" id="reset">Reset Password</button>
          <div class="error-msg-password" id="password_error"></div> 
        </form>
      </div>
      <p class="criteria">
        <strong>Note:</strong>&nbsp;Password must be at least 8 characters long,<br>&nbsp;contain at least one uppercase letter, one lowercase letter,<br>&nbsp;one number, and one special character.</span>
      </p>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  $(document).ready(function() {
    function clearPasswordError() {
      $('#password_error').text('').css({
        'color': '',
        'font-size': ''
      });
    }

    $('#new_password').on('input', function() {
      clearPasswordError();
    });

    $('#confirm_password').on('input', function() {
      clearPasswordError();
    });

    $('#send').submit(function(event) {
      event.preventDefault();
      var newPassword = $('#new_password').val();
      var confirmPassword = $('#confirm_password').val();

      var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

      if (!passwordRegex.test(newPassword)) {
        $('#password_error').text('Password Strength: Low').css({
          'color': 'red',
          'font-size': '14px'
        });
        return;
      }

      if (newPassword !== confirmPassword) {
        $('#password_error').text('Passwords do not match.').css({
          'color': 'red',
          'font-size': '14px'
        });
        return;
      }

      var formData = $(this).serialize();

      clearPasswordError();

      $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: formData,
        dataType: 'json',
        success: function(data) {
          if (data.success) {
            window.location.href = '<?php echo URLROOT ?>/patient/reset_successful';
          } else {
            // Handle error here
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
        }
      });
    });
  });
</script>

</body>

</html>
