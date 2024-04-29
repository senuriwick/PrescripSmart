<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Patient profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/Profile.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/supervisor.css"/>
</head>

<body>

    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
        <?php include 'top_navigation_panel.php';?>

        <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>

                <?php $healthsup = $data['healthsup'] ?>

<<<<<<< HEAD
        <div class="bar2">
            <div class="div-specifier">
                    <div class="user-details">
                        <img class="person-circle" src= "<?php echo URLROOT ?>/img/admin/PersonCircle.png">
                        <h1><strong><?php echo ucwords($data['doctor']->first_Name) ?> <?php echo ucwords($data['doctor']->last_Name) ?></strong></h1>
                    </div>
                    <h3>Employee ID #<?php echo $data['doctor']->user_ID ?></h3>
                    <h4>Personal information</h4>  
                    <hr style="margin-top: -1.5vh; color:#445172BF;" width="85%">
            </div>
=======
                <div class="inquiriesDiv">
                        
>>>>>>> bebfa1faf0ab4ed1ad59fd62cfa9937d8214108b

                        <div class="patientFileExt">
            <img src="<?php echo URLROOT; ?>\public\img\patient\back_arrow_icon.png" alt="back-icon" class="back-icon"
              id="back-icon">
            <img src="<?php echo URLROOT; ?>\public\uploads\profile_images\<?php echo $healthsup->profile_photo ?>"
              alt="patient-pic" class="patient-pic">

<<<<<<< HEAD
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
                        <h2>Health Supervisor Registration No.</h2>
                        <input type="text" value="<?php echo ucwords($data['doctor']->registration_No) ?>">
                </div>
                <div class="lastname">
                        <h2>Qualifications</h2>
                        <input type="text" value="<?php echo $data['doctor']->qualifications ?>">
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
=======
            <div class="fileInfo">
            <?php if ($healthsup->gender == "male"): ?>
                <p class = "name">Mr.
                  <?php echo $healthsup->display_Name; ?>
                </p>
              <?php else: ?>
                <p class = "name">Ms.
                  <?php echo $healthsup->display_Name; ?>
                </p>
              <?php endif; ?>
>>>>>>> bebfa1faf0ab4ed1ad59fd62cfa9937d8214108b
              
              <p class="patientIdClass">Employee ID #<?php echo $healthsup->supervisor_ID; ?>
              </p>
            </div>
          </div>
                        
                        <p class="sub1" style="font-weight: bold;">Personal Information</p>
                        <div class="accInfo">
                            <div class="parallel">

                                <div class="input-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname" class="input"
                                        style="display: inline-block;" value="<?php echo $healthsup->first_Name; ?>" readonly>
                                </div>
                                <div class="input-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="lname" class="input"
                                        style="display: inline-block;" value="<?php echo $healthsup->last_Name; ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="input-group">
                                <label for="displayname">Display Name</label>
                                <input type="text" id="dname" name="dname" class="input"
                                    value="<?php echo $healthsup->display_Name; ?>" readonly>
                            </div>

                            <div class="input-group">
                                <label for="address">Home Address</label>
                                <input type="text" id="haddress" name="haddress" class="input2"
                                    value="<?php echo $healthsup->home_Address; ?>" readonly>
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">National Identity Card No.</label>
                                    <input type="number" id="nic" name="nic" class="input"
                                        style="display: inline-block;" value="<?php echo $healthsup->NIC; ?>" readonly>
                                </div>
                                <div class="input-group">
                                    <label for="contactno">Contact Number</label>
                                    <input type="number" id="cno" name="cno" class="input"
                                        style="display: inline-block;" value="<?php echo $healthsup->contact_Number; ?>" readonly>
                                </div>
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">Registration No. (If Any)</label>
                                    <input type="text" id="nic" name="nic" class="input"
                                        style="display: inline-block;" value="<?php echo $healthsup->registration_No; ?>" readonly>
                                </div>
                                <div class="input-group">
                                    <label>Qualifications</label>
                                    <input type="text" id="cno" name="cno" class="input"
                                        style="display: inline-block;" value="<?php echo $healthsup->qualifications; ?>" readonly>
                                </div>
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">Department</label>
                                    <input type="text" id="nic" name="nic" class="input"
                                        style="display: inline-block;" value="<?php echo $healthsup->department; ?>" readonly>
                                </div>
                                <div class="input-group">
                                    <label>Specialization(If any)</label>
                                    <input type="text" id="cno" name="cno" class="input"
                                        style="display: inline-block;" value="<?php echo $healthsup->specialization; ?>" readonly>
                                </div>
                            </div>
                        </div>
                </div>

            </div>

        </div>
    </div>

    </div>
    </div>
    </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('back-icon').addEventListener('click', goback);
});

function goback() {
    window.history.back();
}
</script>
</body>
</html>