<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Employee Account Information</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/Account.css"/>
  <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script></head>
<body>

<?php require APPROOT .'/views/includes/navbar&sidemenu3.php'; ?>

      <?php $patient = $data['receptionist'] ?>

          <div class="bar1">

            <div class="div specifier" style="padding-top: 3vh;">
                <h3 style="margin-left:89vh ; color: #445172; font-size: 2.5vh;">Account Infomation</h3>  
                <hr color="#445172BF"  width="90%">
            </div>

            <div class="row1">

            <form action="<?php echo URLROOT; ?>/patient/accountInfoUpdate" method="POST">
             
                        <div class="input-group">
                            <label for="name">Username</label>
                            <input type="text" id="username" class="input" name="username"
                            value="<?php echo $patient->username ?>" style="display: inline-block;">
                        </div>
                        <div class="input-group">
                            <label for="email">Associated Email Address/Phone Number</label>
                            <input type="text" id="email" class="input" name="email" readonly
                            value="<?php echo $patient->email_phone ?>" style="display: inline-block;">
                        </div>

        
                            <button type="submit" id="submit">SAVE CHANGES</button>
            </form>


                    
                 <div class="firstname">
                    <h2>Username</h2>
                    <input type="text" placeholder="Enter your Username">
                 </div>
                  <div class="lastname">
                    <h2>Associated Email Address or Phone Number</h2>
                    <input type="text" placeholder="Your Email Address or Contact Number">
                  </div> 
            </div>

            <div class="row2">
                <div class="firstname">
                    <h2>Current Password</h2>
                    <input type="password" placeholder="Enter Current Password" >
                </div>    

            </div>
            <div class="div specifier" >
                <h3 style="margin-left:89vh ; color: #445172; font-size: 2.5vh;">Password Change</h3>  
                <hr color="#445172BF"  width="90%">
            </div>

            <div class="row1">

                <div class="firstname">
                    <h2>New Password</h2>
                    <input type="password" placeholder="Enter New Password" >
                 </div>
                  <div class="lastname">
                    <h2>Confirm Password</h2>
                    <input type="password" placeholder="Re-enter New Password" >
                  </div>
            </div> 
            <div class="savebut">
              <button><b>SAVE CHANGES</b></button>
            </div>
            
          </div>
          <script src="../Receptionist/script.js"></script>


