<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8" />
      <link rel="icon" href="/favicon.ico" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta name="theme-color" content="#000000" />
      <title>Register a Lab technician</title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
      <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/RegisterActor.css"/>
      <!-- <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/navbar&sidemenu.css"/> -->
      <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/tech.css"/>
      <script src="<?php echo URLROOT ?>/js/admin/script.js"></script>
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
        <div class="back" style="display: flex; ">         
            <img src="<?php echo URLROOT ?>/img/admin/Vector.svg" onclick="goback()" style="cursor: pointer;" >
            <h1 >Lab Technician Registration</h1>
        </div> 

        <form action="<?php echo URLROOT; ?>/admin/regLabtech "method="POST">
            <div class="top1">
                  <div class="firstname">
                        <div class="req">
                          <h3 style="color: #0069FF;">first name</h3>
                          <p style="color: red;">*</p>
                        </div>
                        <input type="text" name="first_name" placeholder="Enter Your first name">
                  </div>
                  <div class="lastname">
                      <div class="req">
                          <h3 style="color: #0069FF;">last name</h3>
                          <p style="color: red;">*</p>
                      </div>
                      <input type="text" name="last_name" placeholder="Enter Your last name">
                  </div>
            </div>

            <div class="top2">
                <div class="email">
                    <h3>email address</h3>
                    <input type="text" name="email" placeholder="Enter Your email address">
                </div>
                <div class="phone">
                    <div class="req">
                      <h3 style="color: #0069FF;">contact number</h3>
                      <p style="color: red;">*</p>
                    </div>
                    <input type="text" name="phone_number" placeholder="Enter Your phone number">
                </div>
            </div>

            <div class="top3">
                <div class="req">
                    <h3 style="color: #0069FF;">create password</h3>
                    <p style="color: red;">*</p>
                </div>
                <input type="password" name="password" placeholder="Enter password">
            </div>
            <button type="submit"><b>Register</b></button>
        </form>
        <script>
      function goback() 
    {
        window.history.back();
    }
     </script>
  </div>   

        <!-- <div class="popup">
          <h2>Registration successful!</h2>
          <a><button><b>Back to dashboard</b></button></a>
        </div> -->


</html>
        