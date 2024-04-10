<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Sign Up page 3</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/general/reset_password.css" />
</head>

<body>
  <div class="forgotPassPage">
    <div class="upperRectangle">
    </div>
    <div class="container">
      <div class="confirmationForm">

        <form action='<?php echo URLROOT ?>/general/password_recovery' method="POST" id="send">
          <p class="confirmEmail">Recover Password</p>
          <p class="sampleEmail">
            We can send a recovery link to: <span id="emailDisplay"></span>
          </p>

          <input type="hidden" id="email" name="email" class="userInput">
          
          <a href="<?php echo URLROOT ?>/general/employee_login">Log in with password</a>
          <button type="button" class="box1" id="continue">Continue</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    var email = sessionStorage.getItem('email');
    document.getElementById('emailDisplay').textContent = email;
    document.getElementById('email').value = email;

    document.getElementById('continue').addEventListener('click', function() {
      var form = document.getElementById('send');
      var formData = new FormData(form);

      fetch(form.action, {
          method: 'POST',
          body: formData
        })
       .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Network response was not ok');
                    }
                })
                .then(data => {
                    if (data.success) {
                        window.location.href = '<?php echo URLROOT ?>/general/recovery_contd';
                    } else {
                        // document.getElementById('email_error').textContent = data.error;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
    });
  </script>

</body>
</html>
