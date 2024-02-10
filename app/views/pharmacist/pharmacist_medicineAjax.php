<link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_allMedications.css" />
    <?php foreach($data['medications'] as $medication): ?>
        <div class="patientFile">
            <p class="id"><?php echo $medication->batch_number; ?></p>
            <p><?php echo $medication->name; ?></p>
            <p id="patientId"><?php echo $medication->dosage; ?></p>
            <a href="<?php echo URLROOT ?>/Pharmacist/oneMedDetails?batch_number=<?php echo $medication->batch_number; ?>&name=<?php echo $medication->name; ?>&dosage=<?php echo $medication->dosage; ?>&id=<?php echo $medication->id; ?>&expiry_date=<?php echo $medication->expiry_date; ?>&quantity=<?php echo $medication->quantity; ?>&status=<?php echo $medication->status; ?>" id="viewButton"><button>Manage</button></a>
        </div>
    <?php endforeach; ?>

