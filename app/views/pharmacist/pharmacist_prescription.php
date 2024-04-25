<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pharmacist Prescription</title>
    <link rel="icon" href="/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/public/css/pharmacist/pharmacist_prescription.css" rel="stylesheet">
    <link href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" rel="stylesheet">
</head>
<body>
    <div id="dim-overlay"></div>
    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>
        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>
            <div class="patientInfoContainer">
                <?php include 'information_container.php'; ?>
                <?php include 'in_page_navigation.php'; ?>
                <div class="patientSearch">
                    <div class="patient-div">
                        <a href="<?php echo URLROOT; ?>/Pharmacist/dashboard">
                            <img class="vector" src="<?php echo URLROOT; ?>/app/views/pharmacist/images/vector.png" alt="Sample Image">
                        </a>
                        <img class="person-circle" src="<?php echo URLROOT; ?>/app/views/pharmacist/images/personcircle.png" alt="patient-pic">
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
                                            <div class="presDiv" data-prescription-id="<?php echo $prescription->prescription_ID; ?>">
                                                <img src="<?php echo URLROOT ?>/app/views/pharmacist/images/description.png" alt="download-icon">
                                                <p><?php echo $prescription->diagnosis; ?></p>
                                            </div>
                                        </td>
                                        <td><?php echo $prescription->doctor_ID; ?></td>
                                        <td><?php echo $prescription->prescription_Date; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div id="content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/app/views/pharmacist/javascripts/pharmcist_prescription.js"></script>
</body>
</html>
