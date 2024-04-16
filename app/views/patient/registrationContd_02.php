<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Sign Up page 3</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
  <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/patient/signUp-3.css" />
</head>

<body>
  <?php $user = $data['user'] ?>
  <div class="signUp-page-3">
    <div class="upperRectangle">
      <p class="sample-user-name-here"><?php echo $user->username ?> </p>
      <div class="line">
      </div>
    </div>
    <div class="container">
      <div class="detailsForm">
        <div class="sideRectangle">
        </div>
        <div class="container2">
          <form action="<?php echo URLROOT ?>/patient/emailregistrationContd_02" method="POST">
            <div class="group2">
              <h1>One last bit...</h1>
              <div class="box1">
                <p class="gender">Gender</p>
                <div class="gender-options">
                  <label for="male">
                    <input type="radio" id="male" name="gender" value="male" required>
                    Male
                  </label>
                  <label for="female">
                    <input type="radio" id="female" name="gender" value="female" required>
                    Female
                  </label>
                  <label for="other">
                    <input type="radio" id="other" name="gender" value="other" required>
                    Other
                  </label>
                </div>
              </div>

            </div>
            <div class="container3">
              <div class="group3">
                <p class="weight">
                  <span class="weight-sub-0">weight </span>
                  <!-- <span class="weight-sub-1">*</span> -->
                </p>
                <input type="number" id="weight" name="weight" placeholder="e.g: 45 kg" class="weight1">
              </div>
              <div class="group4">
                <p class="height">
                  <span class="height-sub-0">height </span>
                  <!-- <span class="height-sub-1">*</span> -->
                </p>
                <input type="number" id="height" name="height" placeholder="e.g: 155cm" class="height1">
              </div>
            </div>
            <div class="container4">
              <div class="group5">
                <p class="emergency">emergency</p>
                <input type="text" id="emergency" name="emergency"
                  placeholder="Enter the name of the emergency contact person" class="emergency1" required>
              </div>
              <div class="group6">
                <p class="emergency-contact-number">emergency contact number</p>
                <input type="number" id="phoneNo" name="phoneNo" placeholder="Enter your emergency contact number"
                  class="contactNo1" required>
              </div>
              <input type="number" id="id" name="id" value=<?php echo $user->user_ID ?> style="display: none">
              <button type="submit" class="group7" id="submit">Submit</button>

            </div>
        </div>
      </div>
      <div class="group8">
        <p class="terms-of-service-HBw">
          <a href="<?php echo URLROOT; ?>/general/terms_of_service" class="terms-of-service-HBw-sub-0">Terms of
            Service</a>
          <span class="terms-of-service-HBw-sub-1"> </span>
        </p>
        <p class="privacy-policy-wZK">
          <span class="privacy-policy-wZK-sub-0"> </span>
          <a href="<?php echo URLROOT; ?>/general/privacy_policy" class="privacy-policy-wZK-sub-1">Privacy Policy</a>
        </p>
      </div>
    </div>
  </div>
</body>