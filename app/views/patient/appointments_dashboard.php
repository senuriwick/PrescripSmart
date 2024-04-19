<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Appointments</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\patient\appointments_dashboard.css" />
</head>

<body>
  <div class="content">
  <?php include 'side_navigation_panel.php'; ?>

    <div class="main">
    <?php include 'top_navigation_panel.php'; ?>

      <div class="patientInfoContainer">
      <?php include 'information_container.php'; ?>
      <?php include 'in_page_navigation.php'; ?>


        <div class="prescriptionsDiv">
          <h1>Appointments (Active)</h1>

          <?php foreach ($data['appointments'] as $appointment): ?>
            <div class="file">
            <div class="desDiv">
                  <img src="<?php echo URLROOT; ?>\public\img\patient\app_icon.png" alt="description-icon">
                  <p class="description">Appointment #<?php echo $appointment->appointment_ID; ?></p>
              </div>
              <p>Name: Dr.
                <?php echo $appointment->first_Name; ?> <?php echo $appointment->last_Name; ?>
              </p>
              <p class="time">Time:
                  <?php echo $appointment->time; ?>
                </p>
              <p>Date:
                <?php echo $appointment->date; ?>
              </p>
              <a href="view_appointment?appointment_id=<?php echo $appointment->appointment_ID; ?>">
                <img src="<?php echo URLROOT; ?>\public\img\patient\More.png" alt="more-icon">
              </a>
            </div>

          <?php endforeach; ?>
        </div>
        <?php include 'add_new_container.php'; ?>
      </div>
    </div>
  </div>
  </div>

  </div>
</body>

</html>