<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Pharmacist Prescription</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_prescription.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- <script src="main.js"></script> -->
</head>

<body>
    <div id="dim-overlay"></div>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT?>/app/views/pharmacist/images/logo.png" />
            </div>

            <div class="userDiv">
                <p class="mainOptions">
                    <Datag>PHARMACIST</Datag>
                </p>
            </div>

            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="<?php echo URLROOT; ?>/Pharmacist/dashboard">Patients</a>
                <a href="">Medications</a>
                <a href="<?php echo URLROOT ?>/Pharmacist/profile">Profile</a>
            </div>
            <div class="othersDiv">
                <p class="sideMenuTexts">Billing</p>
                <p class="sideMenuTexts">Terms of Services</p>
                <p class="sideMenuTexts">Privacy Policy</p>
                <p class="sideMenuTexts">Settings</p>
            </div>

        </div>
        <div class="container">
            <div class="navBar">
                <div class="navBar">
                    <img src="<?php echo URLROOT?>/app/views/pharmacist/images/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT?>/app/views/pharmacist/images/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Patient Name</p>
                            <p class="role">Patient</p>
                        </div>
                    </div>

                    <div class="menu">
                    <p style="color:black">Patients</p>
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/medications">Medications</a></p>
                    </div>
                    
                    <div class="patientSearch">
                        <div class="patient-div">
                            <a href="<?php echo URLROOT ?>/Pharmacist/dashboard">
                                <img
                                  class="vector"
                                  src="<?php echo URLROOT?>/app/views/pharmacist/images/vector.png"
                                  alt="Sample Image"
                                />
                            </a>
                            <img class="person-circle" src="<?php echo URLROOT?>/app/views/pharmacist/images/personcircle.png" alt="patient-pic">
                            <div class="patient-desc">
                                <p><?php echo $_GET['patient_name']; ?></p>
                                <p>Patient ID <?php echo $_GET['patient_id']; ?></p>
                                <p><?php echo $_GET['patient_age']; ?> Years</p>
                            </div>
                        </div>
                        <div class="topic">
                            <label>Prescriptions(<?php echo $data['prescriptionCount'] ?>)</label>
                        </div>
                        <div class="prescription-table">
                        <table>
                            <tbody>
                                <?php foreach ($data['prescriptions'] as $prescription): ?>
                                    <tr class="clickable-row">
                                        <td>
                                        <div class="presDiv" data-prescription-id="<?php echo $prescription->id; ?>">
                                                <img src="<?php echo URLROOT ?>/app/views/pharmacist/images/description.png" alt="download-icon">
                                                <p><?php echo $prescription->prescription_text; ?></p>
                                            </div>
                                        </td>
                                        <td><?php echo $prescription->prescribing_doctor; ?></td>
                                        <td><?php echo $prescription->prescribing_date; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                            <div id="content">
                                
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
    // Attach click event listener to prescription div elements
    $('.presDiv').on('click', function() {
        var prescriptionId = $(this).data('prescription-id');
        var patientName = '<?php echo $_GET['patient_name']; ?>';
        var patientAge = '<?php echo $_GET['patient_age']; ?>';
        // Make AJAX request to fetch prescription details
        $.ajax({
            url: '<?php echo URLROOT; ?>/Pharmacist/getPrescriptionDetails',
            method: 'GET',
            data: { 
                prescription_id: prescriptionId,
                patient_name: patientName,
                patient_age: patientAge
             },
            success: function(response) {
                // Handle the response and display details in the popup
                $('#content').html(response);
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(error);
            }
        });
    });
});
    </script>
    <script src="<?php echo URLROOT?>/app/views/pharmacist/javascripts/pharmcist_prescription.js"></script>
</body>
</html>
