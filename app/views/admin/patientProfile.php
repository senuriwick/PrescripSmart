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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/patientProfile.css" />
</head>

<body>

    <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
        <?php include 'top_navigation_panel.php';?>

        <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>

                <?php $patient = $data['patient'] ?>

                <div class="inquiriesDiv">
                         <div class="back" style="display: flex;">                    
                            <img src="<?php echo URLROOT ?>/img/admin/Vector.svg" onclick="goback()" style="cursor: pointer;" >                   
                            <h1 style="font-size: 3.3vh;">Search Patient</h1>                           
                        </div>
                        <p class="display-id">Patient ID: #
                            <?php echo $patient->patient_ID ?>
                        </p>
                        
                        <p class="sub1" style="font-weight: bold;">Personal Information</p>
                        <div class="accInfo">
                            <div class="parallel">

                                <div class="input-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname" class="input"
                                        style="display: inline-block;" value="<?php echo $patient->first_Name; ?>">
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
        document.addEventListener("DOMContentLoaded", function () {
            var inputFields = document.querySelectorAll('input[type="text"], input[type="number"], input[type="date"]');
            var submitBtn = document.getElementById('submit');

            inputFields.forEach(function (input) {
                input.addEventListener('input', function () {
                    submitBtn.style.backgroundColor = "#0069FF";
                    submitBtn.style.borderColor = "#0069FF";
                });
            });
        });
    </script>

<script>


      function goback() 
      {
        window.history.back();
      }
   
    document.addEventListener("DOMContentLoaded", function () {
    var editIcon = document.getElementById('edit-icon');
    var fileInput = document.getElementById('file-upload');
    var profilePic = document.getElementById('profile-pic');

    editIcon.addEventListener('click', function () {
        fileInput.click();
    });

    fileInput.addEventListener('change', function () {
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                profilePic.src = e.target.result;
                updateProfilePicture(e.target.result);
            }

            reader.readAsDataURL(fileInput.files[0]);
        }
    });

    function updateProfilePicture(imageData) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo URLROOT; ?>/patient/updateProfilePicture', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log('Profile picture updated successfully');
            } else {
                console.error('Error updating profile picture:', xhr.statusText);
            }
        };
        xhr.onerror = function () {
            console.error('Request failed');
        };
        var formData = new FormData();
        formData.append('image', fileInput.files[0]);
        xhr.send(formData);
    }
});

</script>
</body>
</html>