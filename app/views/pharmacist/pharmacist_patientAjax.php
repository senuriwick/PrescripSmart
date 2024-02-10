<link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_dashboard.css" />
    <?php foreach($data['patients'] as $patient): ?>
        <div class="patientFile">
            <div class="fileInfo">
                <img class="person-circle" src="<?php echo URLROOT?>/app/views/pharmacist/images/personcircle.png" alt="patient-pic">
                <p><?php echo $patient->name; ?></p>
            </div>
            <p id="patientId">Patient ID <span><?php echo $patient->id; ?></span></p>
            <a href="<?php echo URLROOT ?>/Pharmacist/allPrescriptions?patient_id=<?php echo $patient->id; ?>" id="viewButton"><button>View Prescriptions</button></a>
        </div>
    <?php endforeach; ?>

