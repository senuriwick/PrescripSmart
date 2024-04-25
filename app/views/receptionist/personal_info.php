<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Emloyee Personal Information</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/EmpInfo.css"/>
  <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script></head>

<body>

<?php require APPROOT .'/views/includes/navbar&sidemenu3.php'; ?>

        <div class="bar1">

            <div class="div specifier" style="padding-top: 4vh;">
                <h3 style="margin-left:89vh ; color: #445172;">Personal Infomation</h3>  
                <hr color="#445172BF"  width="90%">
            </div>

            <div class="row1">
                    
                <div class="firstname">
                    <h2>First Name</h2>
                    <input type="text" placeholder="Enter Your First Name">
                </div>
                <div class="lastname">
                    <h2>Last Name</h2>
                    <input type="text" placeholder="Enter Your Last Name">
                </div> 
            </div>

            <div class="row2">
                <div class="firstname">
                    <h2>Display Name</h2>
                    <input type="text" placeholder="Enter Display Name">
                </div>    
            </div>

            <div class="row2">
                <div class="firstname">
                    <h2>Home Address</h2>
                    <input type="text" placeholder="Enter Your Home Address">
                </div>    
            </div>
            <div class="row1">
                    
                <div class="firstname">
                   <h2>National Identity Card No</h2>
                   <input type="text" placeholder="Enter NIC Number">
                </div>
                 <div class="lastname">
                   <h2>Contact Number</h2>
                   <input type="text" placeholder="Enter Your Contact number">
                 </div> 
           </div>

           <div class="savebut">
                <button><b>SAVE CHANGES</b></button>
          </div>

        </div>

           