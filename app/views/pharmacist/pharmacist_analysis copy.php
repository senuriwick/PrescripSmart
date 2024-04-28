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
    <button id="generateReportButton">Generate Report</button>

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
                        backgroundColor: ['#6CE5E8', '#41B8D5', '#2F5F98', '#2D8BBA'], // Change colors as needed
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

<script>
     // Function to send selected month to the controller using AJAX
     document.getElementById('monthSelectionForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get selected month from the form
            var selectedMonth = document.getElementById('selectedMonth').value;
            console.log(selectedMonth);
            var xhr = new XMLHttpRequest();
            var url = "<?php echo URLROOT ?>/pharmacist/analysisMonth?month=" + selectedMonth;
            xhr.open("GET", url, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);
                    // Handle response data as needed
                    // console.log(data);
                    updatePieChart(data);
                }
            };
            xhr.send();
        });

        function updatePieChart(data) {
            var medications = data;
            var labels = [];
            var counts = [];

            medications.forEach(function(medication) {
                labels.push(medication.medication);
                counts.push(medication.usage_count);
            });

            var ctx = document.getElementById('medicationPieChart').getContext('2d');

            // Check if a Chart instance exists and destroy it
            var existingChart = Chart.getChart(ctx);
            if (existingChart) {
                existingChart.destroy();
            }

            var config = {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Medication Prescriptions',
                        data: counts,
                        backgroundColor: ['#6CE5E8', '#41B8D5', '#2F5F98', '#2D8BBA'], // Change colors as needed
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
        }


        document.getElementById('generateReportButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission (if applicable)

        // Send AJAX request to server-side script for report generation
        var xhr = new XMLHttpRequest();
        var url = "<?php echo URLROOT ?>/pharmacist/generateReport"; // Replace with actual script URL
        xhr.open("POST", url, true); // Change to POST if form has additional data
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Adjust if needed
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle server response - potentially a download link or prompt
            var response = xhr.responseText;
            console.log(response); // For debugging
            // Offer user to download the generated PDF report
            }
        };
        // Send data to server (if applicable)
        // xhr.send("selectedMonth=" + selectedMonth); // Example for sending selected month
        xhr.send();
        });
</script>

</body>
</html>



===================

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
document.getElementById('generateReportButton').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission (if applicable)

        // Send AJAX request to server-side script for report generation
        var xhr = new XMLHttpRequest();
        var url = "<?php echo URLROOT ?>/pharmacist/generateReport"; // Replace with actual script URL
        xhr.open("POST", url, true); // Change to POST if form has additional data
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Adjust if needed
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle server response - potentially a download link or prompt
            var response = xhr.responseText;
            console.log(response); // For debugging
            // Offer user to download the generated PDF report
            }
        };
        // Send data to server (if applicable)
        // xhr.send("selectedMonth=" + selectedMonth); // Example for sending selected month
        xhr.send();
        });
