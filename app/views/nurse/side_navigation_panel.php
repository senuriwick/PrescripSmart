<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Navigation panel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\general\navigation_panel.css" />
</head>

<body>
    <div class="sideMenu">
        <div class="logoDiv">
            <div>P</div>
            <h5>PrescripSmart</h5>
        </div>

        <div class="manageDiv">
            <p class="mainOptions">Nurse Tools</p>

            <div class="menu-item patients">
                <img src="<?php echo URLROOT; ?>/public/img/nurse/patient_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/nurse/patients_dashboard" id="patients">Patients</a>
            </div>
            <div class="menu-item on-going">
                <img src="<?php echo URLROOT ?>/public/img/nurse/ongoing_icon2.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/nurse/ongoing_session" id="on-going">On-going session</a>
            </div>
            <div class="menu-item sessions">
                <img src="<?php echo URLROOT ?>/public/img/nurse/session_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/nurse/sessions" id="sessions">Sessions</a>
            </div>
            <div class="menu-item appointments">
                <img src="<?php echo URLROOT ?>/public/img/nurse/appointment_icon2.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/nurse/appointments" id="appointments">Appoinments</a>
            </div>
            <div class="menu-item profile">
                <img src="<?php echo URLROOT ?>/public/img/nurse/account_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/nurse/personal_information" id="profile">Profile</a>
            </div>
        </div>


        <div class="othersDiv">
            <div class="sub-menu-item billing">
                <img src="<?php echo URLROOT ?>/public/img/general/billing_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/general/billing.html" id="billing">Billing</a>
            </div>
            <div class="sub-menu-item terms">
                <img src="<?php echo URLROOT ?>/public/img/general/terms_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/general/terms_of_service.html" id="terms">Terms of Service</a>
            </div>
            <div class="sub-menu-item privacy">
                <img src="<?php echo URLROOT ?>/public/img/general/privacy_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/general/privacy_policy.html" id="privacy">Privacy Policy</a>
            </div>
        </div>
    </div>
</body>

</html>