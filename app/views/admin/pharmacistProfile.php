<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Pharmacist Profile</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/Profile.css"/>
<<<<<<< Updated upstream
=======
  <!-- <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/navbar&sidemenu.css"/> -->
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/pharmacist.css"/>
>>>>>>> Stashed changes
  <script src="<?php echo URLROOT ?>/js/admin/script.js"></script>
</head>

<body>

<div class="content">
<<<<<<< Updated upstream
    <?php include 'side_navigation_panel.php'; ?>
=======
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
                <?php include 'information_container.php'; ?>
                <?php include 'in_page_navigation.php'; ?>
>>>>>>> Stashed changes

    <div class="main">
      <?php include 'top_navigation_panel.php'; ?>

      <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>
    <div class="bar1" >
        <div class="search">
                <div class="back" style="display: flex;">                    
                    <img src="<?php echo URLROOT ?>/img/admin/Vector.svg" onclick="goback()" style="cursor: pointer;" >                   
                    <h1 style="font-size: 3.3vh;">Search Pharmacist</h1>
                </div>
        </div>

        <div class="bar2">
            <div class="div-specifier">
                    <div class="user-details">
                        <img class="person-circle" src= "<?php echo URLROOT ?>/img/admin/PersonCircle.png">
                        <h1><strong><?php echo ucwords($data['doctor']->first_Name) ?> <?php echo ucwords($data['doctor']->last_Name) ?></strong></h1>
                    </div>
                    <h3>Employee ID #<?php echo $data['doctor']->user_ID ?></h3>
                    <h4>Personal information</h4>  
                    <hr  style="margin-top: -1.5vh; color:#445172BF;" width="85%">
            </div>

            <div class="row1">                   
                    <div class="firstname">
                            <h2>First Name</h2>
                            <input type="text" value="<?php echo ucwords($data['doctor']->first_Name) ?>">
                     </div>
                     <div class="lastname">
                            <h2>Last Name</h2>
                            <input type="text" value="<?php echo ucwords($data['doctor']->last_Name) ?>">
                     </div> 
            </div>

            <div class="row2">
                    <div class="firstname">
                          <h2>Display Name</h2>
                          <input type="text" value="<?php echo ucwords($data['doctor']->display_Name) ?>">
                    </div>                    
                  
                    <div class="firstname">
                          <h2>Home Address</h2>
                          <input type="text" value="<?php echo ucwords($data['doctor']->home_Address) ?>">
                    </div>    
            </div>

            <div class="row1">                   
                <div class="firstname">
                        <h2>National Identity Card Number</h2>
                        <input type="text" value="<?php echo ucwords($data['doctor']->NIC) ?>">
                </div>
                <div class="lastname">
                        <h2>Contact Number</h2>
                        <input type="text" value="<?php echo $data['doctor']->contact_Number ?>">
                </div> 
            </div>

            <div class="row1">                   
                <div class="firstname">
                        <h2>Pharmacist Registration No.</h2>
                        <input type="text" value="<?php echo ucwords($data['doctor']->registration_No) ?>">
                </div>
                <div class="lastname">
                        <h2>Qualifications</h2>
                        <input type="text" value="<?php echo ucwords($data['doctor']->qualifications) ?>">
                </div> 
            </div>

            <div class="row1">                   
                <div class="firstname">
                        <h2>Department</h2>
                        <input type="text" value="<?php echo ucwords($data['doctor']->department) ?>">
                </div>
                <div class="lastname">
                        <h2>Specialization(If any)</h2>
                        <input type="text" value="<?php echo ucwords($data['doctor']->specialization) ?>">
                </div> 
            </div>

            <!-- <div class="btn">
                <button type="submit" onclick="openPopup()"><b>Save Changes</b></button>     
            </div> -->
              
    </div>
</div>
<script>
      function goback() 
      {
        window.history.back();
      }
     </script>
     </html>
       
               