
<?php require APPROOT."/views/inc/components/header.php" ?>
    <!-- <link rel="stylesheet" href="styles/pharmacist_dashboard.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_analysis.css" />


    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
        <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
                <?php include 'information_container.php'; ?>
                <?php include 'in_page_navigation.php'; ?> 
                <div class="analysisContainer">
                    <h2>Medication Analysis</h2>
                    <div class="analysisSection">
                        <h3>Most Commonly Prescribed Medications</h3>
                        <div class="medicationList">
                        <?php foreach ($data['commonlyPrescribedMedications'] as $medication): ?>
                            <div class="medicationItem">
                                <p>Medication Name: <?php echo $medication->medication; ?></p>
                                <p>Total Prescriptions: <?php echo $medication->usage_count; ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- <div class="analysisSection">
                        <h3>Common Dosage Forms</h3>
                        <div class="dosageFormsList"> -->
                            <!-- Display list of common dosage forms -->
                            <!-- Example: -->
                            <!-- <div class="dosageFormItem">
                                <p>Dosage Form: Tablet</p>
                                <p>Total Prescriptions: 80</p>
                            </div> -->
                        <!-- </div>
                    </div> -->

                    <!-- <div class="analysisSection">
                        <h3>Therapeutic Classes</h3>
                        <div class="therapeuticClassesList"> -->
                            <!-- Display list of therapeutic classes -->
                            <!-- Example: -->
                            <!-- <div class="therapeuticClassItem">
                                <p>Therapeutic Class: Analgesics</p>
                                <p>Total Prescriptions: 60</p>
                            </div> -->
                        <!-- </div>
                    </div> -->
                </div>

            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

</script>

</body>
</html>



 