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

      <?php foreach ($data['sessions'] as $sessions) : ?>
        <div class="sessions">
          <div class="session-cards-container">
            <?php foreach ($data['sessions'] as $session) : ?>
              <?php if ($sessions->nurse_ID == $data['nurse_id']) : ?>
                <div class="session-card">
                  <h4><strong>Session #<?php echo $sessions->session_ID ?></strong></h4>
                  <hr style="margin-top: -2vh; width: 25vh; color:#445172BF;">
                  <p>Date: <?php echo $sessions->sessionDate ?></p>
                  <p>Time: <?php echo $sessions->start_time . '-' . $session->end_time ?></p>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>