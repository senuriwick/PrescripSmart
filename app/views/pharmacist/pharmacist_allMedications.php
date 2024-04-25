<?php require APPROOT."/views/inc/header.php" ?>
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_allMedications.css" />
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
                        <h2 class="heading">Search Medication</h2>
                        <form method="post" action="<?php echo URLROOT; ?>/Pharmacist/searchMedicine" onsubmit="return validateSearch()">
                            <input type="text" id="search" name="search" placeholder="Enter medicine name" class="inputfield" oninput="toggleSearchButton()">
                            <button type="submit" id="searchButton" disabled>SEARCH</button>
                        </form>
                    </div>

                    <hr class="divider">
        
                    <div class="allMed">
                        <h3 class="heading">Inventory (<?php echo $data['totalMedications'];?>)</h3>
                        <div class="med">
                            <?php foreach($data['medications'] as $medication): ?>
                                <div class="patientFile">
                                    <p class="id"><?php echo $medication->batch_number; ?></p>
                                    <p><?php echo $medication->name; ?></p>
                                    <p id="patientId"><?php echo $medication->dosage; ?></p>
                                    <a href="<?php echo URLROOT ?>/Pharmacist/oneMedDetails?batch_number=<?php echo $medication->batch_number; ?>&name=<?php echo $medication->name; ?>
                                    &dosage=<?php echo $medication->dosage; ?>&id=<?php echo $medication->id; ?>&expiry_date=<?php echo $medication->expiry_date; ?>
                                    &quantity=<?php echo $medication->quantity; ?>&status=<?php echo $medication->status; ?>" id="viewButton"><button>Manage</button></a>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Pagination Links -->
                        <div class="pagination">
                            <?php 
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
                                <a href="<?php echo URLROOT; ?>/Pharmacist/medications/<?php echo $i; ?>" <?php echo ($i == $currentPage) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                            <?php 
                            endfor;

                            // Display the arrow to the right if there are more pages after the displayed links
                            if ($end < $totalPages): 
                            ?>
                                <a href="<?php echo URLROOT; ?>/Pharmacist/medications/<?php echo min($currentPage + 1, $totalPages); ?>">➡️</a>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
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
                    url: '<?php echo URLROOT; ?>/Pharmacist/searchMedicineAjax',
                    type: 'POST',
                    data: { search: searchTerm },
                    success: function (response) {
                        // Update the HTML content of the element with the class "patientFiles"
                        $('.allMed').html(response);

                        // Hide the pagination div
                        $('.pagination').hide();
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

</html>