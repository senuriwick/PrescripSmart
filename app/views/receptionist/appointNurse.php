<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Assign a Nurse</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/RepAssignNurse.css" />
    <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script>


</head>

<body>

    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>
<div class="patientInfoContainer">
                <?php include 'information_container.php'; ?>
                <?php include 'in_page_navigation.php'; ?>
                  
        <?php
            $dateString = date_create_from_format('Y-m-d', $data['selectedSession']->sessionDate);
            $formatted_date = $dateString->format("Y, jS M, D");
            $start_time = date("h:i A", strtotime($data['selectedSession']->start_time));
            $end_time = date("h:i A", strtotime($data['selectedSession']->end_time));
        ?>

                <div class="sessions">
                      <h4><strong>Session #<?php echo $data['selectedSession']->session_ID ?></strong></h4>
                      <hr style="margin-top: -2vh; width: 25vh;">
                      <!-- <p>Date: <?php echo $formatted_date ?></p> -->
                      <p>Time: <?php echo $start_time .'-'. $end_time ?> </p>
                      <p>Dr. <?php echo $data['selectedDoctor']->first_Name ;?> <?php echo $data['selectedDoctor']->last_Name ;?></p>
                      <p>Token No - 12</p>
                      <p>Channeling Fee: <?php echo $data['selectedSession']->sessionCharge ;?></p>   
                </div>
                <hr style="margin-bottom: 2vh; color:#445172BF;">

                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function selectPatient(patient_id, session_id, doctor_id) {
        var confirmationURL = "<?php echo URLROOT; ?>/receptionist/confirm_patient";
        confirmationURL += "?patientID=" + encodeURIComponent(patient_id);
        confirmationURL += "&sessionID=" + encodeURIComponent(session_id);
        confirmationURL += "&doctorID=" + encodeURIComponent(doctor_id);


        window.location.href = confirmationURL;
    }

        <table>
            <tbody>
                 <?php foreach($data['nurse'] as $post): ?>
                    <tr class="row">                                                                           
                            <td>
                                 <img class="person-circle" src= "<?php echo URLROOT ?>/img/receptionist/PersonCircle.png"  alt="profile-pic">
                                <p class= "name">
                                     Mr.
                                     <?php echo $post->last_Name;?>
                                </p>
                            </td>

                            <td>
                                <a href="<?php echo URLROOT ?>/receptionist/showProfilePatient/<?php echo $post->nurse_ID ?>" style="margin-left: 10vh;" >Patient ID #<?php echo $post->patient_ID;?></a>
                            </td>

                            <td>
                                <button type="submit" class="add-app" onclick="selectPatient(<?php echo $post->nurse_ID ?>,<?php echo $data['selectedSession']->session_ID ?>,<?php echo $data['selectedDoctor']->doctor_ID ?>)">
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
    function selectPatient(patient_ID,session_ID,doctor_ID) {
    var confirmationURL = "<?php echo URLROOT; ?>/receptionist/confirm_patient";
    confirmationURL += "?patientID=" + encodeURIComponent(patient_ID);
    confirmationURL += "&sessionID=" + encodeURIComponent(session_ID);
    confirmationURL += "&doctorID=" + encodeURIComponent(doctor_ID);


    window.location.href = confirmationURL;
}

  </script>
