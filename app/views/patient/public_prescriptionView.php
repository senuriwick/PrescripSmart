<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Prescriptions</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\patient\prescriptions_dashboard.css" />

</head>

<body>

    <div class="content">
        <div class="prescriptionsDiv">

            <?php $prescription = $data['prescription']; ?>
            <div id="myModal" class="modal" style="display: block;">

                <div class="modal-content">
                    <a href="www.prescripsmart.com">www.prescripsmart.com</a>
                    <div class="model-head">
                        <img src="<?php echo URLROOT; ?>\public\img\patient\Untitled design (4).png" alt="qr-img" />
                        <h4><u>CONFIDENTIAL PRESCRIPTION</u></h4>
                        <i class="fa-solid fa-circle-arrow-up"></i>
                    </div>
                    <div class="model-details">
                        <div>Prescription ID: #<?php echo $prescription->prescription_ID; ?></div>
                        <div>Patient: <?php echo $prescription->first_Name?> <?php echo $prescription->last_Name?></div>
                        <div>Pres Date & Time:
                            <?php echo $prescription->prescription_Date; ?> 10:00 AM
                        </div>
                        <div>Age: <?php echo $prescription->age?> Yrs</div>
                        <div>Referred by: Dr.
                            <?php echo $prescription->first_Name; ?>
                            <?php echo $prescription->last_Name; ?>
                        </div>
                    </div>
                    <div class="pres-box">
                        <label>Diagnosis</label>
                        <div><?php echo $prescription->diagnosis?>
                        </div>
                    </div>
                    <div class="pres-box">
                        <label>Medication</label>
                        <table>
                            <tbody>
                            <th>Name</th>
                            <th>Dosage</th>
                            <th>Remarks</th>
                                <?php foreach ($data['prescriptionDetails'][$prescription->prescription_ID] as $medicine): ?>
                                    <tr>
                                        <td><?php echo $medicine->medication; ?></td>
                                        <!-- <td><?php echo $medicine->dosage; ?></td> -->
                                        <td><?php echo $medicine->remark; ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pres-box">
                        <label>Lab Tests</label>
                        <table>
                            <tbody>
                                <?php foreach ($data['labDetails'][$prescription->prescription_ID] as $labTest): ?>
                                    <tr>
                                        <td><?php echo $labTest->name ?></td>
                                        <td><?php echo $labTest->remarks ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="notice">(For viewing purpose only)</div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>