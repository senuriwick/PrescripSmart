<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Prescriptions</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\pharmacist\pharmacist_prescription.css" />
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
          <h1>Prescriptions</h1>
          <?php foreach ($data['prescriptions'] as $prescription): ?>
            <div class="prescriptionFiles">

              <div class="file">
                <div class="desDiv">
                  <img src="<?php echo URLROOT; ?>\public\img\patient\description.png" alt="description-icon">
                  <p class="description">Prescription #<?php echo $prescription->prescription_ID; ?></p>
                </div>
                <p class = "doctor">Issued by: Dr.
                  <?php echo $prescription->first_Name; ?>
                  <?php echo $prescription->last_Name; ?>
                </p>
                <p class = "date">Issued on:
                  <?php echo $prescription->prescription_Date; ?>
                </p>
                <img src="<?php echo URLROOT; ?>\public\img\patient\Eye.png" alt="eye-icon"
                  data-container-pid="<?= $prescription->prescription_ID ?>">
              </div>

            </div>

            <div id="myModal<?= $prescription->prescription_ID ?>" class="modal" style="display: none;">

              <div class="modal-content">
                <span class="close">&times;</span>
                <a href="www.prescripsmart.com">www.prescripsmart.com</a>
                <div class="model-head">
                  <div>P</div>
                  <h4><u>CONFIDENTIAL PRESCRIPTION</u></h4>
                  <i class="fa-solid fa-circle-arrow-up"></i>
                </div>
                <div class="model-details">
                  <div>Prescription ID: #
                    <?php echo $prescription->prescription_ID; ?>
                  </div>
                  <div>Patient: <?php echo $_SESSION['USER_DATA']->first_Name?> <?php echo $_SESSION['USER_DATA']->last_Name?></div>
                  <div>Pres Date & Time:
                    <?php echo $prescription->prescription_Date; ?>
                  </div>
                  <div>Age: 22 Yrs</div>
                  <div>Referred by: Dr.
                    <?php echo $prescription->first_Name; ?>
                    <?php echo $prescription->last_Name; ?>
                  </div>
                </div>

                <div class="pres-box">
                  <label>Medications</label>
                  <table>
                    <tbody>
                    <th>Name</th>
                    <!-- <th>Dosage</th> -->
                    <th>Remarks</th>
                    <?php foreach ($data['prescriptionDetails'][$prescription->prescription_ID] as $medicine): ?>
                      <tr>
                        <td><?php echo $medicine->medication; ?></td>
                        <!-- <td><?php echo $medicine->dosage; ?></td> -->
                        <td><?php echo $medicine->remark; ?></td>
                      </tr>
                    <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                <div class="notice">(For viewing purpose only)</div>

               

              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </div>
  </div>
</body>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const eyeIcons = document.querySelectorAll('.file img[src*="Eye.png"]');

    eyeIcons.forEach(icon => {
      const prescriptionID = icon.getAttribute('data-container-pid');
      const modal = document.getElementById(`myModal${prescriptionID}`);
      const closeButton = modal.querySelector(".close");

      icon.addEventListener("click", () => {
        modal.style.display = 'block';
      });

      closeButton.addEventListener("click", () => {
        modal.style.display = "none";
      });

      window.addEventListener("click", (event) => {
        if (event.target === modal) {
          modal.style.display = "none";
        }
      });
    });
  });
</script>

</html>