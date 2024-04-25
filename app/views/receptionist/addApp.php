<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Receptionist Add appointmnet</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/RepAddApp.css" />


</head>

<body>

    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
                <?php include 'information_container.php'; ?>
                <?php include 'in_page_navigation.php'; ?>


                <div class="searchDiv">
                    <h1>Add New Appointment</h1>
                    <div class="searchFiles">
                        <form>
                            <input type="search" id="searchinput" placeholder="Enter doctor name or ID here">
                            <button type="search"><b>SEARCH</b></button>
                        </form>
                    </div>

                    <hr style="margin-bottom: 3vh; margin-top:-0.5vh">

                    <div class="details">
                        <table>
                            <tbody>
                                <?php foreach ($data['doctors'] as $post): ?>
                                    <tr class="row">
                                        <td>
                                            <div class="app-doc">
                                                <img src="<?php echo URLROOT ?>/img/receptionist/PersonCircle.png"
                                                    alt="profile-pic">
                                                <h3 class="name">
                                                    <?php echo ucwords($post->last_name); ?>
                                                </h3>
                                            </div>
                                            <h4 class="doc-pos"><?php echo $post->specialization; ?></h4>

                                            <div class="session-details">
                                                <?php foreach ($data['sessions'] as $sessions): ?>


                                                    <?php if ($post->doctor_id == $sessions->doctor_id): ?>
                                                        <div class="sessions">
                                                            <?php
                                                            $dateString = date_create_from_format('Y-m-d', $sessions->date);
                                                            $formatted_date = $dateString->format("Y, jS M, D");
                                                            $start_time = date("h:i A", strtotime($sessions->start_time));
                                                            $end_time = date("h:i A", strtotime($sessions->end_time));
                                                            ?>
                                                            <h4><strong>Session #<?php echo $sessions->session_id; ?></strong></h4>
                                                            <hr style="margin-top: -2vh; width: 25vh; color:#445172BF;">
                                                            <p>Date: <?php echo $formatted_date; ?></p>
                                                            <p>Time: <?php echo $start_time . ' - ' . $end_time; ?></p>

                                                            <button onclick="bookNow(<?php echo $sessions->session_id; ?>)">
                                                                <strong>BOOK NOW</strong>
                                                            </button>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                            <br>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const searchInput = document.getElementById("searchinput");

                            searchInput.addEventListener("input", function () {
                                const searchTerm = searchInput.value.toLowerCase();
                                const regex = new RegExp(searchTerm, 'i');
                                const Rows = document.querySelectorAll(".row");

                                Rows.forEach(function (row) {
                                    const NameElement = row.querySelector(".name");
                                    if (NameElement) { // Check if the element is not null
                                        const Name = NameElement.textContent.toLowerCase();
                                        if (regex.test(Name)) {
                                            row.style.display = "";
                                        } else {
                                            row.style.display = "none";
                                        }
                                    }
                                });
                            });
                        });

                        function bookNow(sessionID) {
                            var confirmationURL = "<?php echo URLROOT; ?>/receptionist/create_appointment";
                            confirmationURL += "?sessionID=" + encodeURIComponent(sessionID);

                            window.location.href = confirmationURL;
                        }

                    </script>

                </div>
            </div>
        </div>
    </div>
</body>