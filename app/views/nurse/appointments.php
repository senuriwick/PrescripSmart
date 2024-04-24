<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>On-going Appointments</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\nurse\appointments.css" />
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
                    <?php if (empty($data['session'])): ?>
                        <p>You currently have no on-going sessions. Thank you!</p>
                    <?php else: ?>
                        <?php $session = $data['session']; ?>
                        <?php $doctor = $data['doctor']; ?>
                        <h1>Appointments (Current Session) #<?php echo $session->session_ID ?>
                        </h1>
                        <p class = "doctorName"><strong>Dr.
                            <?php echo $session->doctorName ?></strong><br>
                            <?php echo $doctor->specialization ?><br>
                            Room 04
                        </p>

                        <?php if (empty($data['appointments'])): ?>
                            <p>No appointments found</p>
                        <?php else: ?>
                            <?php foreach ($data['appointments'] as $appointment): ?>
                                <div class="prescriptionFiles">
                                    <div class="file">
                                        <div class="file2"
                                            onclick="redirectToAppointment(<?php echo $appointment->appointment_ID ?>)">
                                            
                                            <p>Referrence No: #<?php echo $appointment->appointment_ID ?>
                                            </p>
                                            <strong><p class = "name">
                                                <?php echo ($appointment->gender == 'male') ? 'Mr.' : 'Ms.' ?>
                                                <?php echo $appointment->display_Name ?>
                                            </p></strong>
                                            <div class="desDiv">
                                                <p>Time:
                                                <?php echo date('h.i A', strtotime($appointment->time)) ?>
                                                </p>
                                            </div>
                                            <p class="description">No: <?php echo $appointment->token_No ?>
                                            </p>
                                            
                                        </div>

                                        <form method="POST">
                                            <?php
                                            $checkboxId = 'tickBox_' . $appointment->appointment_ID;
                                            $checked = ($appointment->status == 'completed') ? 'checked' : '';
                                            ?>
                                            <input type="checkbox" id="<?php echo $checkboxId ?>"
                                                value="<?php echo $appointment->appointment_ID ?>" <?php echo $checked ?>>
                                            <label for="<?php echo $checkboxId ?>"></label>
                                        </form>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function redirectToAppointment(appointmentID) {
            window.location.href = "<?php echo URLROOT ?>/nurse/appointment_view?reference=" + appointmentID;
        }

        $(document).ready(function () {
            $('input[type="checkbox"]').change(function () {
                var checkbox = $(this);
                var appointmentID = checkbox.val();
                var status = checkbox.is(":checked") ? 'completed' : 'active';
                var formData = { appointmentID: appointmentID, status: status };

                $.ajax({
                    type: 'POST',
                    url: '<?php echo URLROOT ?>/nurse/appointment_complete',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            console.log('Appointment status updated successfully');
                        } else {
                            console.error('Error: ' + response.message);
                        }
                    },
                    error: function () {
                        console.log('Error occurred during AJAX request.');
                    }
                });
            });
        });
    </script>
</body>
</html>