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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\patient\new_appointment_2.css" />
</head>

<body>

    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>

            <div class="adminInfoContainer">
                <?php include 'information_container.php'; ?>

                <div class="menu">
                    <a href="new_appointment.html" id="appointments">New Appointment</a>
                </div>

                <div>
                    <?php $doctor_ID = $_GET['doctor_ID']; ?>
                    <?php $session = $data['session'];
                    $docImage = $data['image']; ?>

                    <?php
                    $doctorname = '';
                    $doctorspec = '';

                    if (!empty($data['session'])) {
                        $doctorname = $data['session'][0]->doctorName;
                        $doctorspec = $data['session'][0]->specialization;
                    }
                    ?>
                    <!-- <p style="font-size: small; color: gray;">Search Results (1)<br>Dr.
                        <?php echo $doctorname; ?>
                    </p> -->

                    <?php if (!empty($data['session'])): ?>
                        <p style="font-size: small; color: gray;">Search Results (1)<br>Dr.
                            <?php echo $doctorname; ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="searchDiv">
                <!-- <img src="<?php echo URLROOT; ?>\public\img\patient\back_arrow_icon.png" alt="back-icon" id="back"> -->
                    <!-- <?php if (!empty($data['session'])): ?> -->
                        <img src="<?php echo URLROOT ?>/public/uploads/profile_images/<?php echo $docImage->profile_photo ?>"
                            alt="profImage">
                        <h1 style="font-size: 24px; color:  #0069FF;">Dr.
                            <?php echo $doctorname; ?>
                        </h1>
                        <p class="spec" style="line-height: 0.4;">
                            <?php echo $doctorspec; ?>
                        </p>
                        <div class="line1"></div>
                        <!-- <?php endif; ?> -->

                    <div class="boxes-container">

                        <?php
                        if (!empty($data['session'])) {
                            foreach ($data['session'] as $session): ?>
                                <?php
                                $date = new DateTime($session->sessionDate);
                                $formatted_date = $date->format("D, jS M, Y");
                                $start_time = date("h:i A", strtotime($session->start_time));
                                $end_time = date("h:i A", strtotime($session->end_time));
                                ?>
                                <div class="box1">
                                    <p class="sessionname">Session #
                                        <?php echo $session->session_ID; ?>
                                    </p>
                                    <p class="text">
                                        Date:
                                        <?php echo $formatted_date; ?>
                                        <br />
                                        Time:
                                        <?php echo $start_time; ?>-
                                        <?php echo $end_time; ?>
                                        <br />
                                        Appointment No:
                                        <strong><?php echo $session->current_appointment; ?></strong>
                                    </p>
                                    <div class="line2"></div>
                                    <button type="button" class="rectangle-70-mtM"
                                        onclick="bookNow(<?php echo $session->session_ID; ?>)">
                                        BOOK NOW
                                    </button>

                                    <script>
                                        function bookNow(sessionID) {
                                            var confirmationURL = "<?php echo URLROOT; ?>/patient/appointment_confirmation";
                                            confirmationURL += "?sessionID=" + encodeURIComponent(sessionID);

                                            window.location.href = confirmationURL;
                                        }
                                    </script>

                                </div>
                            <?php endforeach;
                        } else {
                            echo "No sessions found";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>