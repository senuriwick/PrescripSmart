<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Reports</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
  <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\patient\reports_dashboard.css" />
</head>

<body>

  <div class="content">
   <?php include 'side_navigation_panel.php'; ?>

    <div class="main">
    <?php include 'top_navigation_panel.php'; ?>

      <div class="patientInfoContainer">
      <?php include 'information_container.php'; ?>
      <?php include 'in_page_navigation.php'; ?>

        <div class="reportsDiv">
          <h1>Reports</h1>
          <?php foreach ($data['reports'] as $report): ?>
            <div class="reportFiles">

              <div class="file">
                <div class="desDiv">
                  <img src="<?php echo URLROOT; ?>\public\img\patient\description.png" alt="description-icon">
                  <p class="description">Report #<?php echo $report->report_ID; ?>
                  </p>
                </div>
                <div class = "doctor">
                <p>Referred by Dr.
                  <?php echo $report->first_Name; ?>
                  <?php echo $report->last_Name; ?>
                </p></div>
                <div class = "date">
                <p>Issued on: <?php echo date('Y-m-d', strtotime($report->date_of_report)); ?></p>
                </p></div>

                <div class = "imgclass">
                <?php if ($report->downloads <= 5 && $report->date_of_report !== NULL): ?>
                  <a href="<?php echo URLROOT; ?>/public/uploads/reports/<?php echo $report->report; ?>"
                    class="download-link" data-report-id="<?= $report->report_ID ?>">
                    <img src="<?php echo URLROOT; ?>/public/img/patient/download.png" alt="download-icon">
                  </a>
                <?php endif; ?>
                <img src="<?php echo URLROOT; ?>\public\img\patient\Eye.png" alt="eye-icon"
                  data-container-pid="<?= $report->report_ID ?>">
                </div>

              </div>
            </div>

            <div id="myModal<?= $report->report_ID ?>" class="modal">
              <div class="modal-content">
                <span class="close">&times;</span>
                <a href="www.prescripsmart.com">www.prescripsmart.com</a>
                <div class="model-head">
                <div>P</div>
                  <h4><u>CONFIDENTIAL LAB REPORT</u></h4>
                  <i class="fa-solid fa-circle-arrow-up"></i>
                </div>
                <div class="model-details">
                  <div>Report ID: #<?php echo $report->report_ID; ?>
                  </div>
                  <div>Patient: <?php echo $_SESSION['USER_DATA']->first_Name?> <?php echo $_SESSION['USER_DATA']->last_Name?></div>
                  <div>Report Date & Time:
                    <?php echo $report->prescription_Date; ?>
                  </div>
                  <div>Age: <?php echo $report->age?> Yrs</div>
                  <div>Referred by: Dr.
                    <?php echo $report->first_Name; ?>
                    <?php echo $report->last_Name; ?>
                  </div>
                </div>
                <div class="test-box">
                  <table>
                    <tbody>
                      <th>TEST</th>
                      <th>FLAG REFERENCE VALUE</th>
                      <th>RESULT</th>
                      
                      <tr>
                        <td><?php echo $report->name?></td>
                        <td><?php echo $report->reference_range?></td>
                        <td class = "status <?php echo $report->status?>"><?php echo $report->status?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="pres-box">
                  <label>Other Comments...</label>
                  <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                  </div>
                </div>
                
                <div class="notice">(For viewing purpose only)</div>
                <?php if ($report->status == "Ready"): ?>
                <button type="button" id="report" class="report-button">View Report</button>

                <script>
                  
                </script>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <?php include 'add_new_container.php'; ?>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const downloadLinks = document.querySelectorAll('.download-link');

      downloadLinks.forEach(link => {
        link.addEventListener("click", (event) => {
          event.preventDefault();
          const reportId = link.getAttribute('data-report-id');
          updateDownloadCount(reportId);
          window.location.href = link.getAttribute('href');
        });
      });

      const eyeIcons = document.querySelectorAll('.file img[src*="Eye.png"]');

      eyeIcons.forEach(icon => {
        const reportID = icon.getAttribute('data-container-pid');
        const modal = document.getElementById(`myModal${reportID}`);
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

      const reportButtons = document.querySelectorAll('.report-button');

    reportButtons.forEach(button => {
      button.addEventListener("click", () => {
        const reportId = button.parentNode.parentNode.id.replace('myModal', '');
        window.open(`<?php echo URLROOT; ?>/public/uploads/reports/${reportId}.pdf`);
      });
    });

      // const modal = document.getElementById("myModal");
      // const closeButton = modal.querySelector(".close");

      function updateDownloadCount(reportId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo URLROOT; ?>/patient/updateDownloadCount/" + reportId, true);
        xhr.send();

        xhr.onload = function () {
          if (xhr.status == 200) {
            console.log("Download count updated successfully");
          } else {
            console.error("Failed to update download count");
          }
        };
      }
    });
  </script>

</body>

</html>