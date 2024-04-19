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
                      <img src="<?php echo URLROOT ?>/img/receptionist/Vector.svg" >            
                      <h1>Add New Appointment</h1>
                </div>

                <div class="sessions">
                      <h4><strong>Session #<?php echo $data['selectedSession']->session_id ?></strong></h4>
                      <hr style="margin-top: -2vh; width: 25vh;">
                      <p>Date: Sunday, 17th Sept, 2023</p>
                      <p>Time: <?php echo $data['selectedSession']->start_time .'-'. $data['selectedSession']->end_time ?> </p>
                      <p>Dr. <?php echo $data['selectedDoctor']->first_name ;?> <?php echo $data['selectedDoctor']->last_name ;?></p>
                      <p>Token No - 12</p>
                      <p>Channeling Fee: <?php echo $data['selectedDoctor']->visit_price ;?></p>   
                </div>
                <hr style="margin-bottom: 2vh; color:#445172BF;">

                <div class="searchFiles">
                      <form>
                      <input type="search" id="searchinput" style="border-radius: 1vh;" placeholder="Enter patient name or ID here">
                      <button type="search"><b>SEARCH</b></button>
                      </form>
                </div>

        <table>
            <tbody>
                 <?php foreach($data['patients'] as $post): ?>
                    <tr class="row">                                                                           
                            <td>
                                 <img class="person-circle" src= "<?php echo URLROOT ?>/img/receptionist/PersonCircle.png"  alt="profile-pic">
                                <p class= "name">
                                     Mr.
                                     <?php echo $post->last_name;?>
                                </p>
                            </td>

                            <td>
                                <a href="<?php echo URLROOT ?>/receptionist/showProfilePatient/<?php echo $post->patient_id ?>" style="margin-left: 10vh;" >Patient ID #<?php echo $post->patient_id;?></a>
                            </td>

                            <td>
                                <button type="submit" class="add-app" onclick="selectPatient(<?php echo $post->patient_id; ?>)">
                                <strong>ADD APPOINTMENT</strong>
                                </button>                           
                            </td>                                               
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                
      </div>
  </body>
  <script>
    function selectPatient(patient_id) 
        {
        var confirmationURL = "<?php echo URLROOT; ?>/receptionist/confirm_patient";
        confirmationURL += "?patientID=" + encodeURIComponent(patient_id);

        window.location.href = confirmationURL;
         }
  </script>
