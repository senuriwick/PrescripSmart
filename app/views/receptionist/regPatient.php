<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Receptionist register patient</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/RepPatientReg.css" />
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


        <div class="details">
          <div class="back" style="display: flex;">
            <img src="<?php echo URLROOT ?>/img/receptionist/Vector.svg" onclick="goback()">
            <h1>Patient Registration</h1>
          </div>
          <form action="<?php echo URLROOT; ?>/receptionist/regPatient" method="post">

            <div class="top1">
              <div class="firstname">
                <h3>first name</h3>
                <input type="text" placeholder="Enter first name">
              </div>
              <div class="lastname">
                <h3>last name</h3>
                <input type="text" placeholder="Enter last name">
              </div>
            </div>


            <div class="top2">
              <div class="email">
                <h3>email address</h3>
                <input type="text" placeholder="Enter email address">
              </div>
              <div class="phone">
                <h3>phone number</h3>
                <input type="text" placeholder="Enter phone number">
              </div>
            </div>

            <div class="top3">
              <h3>Create password</h3>
              <input type="password" placeholder="Enter password">
            </div>
            <button type="submit"><b>Register</b></button>

          </form>
        </div>

        <div class="popup">
          <h2>Registration successful!</h2>
          <a><button><b>Back to dashboard</b></button></a>
        </div>

      </div>
    </div>
  </div>

</html>