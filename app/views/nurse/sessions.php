<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Sessions</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\nurse\sessions.css" />
</head>

<body>
    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
        <?php include 'top_navigation_panel.php'; ?>

            <div class="adminInfoContainer">
            <?php include 'information_container.php'; ?>
            <?php include 'in_page_navigation.php'; ?>

                <?php $sessions = $data['sessions']; ?>

                <?php if (!empty($sessions)): ?>
                    <div>
                        <p style="font-size: medium; color: gray;">You have been assigned to the following sessions.</p>
                    </div>

                    <?php
                    // Group sessions by doctor
                    $sessionsByDoctor = [];
                    foreach ($sessions as $session) {
                        $doctorName = $session->doctorName; // Accessing object property
                        if (!isset($sessionsByDoctor[$doctorName])) {
                            $sessionsByDoctor[$doctorName] = [];
                        }
                        $sessionsByDoctor[$doctorName][] = $session;
                    }
                    ?>

                    <?php foreach ($sessionsByDoctor as $doctorName => $doctorSessions): ?>
                        <div class="searchDiv">
                            <h1 style="font-size: 24px; color: #0069FF;">Dr.
                                <?php echo $doctorName; ?>
                            </h1>
                            <!-- <p style="line-height: 0.4;"><?php echo $sessions[0]->$specialization ?></p> -->
                            <div class="line1"></div>

                            <?php foreach ($doctorSessions as $session): ?>
                                <div class="boxes-container">
                                    <div class="box1">
                                        <p class="sessionname">Session #<?php echo $session->session_ID; ?></p>
                                        <p class="text">
                                            Date:
                                            <?php echo $session->sessionDate; ?>
                                            <br />
                                            Time:
                                            <?php echo $session->start_time ?> -
                                            <?php echo $session->end_time ?>
                                        </p>
                                        <div class="line2"></div>
                                        <button type="button" class="rectangle-70-mtM">ROOM
                                            <?php echo $session->room_no; ?>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <div>
                        <p style="font-size: medium; color: gray;">No sessions found.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>