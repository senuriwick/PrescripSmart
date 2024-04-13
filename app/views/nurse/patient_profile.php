<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Patients</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="<?php echo URLROOT ?>\public\css\nurse\patients_dashboard_3.css" />
</head>

<body>

  <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

    <div class="main">
      <?php include 'top_navigation_panel.php'; ?>

      <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>

        <div class="patientFileBack">
          <?php $patient = $data['patient']; ?>
          <div class="patientFileExt">
            <img src="<?php echo URLROOT; ?>\public\img\patient\back_arrow_icon.png" alt="back-icon" class="back-icon"
              id="back-icon">
            <img src="<?php echo URLROOT; ?>\public\uploads\profile_images\<?php echo $patient->profile_photo ?>"
              alt="patient-pic" class="patient-pic">

            <div class="fileInfo">
              <?php if ($patient->gender == "male"): ?>
                <p>Mr.
                  <?php echo $patient->display_Name; ?>
                </p>
              <?php else: ?>
                <p>Ms.
                  <?php echo $patient->display_Name; ?>
                </p>
              <?php endif; ?>
              <p class="patientIdClass">Patient ID #
                <?php echo $patient->patient_ID; ?>
              </p>
            </div>
          </div>

          <div class="patientFileExtDetails">
            <div class="detailDiv">
              <p class="detailHeading">Age</p>
              <div>
                <p>
                  <?php echo $patient->age; ?> years old
                </p>
              </div>
            </div>

            <div class="weightAndHeight">
              <div class="detailDiv">
                <p class="detailHeading">Height</p>
                <div>
                  <p>
                    <?php echo $patient->height; ?> cm
                  </p>
                </div>
              </div>

              <div class="detailDiv">
                <p class="detailHeading">Weight</p>
                <div>
                  <p>
                    <?php echo $patient->weight; ?> kg
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    document.getElementById('back-icon').addEventListener("click", function () {
      window.history.back();
    });
  </script>

</body>