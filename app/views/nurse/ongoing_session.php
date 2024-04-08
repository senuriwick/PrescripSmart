<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>On-Going</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\nurse\ongoing.css" />
</head>

<body>

  <div class="content">
  <?php include 'side_navigation_panel.php'; ?>

    <div class="main">
    <?php include 'top_navigation_panel.php'; ?>

      <div class="patientInfoContainer">
      <?php include 'information_container.php'; ?>
      <?php include 'in_page_navigation.php'; ?>

        <div class="sessionDetails">
          <?php if (empty($data['session'])): ?>
            <p>You currently have no on-going sessions. Thank you!</p>
          <?php else: ?>
            <?php $session = $data['session'] ?>
            <?php $doctor = $data['doctor'] ?>

            <p id="sessionNo">Session #
              <?php echo $session->session_ID ?>
            </p>
            <p>
              Dr.
              <?php echo $doctor->fName ?>
              <?php echo $doctor->lName ?>
              <br>
              Room 0<?php echo $session->room_no ?>
            </p>
          <?php endif ?>
        </div>


        <div class="ongoingDiv">

          <?php if (empty($data['appointments'])): ?>
            <p>No appointments found.</p>
          <?php else: ?>

            <?php
            $appointments = $data['appointments'];
            $totalAppointments = count($data['appointments']);
            $activeAppointments = 0;

            foreach ($data['appointments'] as $appointment) {
              if ($appointment->status == "active") {
                $activeAppointments++;
              }
            }
            ?>

            <div class="noPatients">
              <div class="patientsLeft">
                <p><span>
                    <?php echo $activeAppointments ?>
                  </span><br>Patients left</p>
              </div>
              <div class="allPatients">
                <p>All patients:
                  <?php echo $totalAppointments ?>
                </p>
              </div>
            </div>

            <?php
            function sortByStatus($a, $b)
            {
              if ($a->status == $b->status) {
                return 0;
              }
              return ($a->status == 'waiting') ? -1 : 1;
            }

            usort($data['appointments'], 'sortByStatus');
            ?>

            <div class="sessionAppointments">
              <?php foreach ($data['appointments'] as $appointment): ?>
                <div class="appointmentDiv">
                  <div class="done <?php echo strtolower($appointment->status); ?>">
                    <p>No
                      <?php echo $appointment->appointment_No ?>.
                      <?php echo $appointment->display_Name ?>
                    </p>
                    <p>Time:
                      <?php echo $appointment->time ?>
                    </p>
                    <div class="status <?php echo strtolower($appointment->status); ?>">
                      <?php if ($appointment->status == "completed"): ?>
                        <p>DONE</p>
                      <?php elseif ($appointment->status == "active"): ?>
                        <p>WAITING</p>

                      <?php else: ?>
                        <p>CANCELLED</p>
                      <?php endif ?>
                    </div>

                  </div>
                </div>
              <?php endforeach ?>
            <?php endif ?>

          </div>

        </div>
      </div>
    </div>