<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Receptionist Assign Patient</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/confirmApp.css"/>
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/navbar&sidemenu.css"/>

</head>
<body>
<?php require APPROOT .'/views/includes/navbar&sidemenu2.php'; ?>

<div class="app-div">
  <div class="header">
    <img src="<?php echo URLROOT ?>/img/admin/Vector.svg">           
    <h2>Add New Appointment</h2>
  </div>

  <h4>Appointment #24232</h4>

  <hr style="width: 100vh;">

  <div class="app-details">
  
  <div class="details">
  <p class="first"><b>Date</b>: </p>
  <p>Sunday, 17th Sept, 2023
  </div>

  <div class="details">
  <p class="first"><b>Time</b>:</p>
  <p>06.00 A.M</p>
  </div>

  <div class="details">
  <p class="first"><b>Doctor</b>: </p>
  <p>Dr. Asanka Rathnayake</p>
  </div>

  <div class="details">
  <p class="first"><b>Patient</b>:  </p>
  <p>Ms. Senuri Perera</p>
  </div>

  <div class="details">
  <p class="first"><b>Age</b>:  </p>
  <p>22 years</p>
  </div>

  <div class="details">
  <p class="first"><b>Token No</b>: </p>
  <p>12</p>
  </div>

  <div class="details">
  <p class="first"><b>Channelling Fee</b>: </p>
  <p>Rs.4000</p>
  </div>

  </div>

  <button  type="submit">Confirm</button>

</div>








</body>
