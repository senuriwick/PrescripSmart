<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Receptionist Assign Patient</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/confirmApp.css" />
    <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script>
</head>

<body>

    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
                <?php include 'information_container.php'; ?>
                <?php include 'in_page_navigation.php'; ?>


                <div class="app-div">
                    <div class="header">
                        <img src="<?php echo URLROOT ?>/img/receptionist/Vector.svg">
                        <h2>Add New Appointment</h2>
                    </div>

                    <?php
                    $dateString = date_create_from_format('Y-m-d', $data['selectedSession']->date);
                    $formatted_date = $dateString->format("Y, jS M, D");
                    $start_time = date("h:i A", strtotime($data['selectedSession']->start_time));
                    $end_time = date("h:i A", strtotime($data['selectedSession']->end_time));
                    ?>
                    <h4>Appointment #24232</h4>
                    <hr style="width: 100vh;">

                    <div class="app-details">
                        <div class="details">
                            <p class="first"><b>Date</b>: </p>
                            <p>Sunday, 17th Sept, 2023</p>
                        </div>

                        <div class="details">
                            <p class="first"><b>Time</b>:</p>
                            <p><?php echo $start_time ?> - <?php echo $end_time ?></p>
                        </div>

                        <div class="details">
                            <p class="first"><b>Doctor</b>: </p>
                            <p>Dr. <?php echo ucwords($data['selectedDoctor']->first_name) ?>
                                <?php echo ucwords($data['selectedDoctor']->last_name) ?></p>
                        </div>

                        <div class="details">
                            <p class="first"><b>Patient</b>: </p>
                            <p>Ms. <?php echo ucwords($data['selectedPatient']->first_name) ?>
                                <?php echo ucwords($data['selectedPatient']->last_name) ?></p>
                        </div>

                        <div class="details">
                            <p class="first"><b>Age</b>:</p>
                            <p><?php echo $data['selectedPatient']->age ?></p>
                        </div>

                        <div class="details">
                            <p class="first"><b>Token No</b>: </p>
                            <p>12</p>
                        </div>

                        <div class="details">
                            <p class="first"><b>Channelling Fee</b>: </p>
                            <p>Rs.<?php echo $data['selectedDoctor']->visit_price ?></p>
                        </div>
                    </div>
                    <button type="submit"
                        onclick="ConfirmAppointment(<?php echo $data['selectedPatient']->patient_id ?>,<?php echo $data['selectedSession']->session_id ?>,<?php echo $data['selectedDoctor']->doctor_id ?>)">Confirm</button>


                    <script>
                        function ConfirmAppointment(patient_id, session_id, doctor_id) {
                            var confirmationURL = "<?php echo URLROOT; ?>/receptionist/confirm_appointment";
                            confirmationURL += "?patientID=" + encodeURIComponent(patient_id);
                            confirmationURL += "&sessionID=" + encodeURIComponent(session_id);
                            confirmationURL += "&doctorID=" + encodeURIComponent(doctor_id);
                            window.location.href = confirmationURL;

                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
</body>