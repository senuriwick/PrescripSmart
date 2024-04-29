<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Manage an Appointment</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\receptionist\sessionManage.css" />
  
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

      <div class="searchDiv">
        <h1>Doctor Sessions</h1>
        <div class="searchFiles">
          <input class="search-input" type="search" placeholder="Search Doctor name/ID here">
          <button type="search"><b>SEARCH</b></button>
        </div>
      

      <?php foreach ($data['doctors'] as $doctor) : ?>
        <div class="sessions">
          <div class="doc-info">
            <img src="<?php echo URLROOT ?>/img/receptionist/PersonCircle.png" alt="user-icon">
            <h3>Dr. <?php echo $doctor->first_Name . ' ' . $doctor->last_Name ?></h3>
          </div>
          <h5><?php echo $doctor->specialization ?></h5>
          <hr style="color: #D9D9D9; margin-bottom:2vh; width:90%;">

          <div class="session-cards-container">
            <?php foreach ($data['sessions'] as $session) : ?>
              <?php if ($doctor->doctor_ID == $session->doctor_ID) : ?>
                <div class="session-card">
                  <h4><strong>Session #<?php echo $session->session_ID ?></strong></h4>
                  <hr style="margin-top: -2vh; width: 25vh; color:#445172BF;">
                  <p>Date: <?php echo $session->sessionDate ?></p>
                  <p>Time: <?php echo $session->start_time . '-' . $session->end_time ?></p>
                  <button onclick="assignNurse(<?php echo $data['nurse_id'] ?>,<?php echo $session->session_ID ?>)"><strong>Assign</strong> </button>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<script>
    function assignNurse(nurse_id,session_id)
    {
        var confirmationURL = "<?php echo URLROOT; ?>/receptionist/nurse_assigned";
        confirmationURL += "?nurseID=" + encodeURIComponent(nurse_id);
        confirmationURL += "?sessionID=" + encodeURIComponent(session_id);
        window.location.href = confirmationURL;

    }
</script>