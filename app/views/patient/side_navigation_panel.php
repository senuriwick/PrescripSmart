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
            <p class="mainOptions">Patient Tools</p>

            <div class="menu-item prescriptions">
                <img src="<?php echo URLROOT; ?>/public/img/patient/prescription_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/patient/prescriptions_dashboard" id="prescriptions">Prescriptions</a>
            </div>
            <div class="menu-item reports">
                <img src="<?php echo URLROOT ?>/public/img/patient/reports_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/patient/reports_dashboard" id="reports">Reports</a>
            </div>
            <div class="menu-item appointments">
                <img src="<?php echo URLROOT ?>/public/img/patient/appointment_icon2.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/patient/appointments_dashboard" id="appointments">Appointments</a>
            </div>
            <div class="menu-item sessions">
                <img src="<?php echo URLROOT ?>/public/img/patient/session_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/patient/new_appointment" id="sessions">Sessions</a>
            </div>
            <div class="menu-item inquiries">
                <img src="<?php echo URLROOT ?>/public/img/patient/inquiries_icon2.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/patient/inquiries_dashboard" id="inquiries">Inquiries</a>
            </div>
            <div class="menu-item profile">
                <img src="<?php echo URLROOT ?>/public/img/patient/account_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/patient/personal_information" id="profile">Profile</a>
            </div>
        </div>


        <div class="othersDiv">
            <div class="sub-menu-item terms">
                <img src="<?php echo URLROOT ?>/public/img/general/terms_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/general/terms_of_service" id="terms">Terms of Service</a>
            </div>
            <div class="sub-menu-item privacy">
                <img src="<?php echo URLROOT ?>/public/img/general/privacy_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/general/privacy_policy" id="privacy">Privacy Policy</a>
            </div>
            <div class="sub-menu-item billing">
                <img src="<?php echo URLROOT ?>/public/img/general/contact_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/general/contact_us" id="contact">Contact Us</a>
            </div>
        </div>
    </div>
</body>

</html>