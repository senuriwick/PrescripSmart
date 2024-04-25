<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Pharmacist One Med Details</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/pharmacist/pharmacist_oneMedDetails.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
<<<<<<< Updated upstream
    <div class="content">
        <div class="sideMenu">
        <div class="logoDiv">
            <div>P</div>
            <h5>PrescripSmart</h5>
        </div>

            <div class="manageDiv">
                <p class="mainOptions">Pharmacist Tools</p>

                <a href="<?php echo URLROOT; ?>/Pharmacist/dashboard">Patients</a>
                <a href="">Medications</a>
                <a href="<?php echo URLROOT ?>/Pharmacist/profile">Profile</a>
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
                    <img src="<?php echo URLROOT?>/app/views/pharmacist/images/user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="<?php echo URLROOT?>/app/views/pharmacist/images/profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Pharmacist Name</p>
                            <p class="role">Pharmacist</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p><a href="<?php echo URLROOT; ?>/Pharmacist/dashboard">Patients</a></p>
                        <p><a href="reports.html" style="color: black; font-weight: 500;">Medications</a></p>
                    </div>
=======
<div class="content">
    <?php include 'side_navigation_panel.php'; ?>

    <div class="main">
      <?php include 'top_navigation_panel.php'; ?>

      <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>
>>>>>>> Stashed changes
                    
                    <div class="patientSearch">
                        <div class="patient-div">
                            <a href="<?php echo URLROOT; ?>/Pharmacist/medications">
                                <img
                                  class="vector"
                                  src="<?php echo URLROOT?>/app/views/pharmacist/images/vector.png"
                                  alt="Sample Image"
                                />
                            </a>
                            <p class="med"><?php echo isset($_GET['name']) ? $_GET['name']:''; ?></p>
                            <p class="status">Status: <span class="stock" style="color: 
                            <?php 
                                $status = isset($_GET['status']) ? $_GET['status'] : '';
                                switch($status) {
                                    case 'Out of Stock':
                                        echo 'red'; // Change color for 'Out of Stock' status
                                        break;
                                    case 'In Stock':
                                        echo 'green'; // Change color for 'Active' status
                                        break;
                                    default:
                                        echo 'black'; // Default color
                                }
                            ?>
                        "><?php echo $status; ?></span>
                            </p>

                        </div>  
                        <div>
                    
                            <p>Reference No: <span><?php echo isset($_GET['id']) ? $_GET['id']: ''; ?></span></p>
                   
                            <p>Batch No: <span><?php echo isset($_GET['batch_number']) ? $_GET['batch_number']:''; ?></span></p>
               
                            <p>Expiry Date: <span><?php echo isset($_GET['expiry_date']) ? $_GET['expiry_date'] : '12/05/2024'; ?></span></p>
                        </div>
                        <div class="quantity">
                            <p>Qty in Stock : </p>
                            <!-- <button class="quantity-btn" data-action="decrease"><img src="<?php echo URLROOT?>/app/views/pharmacist/images/minus.png" alt=""></button> -->
                            <input type="text" id="searchBar" name="search" value="<?php echo isset($_GET['quantity']) ? $_GET['quantity']:''; ?>" onblur="updateQuantity(this.value)">
                            <!-- <button class="quantity-btn" data-action="increase"><img src="<?php echo URLROOT?>/app/views/pharmacist/images/plus.png" alt=""></button> -->
                        </div>
                        <?php if(isset($_GET['status']) && $_GET['status'] === 'In Stock'): ?>
                            <!-- Button is shown when status is 'In Stock' -->
                            <button id="outOfStock">
                                <a href="<?php echo URLROOT; ?>/Pharmacist/markOutOfStock?id=<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">Set Out of Stock</a>
                            </button>
                        <?php endif; ?>


                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('searchBar');
        const decreaseBtn = document.querySelector('.quantity-btn[data-action="decrease"]');
        const increaseBtn = document.querySelector('.quantity-btn[data-action="increase"]');

        decreaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value) || 0;
            if (currentValue > 0) {
                quantityInput.value = currentValue - 1;
            }
        });

        increaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value) || 0;
            quantityInput.value = currentValue + 1;
        });
    });

    function updateQuantity(quantity) {
    var medicationId = <?php echo isset($_GET['id']) ? $_GET['id'] : 'null'; ?>;
    if (medicationId) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?php echo URLROOT; ?>/Pharmacist/updateMedicationQuantity', true); // Update URL to point to the correct controller method
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Quantity updated successfully');
            } else {
                console.error('Error updating quantity');
            }
        };
        xhr.send('medication_id=' + medicationId + '&quantity=' + quantity); // Update parameters to match controller method
    }
}

    </script>
    <script>
    // JavaScript to prevent the link from being followed when disabled
    document.getElementById("outOfStock").addEventListener("click", function(event) {
        if (this.disabled) {
            event.preventDefault();
        }
    });

    // Disable the link when the button is disabled
    document.getElementById("outOfStock").addEventListener("change", function() {
        var link = document.getElementById("outOfStockLink");
        link.disabled = this.disabled;
        if (this.disabled) {
            link.style.pointerEvents = "none";
            link.style.color = "grey"; // Optional: Change link color when disabled
        } else {
            link.style.pointerEvents = "auto";
            link.style.color = ""; // Optional: Reset link color
        }
    });
</script>
    <script type="text/javascript" src="<?php echo URL_ROOT; ?>public/javascripts/testerjs/oneMedDetails.js"></script>
</body>