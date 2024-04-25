
<?php require APPROOT."/views/inc/components/header.php" ?>
    <!-- <link rel="stylesheet" href="styles/pharmacist_dashboard.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_dashboard.css" />
    <!-- <link rel="stylesheet" href="styles/sideMenu&navBar.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />

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

                    <div class="prescriptionsDiv">
                        <h2>Search Patient</h2>
                        <form method="post" action="<?php echo URLROOT; ?>/Pharmacist/searchPatient">
                            <input type="text" id="search" name="search" placeholder="Enter patient name" class="inputfield">
                            <button type="submit" id="searchButton" disabled>SEARCH</button>
                        </form>
                    </div>
                    <hr class="divider">  

                    <div class="patientFiles">
                        <?php if (empty($data['patients'])): ?>
                            <div class="center-content">
                            <p class="grey-text">Sorry, Not Found</p>
                        </div>
                        <?php else: ?>
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
                        <?php endif; ?>
                    </div>

                    <!-- Pagination Links -->
                    <div class="pagination">
                        <?php 
                            if (!empty($data['totalPages']) && !empty($data['currentPage'])) {
                                $totalPages = $data['totalPages'];
                                $currentPage = $data['currentPage'];
                                
                                // Define the number of pagination links to display before showing the arrow
                                $paginationThreshold = 10;

                                // Determine the start and end points for pagination links
                                $start = max($currentPage - floor($paginationThreshold / 2), 1);
                                $end = min($start + $paginationThreshold - 1, $totalPages);
                                $start = max($end - $paginationThreshold + 1, 1);

                                // Display the pagination links
                                for ($i = $start; $i <= $end; $i++):
                                ?>
                                    <a href="<?php echo URLROOT; ?>/Pharmacist/dashboard/<?php echo $i; ?>" <?php echo ($i == $currentPage) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                                <?php 
                                endfor;

                                // Display the arrow to the right if there are more pages after the displayed links
                                if ($end < $totalPages): 
                                ?>
                                    <a href="<?php echo URLROOT; ?>/Pharmacist/dashboard/<?php echo min($currentPage + 1, $totalPages); ?>">➡️</a>
                                <?php endif; 
                            }
                            ?>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
    

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function () {
    // Attach input event handler to the search input field
    $('#search').on('input', function () {
        // Get the current value of the search input
        var searchTerm = $(this).val();

        // Select the search button
        var searchButton = $('#searchButton');

        // Disable the search button if the search term is empty
        if (searchTerm.trim() === '') {
            searchButton.prop('disabled', true);
        } else {
            searchButton.prop('disabled', false);
        }

        // Perform AJAX request only if the search term is not empty
        if (searchTerm.trim() !== '') {
            $.ajax({
                url: '<?php echo URLROOT; ?>/Pharmacist/searchPatientAjax',
                type: 'POST',
                data: { search: searchTerm },
                success: function (response) {
                    // Check if response is empty (no patient found)
                    if (response.trim() === '') {
                        // Display "Patient not found" message
                        $('.patientFiles').html('<p>Patient not found</p>');
                    } else {
                        // Update the HTML content of the element with the class "patientFiles"
                        $('.patientFiles').html(response);

                        // Hide the pagination div
                        $('.pagination').hide();
                    }
                },
                error: function () {
                    // Handle errors
                }
            });
        } else {
            // Clear the results and show the pagination div if the search term is empty
            // $('.patientFiles').html('');
            $('.pagination').show();
        }
    });
});

</script>

</body>
</html>



 