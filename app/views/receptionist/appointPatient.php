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
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/RepAssignPatient.css"/>
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/navbar&sidemenu.css"/>
  <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script>


</head>
<body>

<?php require APPROOT .'/views/includes/navbar&sidemenu2.php'; ?>


        <div class="searchDiv">
          <div class="back">
          
              <img src="<?php echo URLROOT ?>/img/admin/Vector.svg" >
            
            <h1>Add New Appointment</h1>
          </div>

          <div class="sessions">

            <h4><strong>Session #23233</strong></h4>
            <hr style="margin-top: -2vh; width: 25vh;">

            <p>Date: Sunday, 17th Sept, 2023</p>
            <p>Time: 06.00 A.M </p>
            <p>Dr. Asanka Sayakkara</p>
            <p>Token No - 12</p>
            <p>Channeling Fee: Rs.4000</p>
    
          </div>

          <hr style="margin-bottom: 2vh; color:#445172BF;">



           <div class="searchFiles">
            <input type="search" style="border-radius: 1vh;" placeholder="Enter patient name or ID here">
            <button type="search"><b>SEARCH</b></button>
           </div>

           <tr class="row">
                                                                           
                                <div class="column">

                                    <td >
                                    <img class="person-circle" src= "<?php echo URLROOT ?>/img/admin/PersonCircle.png"  alt="profile-pic">
                                    <p class="name">
                                    Ms. Shenaya Perera
                                    </p> 
                                    </td>

                                    <td>
                                    <p style="margin-left: 10vh;">Age - 22</p>
                                    </td>

                                    <td>
                                    <p>
                                        Patient ID #32562
                                    </p>

                                  
                                    </td>
                                               
                                  </div>
                                        
                                </tr>

                                <button type="submit" class="add-app"><b><strong>ADD APPOINTMENT</strong></b></button>


        </div>


        


      </div>


      


    </div>

  </div>


</body>
