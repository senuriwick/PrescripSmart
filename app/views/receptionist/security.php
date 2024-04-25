<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Employee Security Information</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/Security.css"/>
  <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script>
</head>

<body>

<?php require APPROOT .'/views/includes/navbar&sidemenu3.php'; ?>

        <div class="bar1">
            <div class="div specifier" style="padding-top: 2vh;font-size: 2.3vh;">
                <h3 style="margin-left:89vh ; color: #445172;">Security Infomation</h3>  
                <hr color="#A4AEC7" width="90%">
            </div>

            <div class="row1">                  
                <div class="firstname">
                   <h2>Method of Sign-In</h2>
                   <input type="text" placeholder="Enter Your Email or Contact Number" >
                </div>
                 <div class="lastname">
                   <h2>Email/Phone Number</h2>
                   <input type="text" placeholder="Enter Your Email or Contact Number" >
                 </div> 
            </div>

        <div class="div-specifier" style="padding-top: 3vh;">
            <hr color="#A4AEC7"  width="90%">
            <h2><b>Two-factor Authentication</b></h2>

            <h3 style="padding-left: 4vh;">Add an extra layer of security to your account. To sign in, you'll need to provide a code along with your username and password.</h3>
            <button type="button"><b>SETUP 2FA</b></button>
        </div>
    
    </div>

       
