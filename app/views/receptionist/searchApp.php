<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Search an appointment</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/RepSearchApp.css"/>
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/navbar&sidemenu.css"/>
  <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script>

  

</head>
<body>

<?php require APPROOT .'/views/includes/navbar&sidemenu2.php'; ?>





        <div class="searchDiv">
          <h1>Search Appointment</h1>

          <div class="searchFiles">
            <form>
            <input type="search" placeholder="Enter appointment reference number here">
            <button type="search"><b>SEARCH</b></button>
            </form>
          </div>

          <div class="appointment">
            <div class="app-id">
            <h2>Appointment(#5723)</h2>
            <button>Cancel Appointment</button>
            </div>
            
            <div class="app-details">
            <h3>Time: 11:30pm</h3>
            <h3>Date: Wed, 10th August, 2022</h3>
            <h3>Token No: 15</h3>
            </div>

            <div class="app-info">
            <h4>Patient:   Mr. Perera </h4>
            <h4>Doctor:   Dr. Peiris </h4>
            <h4>Payment Status:  <button>MARK AS PAID</button></h4>
            </div>

            
              

          </div>

        </div>

        <h2 style="color: #445172; margin-left: 3vh; font-size: 2.2vh; margin-top:2vh;">Add new</h2>


        <div class="addapp">
          <div class="newapp">
            <img src="<?php echo URLROOT ?>/img/receptionist/Calendar3.png"">
            <a>Schedule an appointment</a>
          </div>
          <p>The modern way schedule and meet with convenience</p>
        </div>


        


      </div>


      


    </div>

  </div>


</body>

