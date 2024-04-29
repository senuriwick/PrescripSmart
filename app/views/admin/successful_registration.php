<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Registration Successful</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/patient/appointment_complete.css" />
    <!-- <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/patient.css"/> -->
</head>

<body>

    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
        <?php include 'top_navigation_panel.php'; ?>

            <div class="adminInfoContainer">
            <?php include 'information_container.php'; ?>
            <div class="menu">
                    <a href="new_appointment.html" id="appointments">Registration</a>
                </div>

                
<div class="searchDiv">
                        <div id = "confirmation" class="confirmationOptionsContent">
                            <h1>Registration Successful</h1>
                            <div class = "buttons">
                            <button id="viewAppointmentButton"
                                class="customConfirmationButton viewAppointmentButton">Go back to dashboard</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById("viewAppointmentButton").style.display = "block";
        });

        document.getElementById("viewAppointmentButton").addEventListener("click", function () {
            window.location.href = "searchPatient";
        });

    </script>


</body>

</html>