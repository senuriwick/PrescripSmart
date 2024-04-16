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

                <?php $groupedSessions = $data['groupedSessions']; ?>

                <?php if (!empty($groupedSessions)): ?>
                    <?php foreach ($groupedSessions as $doctorID => $doctorData): ?>
                        <div class="searchDiv">
                            <div class="info">
                                <img src="<?php echo URLROOT; ?>/public/uploads/profile_images/<?php echo $doctorData['photo']; ?>"
                                    alt="pic">
                                <div class="doctor-info">
                                    <h1>Dr. <?php echo $doctorData['doctorName']; ?></h1>
                                    <p><?php echo $doctorData['specialization']; ?></p>
                                </div>
                            </div>
                            <div class="line1"></div>

                            <div class = "sessionBox">
                            <?php foreach ($doctorData['sessions'] as $session): ?>
                                <div class="boxes-container">
                                    <div class="box1">
                                        <p class="sessionname">Session #<?php echo $session->session_ID; ?></p>
                                        <p class="text">
                                            Date: <?php echo $session->sessionDate; ?> <br />
                                            Time: <?php echo $session->start_time; ?> -
                                            <?php echo $session->end_time; ?>
                                        </p>
                                        <div class="line2"></div>
                                        <button type="button" class="rectangle-70-mtM">ROOM
                                            <?php echo $session->room_no; ?>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
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