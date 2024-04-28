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
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/nurse.css"/>
</head>

<body>

    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
        <?php include 'top_navigation_panel.php';?>

        <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>

                <?php $nurse = $data['nurse'] ?>

                <div class="inquiriesDiv">
                        

                        <div class="patientFileExt">
            <img src="<?php echo URLROOT; ?>\public\img\patient\back_arrow_icon.png" alt="back-icon" class="back-icon"
              id="back-icon">
            <img src="<?php echo URLROOT; ?>\public\uploads\profile_images\<?php echo $nurse->profile_photo ?>"
              alt="patient-pic" class="patient-pic">

            <div class="fileInfo">
            <?php if ($nurse->gender == "male"): ?>
                <p class = "name">Mr.
                  <?php echo $nurse->display_Name; ?>
                </p>
              <?php else: ?>
                <p class = "name">Ms.
                  <?php echo $nurse->display_Name; ?>
                </p>
              <?php endif; ?>
              
              <p class="patientIdClass">Employee ID #<?php echo $nurse->nurse_ID; ?>
              </p>
            </div>
          </div>
                        
                        <p class="sub1" style="font-weight: bold;">Personal Information</p>
                        <div class="accInfo">
                            <div class="parallel">

                                <div class="input-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname" class="input"
                                        style="display: inline-block;" value="<?php echo $nurse->first_Name; ?>" readonly>
                                </div>
                                <div class="input-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="lname" class="input"
                                        style="display: inline-block;" value="<?php echo $nurse->last_Name; ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="input-group">
                                <label for="displayname">Display Name</label>
                                <input type="text" id="dname" name="dname" class="input"
                                    value="<?php echo $nurse->display_Name; ?>" readonly>
                            </div>

                            <div class="input-group">
                                <label for="address">Home Address</label>
                                <input type="text" id="haddress" name="haddress" class="input2"
                                    value="<?php echo $nurse->home_Address; ?>" readonly>
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">National Identity Card No.</label>
                                    <input type="number" id="nic" name="nic" class="input"
                                        style="display: inline-block;" value="<?php echo $nurse->NIC; ?>" readonly>
                                </div>
                                <div class="input-group">
                                    <label for="contactno">Contact Number</label>
                                    <input type="number" id="cno" name="cno" class="input"
                                        style="display: inline-block;" value="<?php echo $nurse->contact_Number; ?>" readonly>
                                </div>
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">Nurse Registration No.</label>
                                    <input type="text" id="nic" name="nic" class="input"
                                        style="display: inline-block;" value="<?php echo $nurse->registration_No; ?>" readonly>
                                </div>
                                <div class="input-group">
                                    <label>Qualifications</label>
                                    <input type="text" id="cno" name="cno" class="input"
                                        style="display: inline-block;" value="<?php echo $nurse->qualifications; ?>" readonly>
                                </div>
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">Department</label>
                                    <input type="text" id="nic" name="nic" class="input"
                                        style="display: inline-block;" value="<?php echo $nurse->department; ?>" readonly>
                                </div>
                                <div class="input-group">
                                    <label>Specialization(If any)</label>
                                    <input type="text" id="cno" name="cno" class="input"
                                        style="display: inline-block;" value="<?php echo $nurse->specialization; ?>" readonly>
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