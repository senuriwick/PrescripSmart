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
    <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\general\profile_dashboard_2.css" />
</head>

<body>

    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
                <div class="patientInfo">
                <?php $user = $data['user'] ?>

                    <div class="profile-pic-container">
                        <?php if ($user->profile_photo): ?>
                            <img src="<?php echo URLROOT ?>\public\uploads\profile_images\<?php echo $user->profile_photo ?>"
                                alt="profile-pic" id="profile-pic">
                        <?php else: ?>
                            <img src="<?php echo URLROOT; ?>\public\img\general\profile.png" alt="default-profile-pic"
                                id="profile-pic">
                        <?php endif; ?>
                        <img src="<?php echo URLROOT ?>\public\img\patient\editicon.png" alt="edit-icon"
                            class="edit-icon" id="edit-icon">
                        <label for="file-upload" class="edit-icon" id="edit-icon"></label>
                        <input type="file" id="file-upload" style="display: none;" name="image">

                    </div>

                    <div class="patientNameDiv">
                        <p class="name">
                            <?php echo ucwords($_SESSION['USER_DATA']->first_Name) ?>
                            <?php echo ucwords($_SESSION['USER_DATA']->last_Name) ?>
                        </p>
                        <p class="role">
                            <?php echo ucwords($_SESSION['USER_DATA']->role) ?>
                        </p>
                    </div>

                </div>
                <?php include 'in_page_navigation_account.php'; ?>

                <?php $admin = $data['admin'] ?>
                <?php $user = $data['user'] ?>


                <div class="inquiriesDiv">
                    <form action="<?php echo URLROOT; ?>/admin/personalInfoUpdate" method="POST">
                        <h1>Employee ID: #
                            <?php echo $_SESSION['USER_DATA']->user_ID ?>
                        </h1>
                        <p class="sub1" style="font-weight: bold;">Personal Information</p>
                        <div class="accInfo">
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname" class="input"
                                        style="display: inline-block;" value="<?php echo $admin->first_Name; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" class="input" name="lname"
                                        style="display: inline-block;" value="<?php echo $admin->last_Name; ?>">
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="displayname">Display Name</label>
                                <input type="text" id="dname" name="dname" class="input"
                                    value="<?php echo $admin->display_Name; ?>">
                                <p class="text">*The name displayed on your dashboard</p>
                            </div>
                            <div class="input-group">
                                <label for="address">Home Address</label>
                                <input type="text" id="haddress" name="haddress" class="input2"
                                    value="<?php echo $user->home_Address; ?>">
                            </div>
                            <div class="parallel">
                                <div class="input-group">
                                    <label for="nic">National Identity Card No.</label>
                                    <input type="number" id="nic" name="nic" class="input"
                                        style="display: inline-block;" value="<?php echo $admin->NIC; ?>">
                                </div>
                                <div class="input-group">
                                    <label for="contactno">Contact Number</label>
                                    <input type="number" id="cno" name="cno" class="input"
                                        style="display: inline-block;" value="<?php echo $admin->contact_Number; ?>">
                                </div>
                            </div>
                            
                        </div>

                        <button type="submit" id="submit" name = "submit" class = "save">SAVE CHANGES</button>
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
                    submitBtn.style.backgroundColor = "#0069FF";
                    submitBtn.style.borderColor = "#0069FF";
                });
            });
        });
    </script>
    <script>
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
        xhr.open('POST', '<?php echo URLROOT; ?>/admin/updateProfilePicture', true);
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