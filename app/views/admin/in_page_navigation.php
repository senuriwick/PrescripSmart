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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\general\in_page_navigation.css" />
</head>

<body>
    <div class="menu">
        <a href="<?php echo URLROOT ?>/admin/searchPatient" id="patients">Patients</a>
        <a href="<?php echo URLROOT ?>/admin/searchDoctor" id="doctors">Doctors</a>
        <a href="<?php echo URLROOT ?>/admin/searchNurse" id="nurses">Nurses</a>
        <a href="<?php echo URLROOT ?>/admin/searchLabtech" id="techs">Lab Technicians</a>
        <a href="<?php echo URLROOT ?>/admin/searchHealthsup" id="supervisors">Health SV</a>
        <a href="<?php echo URLROOT ?>/admin/searchPharmacist" id="pharmacists">Pharmacists</a>
        <a href="<?php echo URLROOT ?>/admin/searchReceptionist" id="receptionists">Receptionists</a>
    </div>
</body>