<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Successful Appointment</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/receptionist/appointment_complete.css" />
</head>

<body>

    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
        <?php include 'top_navigation_panel.php'; ?>

            <div class="adminInfoContainer">
            <?php include 'information_container.php'; ?>
            <?php include 'in_page_navigation.php'; ?>

            

                <div class="searchDiv">
                        <div id = "confirmation" class="confirmationOptionsContent">
                            <h1>Appointment Scheduled</h1>
                            <p>Your appointment has been scheduled.</p>
                            <div class = "buttons" onclick="redirect()">
                                <button id="viewAppointmentButton"
                                class="customConfirmationButton viewAppointmentButton">Back to dashboard</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        function redirect()
        {
            document.addEventListener('DOMContentLoaded', function () {
            document.getElementById("viewAppointmentButton").style.display = "block";
            });

            document.getElementById("viewAppointmentButton").addEventListener("click", function () {
            window.location.href = "<?php echo URLROOT; ?>/receptionist/searchApp";
        });

        }
        

    </script>

</body>

</html>