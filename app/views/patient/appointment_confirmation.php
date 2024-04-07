<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>New Appointment</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/patient/new_appointment_confirmation.css" />
</head>

<body>

    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
        <?php include 'top_navigation_panel.php'; ?>

            <div class="adminInfoContainer">
            <?php include 'information_container.php'; ?>

                <?php $session_ID = $_GET['sessionID']; ?>
                <!-- <?php var_dump($session_ID); ?> -->
                <?php $appInfo = $data['selectedSession']; ?>


                <div class="menu">
                    <a href="new_appointment.html" id="appointments">New Appointment</a>
                </div>

                <div>
                    <p style="font-size: small; color: gray;">Search Results (1)<br>Doctor:
                        <?php echo $appInfo->doctorName; ?>
                    </p>
                </div>

                <div class="searchDiv">
                    <!-- <h1 style="font-size: 18px; color:  #0069FF;">Monday, 18th September, 2023 At 19.00 P.M </h1> -->
                    <h1 style="font-size: 18px; color:  #0069FF;">
                        <?php echo $appInfo->sessionDate ?> At
                        <?php echo $appInfo->start_time ?> P.M
                    </h1>
                    <p style="line-height: 0.4;">Session #
                        <?php echo $appInfo->session_ID ?>
                    </p>
                    <div class="line1"></div>
                    <div class="smallrect">
                    </div>

                    <?php
                    $active = $appInfo->current_appointment - 1;
                    ?>
                    <p class="sessionname">Active Patients:
                        <?php echo $active ?><br>
                        Channeling Fee:<br>
                        Rs.
                        <?php echo $appInfo->sessionCharge ?><br>
                    </p>
                    <p class="policy">*Cancellation Policy</p>

                    <div id="policyPopup" class="policyPopup">
                        <div class="policyContent">
                            <h2>Cancellation Policy</h2>
                            <p>Your cancellation policy message goes here.</p>
                        </div>
                        <button id="closePolicy" class="closeButton">Close</button>
                    </div>

                    <button type="button" id="confirm" class="rectangle-70-mtM">CONFIRM</button>

                    <div id="customConfirmation" class="customConfirmation">
                        <div class="customConfirmationContent">
                            <h2>Confirmation</h2>
                            <p>Are you sure you want to confirm?</p>
                            <button id="yesButton" class="customConfirmationButton yesButton">YES</button>
                            <button id="noButton" class="customConfirmationButton noButton">NO</button>
                        </div>
                    </div>

                    <div id="confirmationOptions" class="confirmationOptions">
                        <div class="confirmationOptionsContent">
                            <h2>Appointment Scheduled</h2>
                            <p>Your appointment has been scheduled.</p>
                            <button id="viewAppointmentButton"
                                class="customConfirmationButton viewAppointmentButton">View Appointment</button>
                            <button id="payNowButton" class="customConfirmationButton payNowButton">Pay Now</button>
                        </div>
                    </div>

                    <div style="display:none">
                    <form action="<?php echo URLROOT; ?>/Patient/appointment_reservation/<?=12368?>/<?= $appInfo->doctor_ID ?>/<?= $appInfo->session_ID ?>/<?= $appInfo->start_time ?>/<?= $appInfo->sessionDate ?>" method="POST" id="addapp">
                            <input type="hidden" name="patient_ID" value="12368">
                            <input type="hidden" name="doctor_ID" value="<?php echo $appInfo->doctor_ID ?>">
                            <input type="hidden" name="session_ID" value="<?php echo $appInfo->session_ID ?>">
                            <input type="hidden" name="time" value="<?php echo $appInfo->start_time ?>">
                            <input type="hidden" name="date" value="<?php echo $appInfo->sessionDate ?>">
                            <input type="submit" style="display:none" id="insertapp">
                        </form>
                    </div>

                    <script>
                        document.querySelector(".policy").addEventListener("click", function () {
                            document.getElementById("policyPopup").style.display = "block";
                        });

                        document.getElementById("closePolicy").addEventListener("click", function () {
                            document.getElementById("policyPopup").style.display = "none";
                        });

                        document.getElementById("confirm").addEventListener("click", function () {
                            document.getElementById("customConfirmation").style.display = "block";
                        });

                        document.getElementById("yesButton").addEventListener("click", function () {
                            let addapp = document.getElementById("addapp");
                            let insertapp = document.getElementById("insertapp");

                            // Trigger the form submission
                            insertapp.click();

                            document.getElementById("customConfirmation").style.display = "none";
                            document.getElementById("confirmationOptions").style.display = "none";

                        });

                        document.getElementById("noButton").addEventListener("click", function () {
                            document.getElementById("customConfirmation").style.display = "none";
                        });

                        document.querySelector(".policy").addEventListener("click", function () {
                            document.getElementById("policyPopup").style.display = "block";
                        });

                        document.getElementById("closePolicy").addEventListener("click", function () {
                            document.getElementById("policyPopup").style.display = "none";
                        });

                    </script>
                </div>
            </div>
        </div>
    </div>


</body>

</html>