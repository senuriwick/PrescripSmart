<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>HealthSupervisor Personal Details</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/healthSupervisor/healthSupervisor_personalInfo.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            
            <div class="logoDiv">
            <div>P</div>
            <h5>PrescripSmart</h5>
        </div>

            <div class="manageDiv">
                <p class="mainOptions">Health Supervisor Tools</p>
                <a href="<?php echo URLROOT ?>/HealthSupervisor/dashboard">Inquiries</a>
                <a href="<?php echo URLROOT ?>/HealthSupervisor/history">History</a>
                <a href="<?php echo URLROOT ?>/HealthSupervisor/profile">Profile</a>
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
                <div class="navBar">
                    <img src="<?php echo URLROOT?>/app/views/pharmacist/images/user.png"alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>

            <?php $healthSupervisor = $data['healthSupervisor'] ?>
            <?php $user = $data['user'] ?>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT?>/app/views/pharmacist/images/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name"><?php echo $healthSupervisor->display_name ?></p>
                            <p class="role"><?php echo $user->role ?></p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT ?>/HealthSupervisor/profile">Account</a></p>
                        <p><a href="" style="color: black;font-weight: 500;">Personal Info</a></p>
                        <p><a href="<?php echo URLROOT ?>/HealthSupervisor/security">Security</a></p>
                    </div>

                    <div class="inquiriesDiv">
                    <form action="<?php echo URLROOT; ?>/healthSupervisor/personalInfoUpdate" method="POST">
                        <h1>Pharmacist ID: #
                            <?php echo $healthSupervisor->healthSupervisor_id ?>
                        </h1>
                        <p class="sub1" style="font-weight: bold;">Personal Information</p>
                        <div class="accInfo">
                            <div class="parallel">

                                <div class="input-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fName" name="fName" class="input"
                                        style="display: inline-block;" value="<?php echo $healthSupervisor->first_name; ?>">
                                    <!-- <img src="<?php echo URLROOT; ?>\public\img\patient\pencilsquare-6QZ.png" alt="edit-icon"> -->
                                </div>
                                <div class="input-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lName" name="lName" class="input"
                                        style="display: inline-block;" value="<?php echo $healthSupervisor->last_name; ?>">
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="displayname">Display Name</label>
                                <input type="text" id="displayName" name="displayName" class="input"
                                    value="<?php echo $healthSupervisor->display_name; ?>">
                                <p class="text">*The name displayed on your dashboard</p>
                            </div>
                            <div class="input-group">
                                <label for="address">Home Address</label>
                                <input type="text" id="address" name="address" class="input2"
                                    value=" <?php echo $healthSupervisor->home_address; ?>">
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">National Identity Card No.</label>
                                    <input type="text" id="nic" name="nic" class="input"
                                        style="display: inline-block;" value="<?php echo $healthSupervisor->nic_number; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="contactno">Contact Number</label>
                                    <input type="text" id="contact" name="contact" class="input"
                                        style="display: inline-block;" value="<?php echo $healthSupervisor->contact_number; ?>">
                                </div>
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">Health Supervisor Registration NO</label>
                                    <input type="text" id="regNo" name="regNo" class="input"
                                        style="display: inline-block;" value="<?php echo $healthSupervisor->healthSupervisor_registration_number; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="address">Qualifications</label>
                                    <input type="text" id="qualification" name="qualification" class="input"
                                        value=" <?php echo $healthSupervisor->qualification; ?>">
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="submit" name="submit">SAVE CHANGES</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Select all input elements
            var inputs = document.querySelectorAll('input');

            // Function to handle input change event
            function handleInputChange() {
                // Check if any input field has changed
                var anyChanged = Array.from(inputs).some(function (input) {
                    return input.value !== input.getAttribute('value');
                });

                // If any input field has changed, add 'blue' class to button; otherwise, remove it
                document.getElementById('submit').classList.toggle('blue', anyChanged);
            }

            // Add event listener for input change event to each input field
            inputs.forEach(function (input) {
                input.addEventListener('input', handleInputChange);
            });
        });
    </script>
</body>