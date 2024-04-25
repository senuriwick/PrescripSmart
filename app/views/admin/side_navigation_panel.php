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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\general\navigation_panel_admin.css" />
</head>

<body>
    <div class="sideMenu">
        <div class="logoDiv">
            <div>P</div>
            <h5>PrescripSmart</h5>
        </div>

        <div class="manageDiv">
            <p class="mainOptions">Admin Tools</p>

            <div class="menu-item patients">
                <img src="<?php echo URLROOT; ?>/public/img/admin/patient_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/admin/searchPatient" id="patients">Patients</a>
            </div>
            <div class="menu-item doctors">
                <img src="<?php echo URLROOT ?>/public/img/admin/doctor_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/admin/searchDoctor" id="doctors">Doctors</a>
            </div>
            <div class="menu-item nurses">
                <img src="<?php echo URLROOT ?>/public/img/admin/nurse_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/admin/searchNurse" id="nurses">Nurses</a>
            </div>
            <div class="menu-item labtechs">
                <img src="<?php echo URLROOT ?>/public/img/admin/lab_tech_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/admin/searchLabtech" id="labtechs">Lab Technicians</a>
            </div>
            <div class="menu-item healthsups">
                <img src="<?php echo URLROOT ?>/public/img/admin/healthsupervisor_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/admin/searchHealthsup" id="healthsups">Health Supervisors</a>
            </div>
            <div class="menu-item pharmacists">
                <img src="<?php echo URLROOT ?>/public/img/admin/pharmacist_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/admin/searchPharmacist" id="pharmacists">Pharmacists</a>
            </div>
            <div class="menu-item receptionists">
                <img src="<?php echo URLROOT ?>/public/img/admin/receptionist_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/admin/searchReceptionist" id="receptionists">Receptionists</a>
            </div>
            <div class="menu-item profile">
                <img src="<?php echo URLROOT ?>/public/img/admin/account_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/admin/personal_information" id="profile">Profile</a>
            </div>
            <!-- <div class="menu-item sessions">
                <img src="<?php echo URLROOT ?>/public/img/doctor/session_icon.png" alt="icon">
                <a href="<?php echo URLROOT; ?>/admin/searchPatient" id="sessions">Medications</a>
            </div> -->
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