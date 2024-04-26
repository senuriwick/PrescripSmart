<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Manage an Appointment</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/sessionManage.css" />
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


        <h3 class="today-date" id="today-date"></h3>
        <script>
          var today = new Date();
          var suffixes = ["th", "st", "nd", "rd"];
          function getDaySuffix(day) {
            if (day >= 11 && day <= 13) {
              return "th";
            }
            var index = day % 10;
            return (index <= 3) ? suffixes[index] : "th";
          }
          var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
          var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

          // Format the date
          var formattedDate = today.getDate() + getDaySuffix(today.getDate()) + " " + days[today.getDay()] + ", " + months[today.getMonth()] + " " + today.getFullYear();

          // Display the date
          document.getElementById("today-date").innerHTML = formattedDate;
        </script>

        <div class="searchDiv">
          <h1>Todays' Sessions</h1>
          <div class="searchFiles">
            <input class="search-input" type="search" placeholder="Search Doctor name/ID here">
            <button type="search"><b>SEARCH</b></button>
          </div>
        </div>

        <div class="sessions">
          <div class="doc-info">
            <img src="<?php echo URLROOT ?>/img/receptionist/PersonCircle.png" alt="user-icon">
            <h3>Dr. Asanka Sayakkara</h3>
          </div>

          <h5>Consultant physician</h5>
          <hr style="color: #D9D9D9; margin-bottom:2vh; width:90vh; margin-top: -2vh;">

          <div class="session-card">
            <h4><strong>Session #23233</strong></h4>
            <hr style="margin-top: -2vh; width: 25vh; color:#445172BF;">
            <p>Date: Sunday, 17th Sept, 2023</p>
            <p>Time: 06.00 A.M </p>
            <button><strong>CANCEL</strong> </button>
          </div>
        </div>
      </div>
    </div>
  </div>