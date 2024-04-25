<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Sign Up</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700"/>
  <link rel="stylesheet" href="<?php echo URLROOT?>/public/css/receptionist/signUp-2.css"/>
</head>
<body>
<div class="signUp-page-3">
<?php $user = $data['user'] ?>
  <div class="upperRectangle">
    <p class="sample-user-name-here"><?php echo $user->username?></p>
    <div class="line">
    </div>
  </div>
  <div class="container">
    <div class="detailsForm">
      <div class="sideRectangle">
      </div>
      <div class="container2">

      
        <form action = "<?php echo URLROOT?>/receptionist/emailregistrationContd" method = "POST">
        
        <div class="group2">
          <h1>Few more things...</h1>
          <div class="box1">
            <p class="nic">NIC<span class="required">*</span></p>
            <input type="number" id="nic" name="nic" placeholder="Enter your national identity card number" class="input1" required>
          </div>
        </div>

        <div class="container3">
          <div class="group3">
            <p class="dob">
              <span class="dob-sub-0">date of birth </span>
              <span class="dob-sub-1">*</span>
            </p>
            <input type="date" id="dob" name="dob" placeholder="DD/MM/YYYY" class="DOB" required>
          </div>
          <div class="group4">
            <p class="age">
              <span class="age-sub-0">age </span>
              <span class="age-sub-1">*</span>
            </p>
            <input type="number" id="age" name="age" placeholder="Enter your age" class="agehere" required>
          </div>
        </div>
        <div class="container4">
          <div class="group5">
            <p class="home-address">home address</p>
            <input type="text" id="address" name="address" placeholder="Enter your home address" class="address">
          </div>
          <div class="group6">
            <p class="contact-number">contact number<span class="required">*</span></p>
            <input type="number" id="phoneNo" name="phoneNo" placeholder="Enter your contact number" class="contactNo" required>
            <input type="number" id="id" name="id" value = <?php echo $user->user_ID?> style="display: none">
          </div>
          <button type="submit" class="group7" id="continue">Continue</button>
        </div>
      </form>
      </div>
    </div>

    <div class="group8">
      <p class="terms-of-service-HBw">
        <a href="<?php echo URLROOT; ?>/general/terms_of_service" class="terms-of-service-HBw-sub-0">Terms of Service</a>
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