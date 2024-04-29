<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Receptionist register Doctor</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/addSession.css" />
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


                <div class="details">
                    <div class="back" style="display: flex;">
                        <img src="<?php echo URLROOT ?>/img/receptionist/Vector.svg" onclick="goback()">
                        <h1>Doctor Sessions</h1>
                    </div>

                    <form action="<?php echo URLROOT; ?>/receptionist/newSession/<?php echo $data['doctor']->doctor_ID ?>" method="post">
                        <div class="top1">
                            <div class="firstname">
                                <div class="req">
                                    <h3 style="color: #0069FF;">Start Time</h3>
                                    <p style="color: red;">*</p>
                                </div>
                                <input type="time" name="first_name" placeholder="Enter Your first name">
                            </div>
                            <div class="lastname">
                                <div class="req">
                                    <h3 style="color: #0069FF;">End Time</h3>
                                    <p style="color: red;">*</p>
                                </div>
                                <input type="time" name="last_name" placeholder="Enter Your last name">
                            </div>
                        </div>

                        <div class="top2">
                            <div class="email">
                                <h3>Total Appointments</h3>
                                <input type="number" name="email" placeholder="Enter Your email address">
                            </div>
                            <div class="phone">
                                <div class="req">
                                    <h3 style="color: #0069FF;">Room Number</h3>
                                    <p style="color: red;">*</p>
                                </div>
                                <input type="text" name="phone_number" placeholder="Enter Your phone number">
                            </div>
                        </div>

                        
                        <button type="submit"><b>Add Session</b></button>
                    </form>
                </div>               
            </div>
        </div>
    </div>

</html>