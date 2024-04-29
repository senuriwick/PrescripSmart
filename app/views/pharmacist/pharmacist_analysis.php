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
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <button id = "fetchData" type="submit">Fetch Data</button>
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
                <button class="printReport" onclick="printReport()">Print Report</button>
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
    //  function printReport() {
    //     var printContent = document.querySelector('.analysisContainer').outerHTML;
    //     var originalContent = document.body.innerHTML;
        
    //     document.body.innerHTML = printContent;

    //     // Wait a short delay for rendering to complete, then trigger print
    //     setTimeout(function() {
    //         window.print();
    //         document.body.innerHTML = originalContent;
    //     }, 500);
    // }

    function printReport() {
    // Hide the fetch data button before printing
        var fetchDataButton = document.getElementById('fetchData');
        fetchDataButton.style.display = 'none';

        var printContent = document.querySelector('.analysisContainer').outerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        var monthLabel = document.querySelector('label[for="selectedMonth"]');

    // Update the label text to "Selected Month"
        monthLabel.innerText = "Selected Month";

        // Wait a short delay for rendering to complete, then trigger print
        setTimeout(function() {
            window.print();
            document.body.innerHTML = originalContent;
            // Restore the visibility of the fetch data button after printing
            fetchDataButton.style.display = 'block';
        }, 500);
    }

    
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

            // Update the analysis section HTML
            updateAnalysisSectionHTML(data);
        }

        function updateAnalysisSectionHTML(data) {
            var analysisSection = document.querySelector('.analysisSection');
            var medicationListHTML = '';

            data.forEach(function(medication) {
                medicationListHTML += `
                    <div class="medicationItem">
                        <p>Medication Name: ${medication.medication}</p>
                        <p>Total Prescriptions: ${medication.usage_count}</p>
                    </div>
                `;
            });

            analysisSection.innerHTML = `
                <h3>Most Commonly Prescribed Medications</h3>
                <div class="medicationList">${medicationListHTML}</div>
            `;
        }

</script>

<!-- <script>
    document.getElementById('generateReportButton').addEventListener('click', function() {
        printBtn = document.getElementById('generateReportButton');
        printBtn.style.display = 'none';
        window.print();
        printBtn.style.display = 'block';
    });
</script> -->

<!-- <script>
document.getElementById('generateReportButton').addEventListener('click', function() {
    // Construct the URL with query parameters
    var url = '<?php echo URLROOT ?>/pharmacist/printable_analysis.php?';

    // Append each medication data to the URL
    <?php foreach ($data['commonlyPrescribedMedications'] as $medication): ?>
        url += 'medication[]=<?php echo urlencode($medication->medication); ?>&';
        url += 'usage_count[]=<?php echo urlencode($medication->usage_count); ?>&';
    <?php endforeach; ?>

    // Redirect to the printable analysis page
    window.location.href = url;
});
</script> -->



</body>
</html>
