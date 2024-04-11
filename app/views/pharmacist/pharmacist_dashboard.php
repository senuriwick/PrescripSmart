
<?php require APPROOT."/views/inc/components/header.php" ?>
    <!-- <link rel="stylesheet" href="styles/pharmacist_dashboard.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_dashboard.css" />
    <!-- <link rel="stylesheet" href="styles/sideMenu&navBar.css" /> -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />

    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">

                <img class="logoImg" src="<?php echo URLROOT?>/app/views/pharmacist/images/logo.png" />

            </div>

            <div class="userDiv">
                <p class="mainOptions">
                    <Datag>PHARMACIST</Datag>
                </p>
            </div>

            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="#">Patients</a>
                <a href="<?php echo URLROOT; ?>/Pharmacist/medications">Medications</a>
                <a href="<?php echo URLROOT ?>/Pharmacist/profile">Profile</a>
            </div>
            <div class="othersDiv">
                <p class="sideMenuTexts">Billing</p>
                <p class="sideMenuTexts">Terms of Services</p>
                <p class="sideMenuTexts">Privacy Policy</p>
                <p class="sideMenuTexts">Settings</p>
            </div>

        </div>
        <div class="container">
            <div class="navBar">  
                <img src="<?php echo URLROOT?>/app/views/pharmacist/images/user.png" alt="user-icon">
                <p>USERNAME</p>  
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT?>/app/views/pharmacist/images/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Pharmacist Name</p>
                            <p class="role">Pharmacist</p>
                        </div>
                    </div>

                    <div class="menu">

                        <p style="color:black">Patients</p>
                        <p><a href="<?php echo URLROOT ?>/Pharmacist/medications">Medications</a></p>
                    </div>
                    <hr class="divider">
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
                                <div class="fileInfo">
                                    <img class="person-circle" src="<?php echo URLROOT?>/app/views/pharmacist/images/personcircle.png" alt="patient-pic">
                                    <p><?php echo $patient->name; ?></p>
                                </div>
                                <p id="patientId">Patient ID <span><?php echo $patient->id; ?></span></p>
                                <a href="<?php echo URLROOT ?>/Pharmacist/allPrescriptions?patient_id=<?php echo $patient->id; ?>" id="viewButton"><button>View Prescriptions</button></a>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination Links -->
                    <div class="pagination">
                        <?php if (isset($data['totalPages'])): ?>
                            <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
                                <a href="<?php echo URLROOT; ?>/Pharmacist/dashboard/<?php echo $i; ?>" <?php echo ($i == $data['currentPage']) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </div>

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



 