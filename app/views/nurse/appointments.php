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
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT ?>\public\img\nurse\Untitled design (5) copy 2.png" />
            </div>

            <!-- <div class="patientDiv">
                <p class="mainOptions">PATIENT</p>

                <div class="profile">
                    <p>username</p>
                </div>
            </div> -->


            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="patients_dashboard.html" id="patients">Patients</a>
                <a href="ongoing.html" id="On-going">On-going session</a>
                <a href="sessions.html" id="sessions">Sessions</a>
                <a href="appointments.html" id="appointments">Appoinments</a>
                <a href="profile.html" id="profile">Profile</a>
            </div>


            <div class="othersDiv">
                <a href="billing.html" id="billing">Billing</a>
                <a href="terms_of_service.html" id="terms">Terms of Service</a>
                <a href="privacy_policy.html" id="privacy">Privacy Policy</a>
            </div>

        </div>

        <div class="main">
            <div class="navBar">
                <img src="<?php echo URLROOT ?>\public\img\nurse\user.png" alt="user-icon">
                <p>SAMPLE USERNAME HERE</p>
            </div>

            <div class="patientInfoContainer">
                <div class="patientInfo">
                    <img src="<?php echo URLROOT ?>\public\img\nurse\profile.png" alt="profile-pic">
                    <div class="patientNameDiv">
                        <p class="name">Nurse Name</p>
                        <p class="role">Nurse</p>
                    </div>
                </div>

                <div class="menu">
                    <a href="patients_dashboard.html" id="patients">Patients</a>
                    <a href="ongoing.html" id="On-going">On-going session</a>
                    <a href="sessions.html" id="sessions">Sessions</a>
                    <a href="appointments.html" id="appointments">Appoinments</a>
                </div>

                <div class="prescriptionsDiv">
                    <?php if (empty($data['session'])): ?>
                        <p>You currently have no on-going sessions. Thank you!</p>
                    <?php else: ?>
                        <?php $session = $data['session']; ?>
                        <?php $doctor = $data['doctor']; ?>
                        <h1>Appointments (Current Session) #
                            <?php echo $session->session_ID ?>
                        </h1>
                        <p>DR.
                            <?php echo $session->doctorName ?><br>
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
                                            <div class="desDiv">
                                                <p class="description">Time:
                                                    <?php echo $appointment->time ?>
                                                </p>
                                            </div>
                                            <p>Referrence No: #
                                                <?php echo $appointment->appointment_ID ?>
                                            </p>
                                            <p>Appointment No:
                                                <?php echo $appointment->appointment_No ?>
                                            </p>
                                            <p>
                                                <?php echo ($appointment->gender == 'male') ? 'Mr.' : 'Ms.' ?>
                                                <?php echo $appointment->display_Name ?>
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