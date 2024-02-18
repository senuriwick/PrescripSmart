<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Receptionist register Nurse</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/RepNurseReg.css"/>
 
</head>
<body>

<?php require APPROOT .'/views/includes/navbar&sidemenu2.php'; ?>


      <div class="details">
        <div class="back" style="display: flex; margin-left: -38vh;">
          <svg>
            <img src="<?php echo URLROOT ?>/img/receptionist/Vector.svg" >
          </svg>
          <h1 >Nurse Registration</h1>
        </div>
        
        <form action="<?php echo URLROOT; ?>/receptionist/regNurse" method="post">
        <div class="top1">
          <div class="firstname">
              <h3>first name</h3>
              <input type="text" placeholder="Enter first name">
          </div>
            <div class="lastname">
              <h3>last name</h3>
              <input type="text" placeholder="Enter last name">
           </div>
          </div>
          
  
          <div class="top2">
              <div class="email">
                  <h3>email address</h3>
                  <input type="text" placeholder="Enter email address">
              </div>
                <div class="phone">
                  <h3>phone number</h3>
                  <input type="text" placeholder="Enter phone number">
               </div>
          </div>
          <div class="top3">
            <h3>Create password</h3>
            
              <input type="text" placeholder="Enter password">

            

          </div>

          <button type="submit"><b>Register</b></button>
          </form>
  

      </div>
      <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script>
    </html>
        