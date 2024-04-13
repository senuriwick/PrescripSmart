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

                <div class="prescriptionsDiv">
                    <div>
                        <div class="section-header">
                            <h1>Appointment (#<?php echo $appointment->appointment_ID?>)</h1>
                        </div>

                    </div>
                    <div class="prescriptionFiles">
                        <div class="file">
                            <div class="group">
                                <div class="number">
                                    <span class="number-sub-0">
                                        NO.<br>
                                        <?php echo $appointment->appointment_No ?>
                                    </span>
                                </div>
                            </div>

                            <div class="text">
                                <div class="auto-group-oxxo-Sau">
                                    <p>
                                        Time:
                                        <?php echo $appointment->time ?><br>
                                        Date:
                                        <?php echo $appointment->date ?><br>
                                        Patient:
                                        <?php echo ($patient->gender == 'male') ? 'Mr.' : 'Ms.' ?>
                                        <?php echo $patient->display_Name ?><br>
                                        Doctor: Dr.
                                        <?php echo $doctor->fName ?>
                                        <?php echo $doctor->lName ?><br>
                                        Payment Status:
                                    </p>
                                    <div class="auto-group-ppa1-jrq">
                                        <p class="paid-fkV" style="color: red; font-weight: 800;">PAID</p>
                                        <!-- <img class="checksquare-h4u" src="CheckSquare.png"/> -->
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>