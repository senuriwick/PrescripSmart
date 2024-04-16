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
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/general/forgot_password.css" />
</head>

<body>
    <div class="forgotPassPage">
        <div class="upperRectangle">
        </div>
        <div class="container">
            <div class="confirmationForm">

                <form action='<?php echo URLROOT ?>/general/forgotten_password_reset' method="POST" id="send">
                    <h1>Find Your Account</h1>
                    <p class="sampleEmail">
                        Please enter your email address or mobile number to search for your account.
                    </p>
                    <div class="error-msg" id="email_error"></div>

                    <input type="text" id="email" name="email" class="userInput" required>
                    <button type="button" class="box2" id="cancel">Cancel</button>
                    <button type="submit" class="box1" id="continue">Continue</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('cancel').addEventListener('click', function () {
            window.history.back();
        });

        document.getElementById('send').addEventListener('submit', function (event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            var email = document.getElementById('email').value;
            sessionStorage.setItem('email', email);

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
                        window.location.href = '<?php echo URLROOT ?>/general/reset_password';
                    } else {
                        document.getElementById('email_error').textContent = data.error;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

    </script>
</body>
</html>
