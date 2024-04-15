<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Appointments</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/patient/appointment_cancelled.css" />
</head>

<body>

    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
        <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
            <?php include 'information_container.php'; ?>
            <?php include 'in_page_navigation.php'; ?>

                <div class="prescriptionsDiv">
                    <h1>Appointment Cancelled</h1>
                    <div>
                        <div id="successPopup">
                            <div>
                                <p>Your appointment has been cancelled.</p>
                                <button id="goToDashboardButton" class="cancelbutton">Go back to dashboard</button>
                            </div>
                        </div>

                    </div>

                </div>

                <?php include 'add_new_container.php'; ?>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const successPopup = document.getElementById('successPopup');

            const goToDashboardButton = document.getElementById('goToDashboardButton');

            goToDashboardButton.addEventListener('click', function () {
                successPopup.style.display = "block";
                window.location.href = "appointments_dashboard";
            });
        });
    </script>

</body>
</html>