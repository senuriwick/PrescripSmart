<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Search an appointment</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/RepSearchApp.css" />
    <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script>

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
    <h1>Search Appointment</h1>
    <div class="searchFiles">
        <form>
            <input type="search" id="searchinput" placeholder="Enter appointment reference number here">
            <button type="search"><b>SEARCH</b></button>
        </form>
    </div>
<div class="table">
    <table>
        <tbody>
            <?php foreach($data['appointments'] as $post): ?>
                <tr class="row">                        
                    <td>
                    <div class="appointment">

                        <div class="app-id">
                            <h2 class="identity">
                                #
                                <?php echo  $post->appointment_ID ?>
                            </h2>
                            
                            <button>Cancel Appointment</button>
                        </div>
                                                      
                        <div class="app-details">
                            <h3>Time: <?php echo $post -> time ?></h3>
                            <h3>Date: <?php echo $post -> date ?></h3>
                            <h3>Token No: 15</h3>
                        </div>
                                               
                        <div class="app-info">
                            <h4>Patient: Mr. Perera</h4>
                            <h4>Doctor: Dr. Peiris</h4>
                            <h4>Payment Status: 
                            <?php if($post->payment_status == "UNPAID"): ?>
                                <button style="margin-top: -1vh;"><b>MARK AS PAID</b></button></h4>
                            <?php elseif($post->payment_status == "PAID"):  ?>
                                <button style="margin-top: -1vh; background-color:#397A49"><b>PAID</b></button></h4>
                            <?php endif ?>    
                        </div>
                    </td>
                </tr>
            
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>



    <script>
            document.addEventListener("DOMContentLoaded", function () {
                const searchInput = document.getElementById("searchinput");

                searchInput.addEventListener("input", function () {
                    const searchTerm = searchInput.value;
                    const regex = new RegExp(searchTerm, 'i'); 
                    const Rows = document.querySelectorAll(".row");

                    Rows.forEach(function (row) {
                        const NameElement = row.querySelector(".identity");
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
    </script>
      
      <h2 style="color: #445172; margin-left: 3vh; font-size: 2.5vh; margin-top:3vh;">Add new</h2>

        <div class="addapp">
            <div class="newapp">
                <img src="<?php echo URLROOT ?>/img/receptionist/Calendar3.png"">
                <a href="<?php echo URLROOT ?>/receptionist/addAppointment">Schedule an appointment</a>
            </div>
            <p>The modern way schedule and meet with convenience</p>
        </div>
    </div>

</body>