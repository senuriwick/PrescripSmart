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
  <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\patient\prescriptions_dashboard.css" />
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
                    <?php echo $prescription->prescription_Date; ?> 10:00 AM
                  </div>
                  <div>Age: 22 Yrs</div>
                  <div>Referred by: Dr.
                    <?php echo $prescription->first_Name; ?>
                    <?php echo $prescription->last_Name; ?>
                  </div>
                </div>
                <div class="pres-box">
                  <label>Diagnosis</label>
                  <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                  </div>
                </div>
                <div class="pres-box">
                  <label>Medication</label>
                  <table>
                    <tbody>
                      <tr>
                        <td>Med name</td>
                        <td>Dosage</td>
                        <td>Remarks</td>
                      </tr>
                      <tr>
                        <td>Med Name</td>
                        <td>Dosage</td>
                        <td>Remarks</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="pres-box">
                  <label>Lab Tests</label>
                  <table>
                    <tbody>
                      <tr>
                        <td>Test name</td>
                        <td>Remarks</td>
                      </tr>
                      <tr>
                        <td>Test Name</td>
                        <td>Remarks</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="notice">(For viewing purpose only)</div>
                <button type="button" id="qr" class="qr-button"
                  onclick="viewQR(<?php echo $prescription->prescription_ID; ?>)">View QR</button>

                <script>
                  function viewQR(prescriptionID) {
                    var qrURL = "<?php echo URLROOT; ?>/patient/qr_download";
                    qrURL += "?prescriptionID=" + encodeURIComponent(prescriptionID);

                    window.location.href = qrURL;
                  }
                </script>

              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <?php include 'add_new_container.php'; ?>

      </div>
    </div>
  </div>
  <!-- <script src="<?php echo URLROOT; ?>/public/js/prescriptions.js"></script> -->
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