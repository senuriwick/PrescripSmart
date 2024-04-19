<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Receptionist Add appointmnet</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/RepAddApp.css"/>
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/navbar&sidemenu.css"/>
  <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script>

</head>
<body>

  <?php require APPROOT .'/views/includes/navbar&sidemenu2.php'; ?>

        <div class="searchDiv">
              <h1>Add New Appointment</h1>
              <div class="searchFiles">
                    <input type="search" id="searchinput" placeholder="Enter doctor name or ID here">
                    <button type="search"><b>SEARCH</b></button>
                    <hr style="margin-bottom: 3vh; margin-top:-0.5vh">        
             </div>

             <div class="details">
    <table>
        <tbody>
            <?php foreach($data['doctors'] as $post): ?>
                <tr>
                    <td>                       
                        <?php foreach ($data['sessions'] as $session): ?>
                            <?php if ($session->doctor_id == $post->doctor_id): ?>
                                   <div class="app-doc">
                                          <img src="<?php echo URLROOT ?>/img/receptionist/PersonCircle.png" alt="profile-pic">
                                          <h3><?php echo ucwords($post->last_name); ?></h3>
                                   </div>
                                <h4 class="doc-pos"><?php // echo ucwords($session->position); ?></h4>
                                <div class="sessions">
                                    <h4><strong>Session #<?php echo $session->session_id; ?></strong></h4>
                                    <hr style="margin-top: -2vh; width: 25vh; color:#445172BF;">
                                    <p>Date: <?php //echo $session->date; ?></p>
                                    <p>Time: <?php // echo $session->time; ?></p>
                                    <button><strong>BOOK NOW</strong></button>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

                      
              

            



        </div>
</body>