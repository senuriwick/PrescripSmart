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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\patient\profile_dashboard_2.css" />
</head>

<body>

    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT; ?>\public\img\patient\Untitled design (5) copy 2.png" />
            </div>

            <!-- <div class="patientDiv">
                <p class="mainOptions">PATIENT</p>

                <div class="profile">
                    <p>username</p>
                </div>
            </div> -->

            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="prescriptions_dashboard.html" id="prescriptions">Prescriptions</a>
                <a href="reports_dashboard.html" id="reports">Reports</a>
                <a href="appointments_dashboard.html" id="appointments">Appointments</a>
                <a href="inquiries_dashboard.html" id="inquiries">Inquiries</a>
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
                <img src="<?php echo URLROOT; ?>\public\img\patient\user.png" alt="user-icon">
                <p>SAMPLE USERNAME HERE</p>
            </div>

            <div class="patientInfoContainer">
                <div class="patientInfo">
                    <img src="<?php echo URLROOT; ?>\public\img\patient\profile.png" alt="profile-pic">
                    <div class="patientNameDiv">
                        <p class="name">Patient Name</p>
                        <p class="role">Patient</p>
                    </div>
                </div>

                <div class="menu">
                    <a href="profile_dashboard.html" id="account">Account</a>
                    <a href="profile_dashboard_2.html" id="personalinfo">Personal Info</a>
                    <a href="profile_dashboard_3.html" id="security">Security</a>
                </div>

                <?php $patient = $data['patient'] ?>

                <div class="inquiriesDiv">
                    <form action="<?php echo URLROOT; ?>/patient/personalInfoUpdate" method="POST">
                        <h1>Patient ID: #
                            <?php echo $patient->patient_ID ?>
                        </h1>
                        <p class="sub1" style="font-weight: bold;">Personal Information</p>
                        <div class="accInfo">
                            <div class="parallel">

                                <div class="input-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname" class="input"
                                        style="display: inline-block;" value="<?php echo $patient->first_Name; ?>">
                                    <!-- <img src="<?php echo URLROOT; ?>\public\img\patient\pencilsquare-6QZ.png" alt="edit-icon"> -->
                                </div>
                                <div class="input-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="lname" class="input"
                                        style="display: inline-block;" value="<?php echo $patient->last_Name; ?>">
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="displayname">Display Name</label>
                                <input type="text" id="dname" name="dname" class="input"
                                    value="<?php echo $patient->display_Name; ?>">
                                <p class="text">*The name displayed on your dashboard</p>
                            </div>
                            <div class="input-group">
                                <label for="address">Home Address</label>
                                <input type="text" id="haddress" name="haddress" class="input2"
                                    value="<?php echo $patient->home_Address; ?>">
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">National Identity Card No.</label>
                                    <input type="number" id="nic" name="nic" class="input"
                                        style="display: inline-block;" value="<?php echo $patient->NIC; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="contactno">Contact Number</label>
                                    <input type="number" id="cno" name="cno" class="input"
                                        style="display: inline-block;" value="<?php echo $patient->contact_Number; ?>">
                                </div>
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" id="dob" name="dob" class="input" style="display: inline-block;"
                                        value="<?php echo $patient->DOB; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="age">Age</label>
                                    <input type="number" id="age" name="age" class="input"
                                        style="display: inline-block;" value="<?php echo $patient->age; ?>">
                                </div>
                            </div>
                        </div>

                        <p class="sub2" style="font-weight: bold;">Personal Health Information</p>
                        <div class="accInfo">
                            <div class="input-group">
                                <label for="gender">Gender</label>
                                <input type="text" id="gender" name="gender" class="input2"
                                    value="<?php echo $patient->gender; ?>">
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="height">Height (cm)</label>
                                    <input type="number" id="height" name="height" class="input"
                                        style="display: inline-block;" value="<?php echo $patient->height; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="weight">Weight (kg)</label>
                                    <input type="number" id="weight" name="weight" class="input"
                                        style="display: inline-block;" value="<?php echo $patient->weight; ?>">
                                </div>
                            </div>
                        </div>

                        <p class="sub3" style="font-weight: bold;">Emergency Contact Information</p>
                        <div class="accInfo">
                            <div class="input-group">
                                <label for="ecpersonname">Emergency Contact Person Name</label>
                                <input type="text" id="ename" name="ename" class="input2"
                                    value="<?php echo $patient->emergency_Contact_Person; ?>">
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="econtactno">Emergency Contact Number</label>
                                    <input type="number" id="econtact" name="econtact" class="input"
                                        style="display: inline-block;"
                                        value="<?php echo $patient->emergency_Contact_Number; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="relationship">Relationship</label>
                                    <input type="text" id="relationship" name="relationship" class="input"
                                        style="display: inline-block;" value="<?php echo $patient->relationship; ?>">
                                    <!-- <select class="input">
                                        <option value="" disabled selected>Select Relationship</option>
                                        <option value="option1">Option 1</option>
                                        <option value="option2">Option 2</option>
                                         Add more specialization options as needed -->
                                    <!-- </select> -->
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="submit" name="submit">SAVE CHANGES</button>
                    </form>
                </div>
                </form>
            </div>

        </div>
    </div>

    </div>
    </div>
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var inputFields = document.querySelectorAll('input[type="text"], input[type="number"], input[type="date"]');
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