<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Personal Information</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT?>\public\css\nurse\profile_dashboard_2.css" />
</head>

<body>

    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT?>\public\img\nurse\Untitled design (5) copy 2.png" />
            </div>

            <!-- <div class="patientDiv">
                <p class="mainOptions">PATIENT</p>

                <div class="profile">
                    <p>username</p>
                </div>
            </div> -->

            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>
                <a href="patients_dashboard.html" id="patients">Patients</a>
                <a href="ongoing.html" id="On-going">On-going session</a>
                <a href="sessions.html" id="sessions">Sessions</a>
                <a href="appointments.html" id="appointments">Appoinments</a>
                <a href="profile_dashboard.html" id="profile">Profile</a>
            </div>

            <div class="othersDiv">
                <a href="billing.html" id="billing">Billing</a>
                <a href="terms_of_service.html" id="terms">Terms of Service</a>
                <a href="privacy_policy.html" id="privacy">Privacy Policy</a>
            </div>
        </div>

        <div class="main">
            <div class="navBar">
                <img src="<?php echo URLROOT?>\public\img\nurse\user.png" alt="user-icon">
                <p>SAMPLE USERNAME HERE</p>
            </div>

            <div class="patientInfoContainer">
                <div class="patientInfo">
                    <img src="<?php echo URLROOT?>\public\img\nurse\profile.png" alt="profile-pic">
                    <div class="patientNameDiv">
                        <p class="name">Nurse Name</p>
                        <p class="role">Nurse</p>
                    </div>
                </div>

                <div class="menu">
                    <a href="profile_dashboard.html" id="account">Account</a>
                    <a href="profile_dashboard_2.html" id="personalinfo">Personal Info</a>
                    <a href="profile_dashboard_3.html" id="security">Security</a>
                </div>

                <?php $nurse = $data['nurse'] ?>

                <div class="inquiriesDiv">
                <form action="<?php echo URLROOT; ?>/nurse/personalInfoUpdate" method="POST">
                    <h1>Employee ID: #<?php echo $nurse->nurse_ID ?></h1>
                    <p class="sub1" style="font-weight: bold;">Personal Information</p>
                    <div class="accInfo">
                        <div class="parallel">
                        <div class="input-group">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name = "fname" class="input" style="display: inline-block;" value="<?php echo $nurse->first_Name; ?>">
                        </div>
                        <div class="input-group">
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" class="input" name = "lname" style="display: inline-block;"  value="<?php echo $nurse->last_Name; ?>">
                        </div>
                        </div>
                        <div class="input-group">
                            <label for="displayname">Display Name</label>
                            <input type="text" id="dname" name = "dname" class="input" value="<?php echo $nurse->display_Name; ?>">
                            <p class="text">*The name displayed on your dashboard</p>
                        </div>
                        <div class="input-group">
                            <label for="address">Home Address</label>
                            <input type="text" id="haddress" name = "haddress" class="input2" value="<?php echo $nurse->home_Address; ?>">
                        </div>
                        <div class="parallel">
                            <div class="input-group">
                                <label for="nic">National Identity Card No.</label>
                                <input type="number" id="nic" name = "nic" class="input" style="display: inline-block;" value="<?php echo $nurse->NIC; ?>">
                            </div>
                            <div class="input-group">
                                <label for="contactno">Contact Number</label>
                                <input type="number" id="cno" name = "cno" class="input" style="display: inline-block;" value="<?php echo $nurse->contact_Number; ?>">
                            </div>
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nurseregno">Nurse Registration Number</label>
                                    <input type="text" id="regno" name = "regno" class="input" style="display: inline-block;" value="<?php echo $nurse->registration_No; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="Qualification">Qualifications</label>
                                    <input type="text" id="qual" name = "qual" class="input" style="display: inline-block;" value="<?php echo $nurse->qualifications; ?>">
                                </div>
                                </div>
                                <div class="parallel">
                                    <div class="input-group">
                                        <label for="department">Department</label>
                                        <select class="input">
                                            <option value="" disabled selected>Select Department</option>
                                            <option value="option1">Option 01</option>
                                            <option value="option2">Option 02</option>
                                            <!-- Add more specialization options as needed -->
                                          </select>
                                    </div>
                                    <div class="input-group">
                                        <label for="specialization">Specialization (If Any)</label>
                                        <input type="text" id="spec" name = "spec" class="input" style="display: inline-block;" value="<?php echo $nurse->specializations; ?>">
                                    </div>
                                    </div>
                    </div>

                        <button type="submit" id="submit">SAVE CHANGES</button>
                </form>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
    </div>
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var inputFields = document.querySelectorAll('input[type="text"], input[type="number"]');
            var submitBtn = document.getElementById('submit');

            inputFields.forEach(function (input) {
                input.addEventListener('input', function () {
                    submitBtn.style.backgroundColor = "#0069FF" ;
                    submitBtn.style.borderColor = "#0069FF" ;
                });
            });
        });
    </script>

</body>

</html>