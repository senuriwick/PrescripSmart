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
                        <!-- Add month selection form -->
                        <form id="monthSelectionForm">
                            <label for="selectedMonth">Select Month:</label>
                            <select id="selectedMonth" name="selectedMonth">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="4">April</option>
                            </select>
                            <button type="submit">Fetch Data</button>
                        </form>
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

            // Add event listener for form submission
            document.getElementById('monthSelectionForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Get selected month from the form
                var selectedMonth = document.getElementById('selectedMonth').value;

                // Send selected month to the controller using AJAX
                fetchMonthlyData(selectedMonth);
            });

            // Function to send selected month to the controller using AJAX
            document.getElementById('monthSelectionForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Get selected month from the form
                var selectedMonth = document.getElementById('selectedMonth').value;

                // Send selected month to the controller using AJAX
                fetchMonthlyData(selectedMonth);
            });

            // Function to send selected month to the controller using AJAX
            function fetchMonthlyData(selectedMonth) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?php echo URLROOT; ?>/pharmacist/analysis', true);
                xhr.setRequestHeader('Content-Type', 'application/json');

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var data = JSON.parse(xhr.responseText);
                            // Handle response data as needed
                            console.log(data);
                        } else {
                            console.error('Error fetching data:', xhr.status);
                        }
                    }
                };

                xhr.send(JSON.stringify({ month: selectedMonth }));
            }

        });
    </script>

</body>
</html>
