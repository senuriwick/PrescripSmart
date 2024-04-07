<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Security</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\patient\profile_dashboard_3.css" />
</head>

<body>

    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
        <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
            <?php include 'information_container.php'; ?>
            <?php include 'in_page_navigation_account.php'; ?>

                <div class="inquiriesDiv">
                    <?php $user = $data['user'] ?>
                    <h1>Patient ID: #<?php echo $user->user_ID ?></h1>
                    <p class="sub1" style="font-weight: bold;">Security Information</p>
                    <div class="accInfo">
                        <div class="parallel">
                            <div class="input-group">
                                <label for="name">Method of Sign-In</label>
                                <input type="text" id="method" class="input" style="display: inline-block;" value=<?php echo $user->method_of_signin ?>>
                            </div>
                            <div class="input-group">
                                <label for="email">Email/Phone Number</label>
                                <input type="text" id="email_phone" class="input" style="display: inline-block;"
                                    value=<?php echo $user->email_phone ?>>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h4>Two-factor Authentication</h3>
                            <p class="para">Add an extra layer of security to your account. To sign in, you'll need to
                                provide a code along with your username and password.</p>
                            <label class="switch">
                                <input type="checkbox" id="toggleTwoFactorAuth" <?php echo $user->two_factor_auth == 'on' ? 'checked' : ''; ?>>
                                <span class="slider round"></span>
                            </label>
                    </div>
                </div>

            </div>
        </div>

    </div>
    </div>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#toggleTwoFactorAuth').change(function () {
            var toggleState = $(this).is(':checked') ? 'on' : 'off';
            var user = '<?php echo $user->user_ID?>';
            var user_ID = user;

            $.ajax({
                url: '<?php echo URLROOT?>/patient/toggle2FA',
                method: 'POST',
                dataType: 'json',
                data: {
                    toggle_state: toggleState,
                    userID: user_ID
                },
                success: function (response) {
                    if (response.success) {
                        console.log('Toggle state changed successfully');
                    } else {
                        console.error('Error: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                }
            });
        });
    });
</script>

</body>

</html>