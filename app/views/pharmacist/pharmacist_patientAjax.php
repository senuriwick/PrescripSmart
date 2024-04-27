<link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_dashboard.css" />
    <?php foreach($data['patients'] as $patient): ?>
        <div class="patientFile">
        <img class="person-circle" src="<?php echo URLROOT?>/app/views/pharmacist/images/personcircle.png" alt="patient-pic">
        <p><?php echo $patient->display_Name; ?></p>
        <p id="patientId">Patient ID <span><?php echo $patient->patient_ID; ?></span></p>
        <a href="<?php echo URLROOT ?>/Pharmacist/allPrescriptions?patient_id=<?php echo $patient->patient_ID; ?>
        &patient_name=<?php echo urlencode($patient->display_Name); ?>
        &patient_age=<?php echo $patient->age; ?>" id="viewButton"><button>View Prescriptions</button></a>
    </div>
    <?php endforeach; ?>

