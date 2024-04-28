<?php require APPROOT."/views/inc/components/header.php" ?>
    <!-- <link rel="stylesheet" href="styles/pharmacist_dashboard.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_analysis.css" />

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
                    <div class="analysisContent">
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
                    </div>
                    <div class="pieChartContainer">
                        <canvas id="medicationPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var medications = <?php echo json_encode($data['commonlyPrescribedMedications']); ?>;
            var labels = [];
            var counts = [];

            medications.forEach(function(medication) {
                labels.push(medication.medication);
                counts.push(medication.usage_count);
            });

            var ctx = document.getElementById('medicationPieChart').getContext('2d');
            var config = {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Medication Prescriptions',
                        data: counts,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#8E5EA2', '#FF0000'], // Change colors as needed
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        display: true,
                    }
                }
            };

            new Chart(ctx, config);
        });
    </script>

</body>
</html>
