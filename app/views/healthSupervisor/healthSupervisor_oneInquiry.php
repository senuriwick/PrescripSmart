<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>HealthSupervisor Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT ;?>/public/css/healthSupervisor/healthSupervisor_oneInquiry.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/pharmacist/sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
<div class="content">
    <?php include 'side_navigation_panel.php'; ?>

    <div class="main">
      <?php include 'top_navigation_panel.php'; ?>

      <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>
                    <div class="patientFile">
                        <div class="patient-div">
                            <a href="<?php echo URLROOT ?>/HealthSupervisor/dashboard">
                                <img
                                class="vector"
                                src="<?php echo URLROOT?>/app/views/pharmacist/images/vector.png"
                                alt="Sample Image"
                                />
                            </a>
                            <?php if (isset($data['inquiry'])) : ?>
                            <?php $inquiry = $data['inquiry'] ?>
                            <h2>Inquiry NO:<?php echo $inquiry->inquiry_ID; ?></h2>
                            <form action="<?php echo URLROOT ?>/healthSupervisor/markAsRead" method="GET">
                                <input type="hidden" name="id" value="<?php echo $inquiry->inquiry_ID; ?>">
                                <button type="submit" class="mark_button">Mark As Read</button>
                            </form>
                        </div>  

                        <div class="row">
                            <div class="details">
                                <p class="label">Email Address</p>
                                <input type="text" id="searchBar" name="name" placeholder="<?php echo $inquiry->email ?>" title="<?php echo $inquiry->email ?>" class="inputfield" readonly>
                            </div>
                            <div class="details">
                                <p class="label">Name</p>
                                <input type="text" id="searchBar" name="name" placeholder="<?php echo $inquiry -> name ?>" class="inputfield" readonly>
                            </div>
                        </div>
                        <div>
                            <p class="label">Message</p>
                            <textarea name="name" placeholder="<?php echo $inquiry -> message ?>" class="inputfield" readonly></textarea>
                        </div>

                        <?php else : ?>
                         <p>No inquiry details found.</p>
                        <?php endif; ?>
                        
                        <button class="reply" onclick="openPopup()">Reply</button>
                       
                    </div>

                    <div id="popup" class="popup">
                        <div class="popup-content">
                            <!-- Close button for the popup -->
                            <span class="close" onclick="closePopup()">&times;</span>
                            <!-- Email form -->
                            <form action="<?php echo URLROOT ?>/healthSupervisor/sendEmail" method="post">
                            <input type="hidden" name="inquiry_id" value="<?php echo $inquiry->inquiry_ID; ?>">
                            <input type="hidden" name="inquiry_email" value="<?php echo $inquiry->email; ?>">
                            <label for="message">Message:</label><br>
                            <textarea id="message" name="message_content" rows="4" cols="50" required></textarea>
                            <br><br>
                            <input class="mark" type="submit" value="Send Email">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo URLROOT; ?>/public/js/healthSupervisor/oneInquiry.js"></script>
</body>