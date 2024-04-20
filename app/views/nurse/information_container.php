<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Navigation</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\general\information_container.css" />
</head>

<body>
    <div class="patientInfo">

        <div class="profile-pic-container">
            <?php if ($_SESSION['USER_DATA']->profile_photo): ?>
                <img src="<?php echo URLROOT ?>\public\uploads\profile_images\<?php echo $_SESSION['USER_DATA']->profile_photo ?>"
                    alt="profile-pic" id="profile-pic">
            <?php else: ?>
                <img src="<?php echo URLROOT; ?>\public\img\general\profile.png" alt="default-profile-pic" id="profile-pic">
            <?php endif; ?>
        </div>

        <div class="patientNameDiv">
            <p class="name">
                <?php echo $_SESSION['USER_DATA']->first_Name ?>
                <?php echo $_SESSION['USER_DATA']->last_Name ?>
            </p>
            <p class="role">
                <?php echo $_SESSION['USER_DATA']->role ?>
            </p>
        </div>
        
    </div>
</body>