<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Patients</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="../public/css/lab_tech/patient.css" />
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

                <div class="patientSearch" id="patientSearch">
                    <h1>Search Patient</h1>
                    <form>
                        <input type="text" class="searchBar" id="searchInput" placeholder="Enter patient name or Id" />
                    </form>
                    <hr />
                    <div class="patient-details">
                        <table>
                            <tbody>
                                <?php foreach ($data['reportsToUpload'] as $reportToUpload): ?>
                                    <tr class="patient-detail-row">
                                        <td>
                                            <div class="desDiv">
                                                <img src="../public/img/lab_tech/profile.png" alt="user-icon">
                                                <p class="patientName"><?php echo $reportToUpload->display_Name; ?></p>
                                            </div>
                                        </td>

                                        <td>Patient ID-<?php echo $reportToUpload->patient_ID; ?></td>
                                        <td><a
                                                href="<?php echo URLROOT; ?>/LabTechnician/reports/<?php echo $reportToUpload->patient_ID; ?>"><button>View
                                                    Test</button></a></td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");

            searchInput.addEventListener("input", function () {
                const searchTerm = searchInput.value.toLowerCase();
                const regex = new RegExp(searchTerm, 'i');
                const patientRows = document.querySelectorAll(".patient-detail-row");

                patientRows.forEach(function (row) {
                    const patientName = row.querySelector(".patientName").textContent.toLowerCase();
                    if (regex.test(patientName)) {
                        row.style.display = "table-row";
                    } else {
                        row.style.display = "none";
                    }
                });
            });

        });

    </script>
</body>

</html>