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
    <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\nurse\appointments_2.css" />
</head>

<body>

    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
                <?php include 'information_container.php'; ?>
                <?php include 'in_page_navigation.php'; ?>

                <?php $appointment = $data['appointment']; ?>
                <?php $doctor = $data['doctor']; ?>
                <?php $patient = $data['patient'] ?>

                <?php
                $date = new DateTime($appointment->date);
                $formatted_date = $date->format("D, jS M, Y");
                $time = date("h:i A", strtotime($appointment->time));
                ?>

                <div class="prescriptionsDiv">
                    <div>
                        <div class="section-header">
                            <img src="<?php echo URLROOT; ?>\public\img\patient\back_arrow_icon.png" alt="back-icon"
                                id="back">
                            <h1>Appointment (#<?php echo $appointment->appointment_ID; ?>)
                            </h1>
                        </div>
                    </div>

                    <div class="prescriptionFiles">
                        <div class="file">
                            <div class="group">
                                <div class="number">
                                    <span class="number-sub-0">
                                        NO.<br>
                                        <?php echo $appointment->token_No; ?>
                                    </span>
                                </div>
                            </div>

                            <div class="text">
                                <div class="auto-group">
                                    <p><span class="bold">Time:</span> <?php echo $time; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="bold">Date:</span> <?php echo $formatted_date; ?><br>
                                        <span class="bold">Doctor:</span> Dr.<?php echo $doctor->first_Name; ?>
                                        <?php echo $doctor->last_Name; ?><br>
                                        <span class="bold">Payment Status:</span>
                                    <div
                                        class="payment-status-box <?php echo strtolower($appointment->payment_status); ?>">
                                        <p class="paid">
                                            <?php echo $appointment->payment_status; ?>
                                        </p>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const backIconContainer = document.getElementById('back');
            backIconContainer.addEventListener('click', function () {
                window.history.back();
            });
        });
    </script>

</body>