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
  <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\pharmacist\pharmacist_prescriptionStatus.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
  <div class="content">
    <?php include 'side_navigation_panel.php'; ?>

    <div class="main">
      <?php include 'top_navigation_panel.php'; ?>

      <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>
        <div class="inquiriesDiv">
            <?php
            $prescriptions = $data["prescriptions"];
            $totalPages = $data["totalPages"];
            $currentPage = $data["currentPage"];
            ?>

          
              <h2 class="searchHeader">Search Prescriptions</h2>
              <input type="text" id="search" name="search" placeholder="Enter prescription ID" class="inputfield">
              <button id="searchButton">SEARCH</button>

              <hr class="divider"> 

            <div class="prescriptionsDiv">
              
              <div class="searchDiv">
                <?php foreach ($prescriptions as $prescription): ?>
                  <div class="prescriptionFiles">
                    <div class="file">
                      <div class="desDiv">
                        <img src="<?php echo URLROOT; ?>\public\img\patient\description.png" alt="description-icon">
                        <p class="description">Prescription #<?php echo $prescription->prescription_ID; ?></p>
                      </div>
                      <p class="doctor">Issued by: Dr. <?php echo $prescription->first_Name; ?> <?php echo $prescription->last_Name; ?></p>
                      <p class="date">Issued on: <?php echo $prescription->prescription_Date; ?></p>
                      <img src="<?php echo URLROOT; ?>\public\img\patient\Eye.png" alt="eye-icon" data-container-pid="<?= $prescription->prescription_ID ?>">
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
                        <div>Prescription ID: #<?php echo $prescription->prescription_ID; ?></div>
                        <div>Patient: <?php echo $_SESSION['USER_DATA']->first_Name ?> <?php echo $_SESSION['USER_DATA']->last_Name ?></div>
                        <div>Pres Date & Time: <?php echo $prescription->prescription_Date; ?></div>
                        <div>Age: 22 Yrs</div>
                        <div>Referred by: Dr. <?php echo $prescription->first_Name; ?> <?php echo $prescription->last_Name; ?></div>
                      </div>
                      <div class="pres-box">
                        <label>Medications</label>
                        <table>
                          <tbody>
                            <th>Name</th>
                            <!-- <th>Dosage</th> -->
                            <th>Remarks</th>
                            <th>Status</th>
                            <?php foreach ($data['prescriptionDetails'][$prescription->prescription_ID] as $medicine): ?>
                              <tr>
                                <td><?php echo $medicine->medication; ?></td>
                                <!-- <td><?php echo $medicine->dosage; ?></td> -->
                                <td><?php echo $medicine->remark; ?></td>
                                <td>
                                  <input type="checkbox" data-container-pid="<?= $prescription->prescription_ID ?>" value="<?= $medicine->id; ?>" <?php if ($medicine->status === 'issued') echo 'checked'; ?>>
                                </td>
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
            <div class="pagination">
              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="<?php echo URLROOT ?>/pharmacist/prescriptionStatus/<?php echo $i ?>" <?php if ($currentPage == $i) echo 'class="active"'; ?>><?php echo $i ?></a>
              <?php endfor; ?>
            </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Function to attach event listeners for eye icons
      function attachEyeIconListeners() {
        const eyeIcons = document.querySelectorAll('.file img[src*="Eye.png"]');
        eyeIcons.forEach(icon => {
          const prescriptionID = icon.getAttribute('data-container-pid');
          console.log('Prescription ID:', prescriptionID); // Debug: Log prescription ID

          // Check if modal element exists
          const modal = document.getElementById(`myModal${prescriptionID}`);
          if (!modal) {
            console.error('Modal not found for Prescription ID:', prescriptionID);
            return; // Skip attaching event listeners if modal is not found
          }

          const closeButton = modal.querySelector(".close");

          // Show modal when eye icon is clicked
          icon.addEventListener("click", () => {
            modal.style.display = 'block';
          });

          // Close modal when close button is clicked
          closeButton.addEventListener("click", () => {
            modal.style.display = "none";
          });

          // Close modal when clicking outside the modal
          window.addEventListener("click", (event) => {
            if (event.target === modal) {
              modal.style.display = "none";
            }
          });
        });
      }

      // Attach event listeners for eye icons initially
     

      // Event listener for search bar input
      document.getElementById("search").addEventListener("input", function() {
        var searchQuery = this.value.trim();
        if (searchQuery !== "") {
          $('.pagination').hide();
          var xhr = new XMLHttpRequest();
          xhr.open("GET", "<?php echo URLROOT ?>/Pharmacist/filterPrescriptions?search=" + encodeURIComponent(searchQuery), true);
          xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
              var filteredPrescriptions = JSON.parse(xhr.responseText);
              updatePatientList(filteredPrescriptions);
              attachEyeIconListeners();
            }
          };
          xhr.send();
        } else {
          location.reload();
        }
      });
      attachEyeIconListeners();
    });

    function updatePatientList(filteredPrescriptions) {
      var prescriptionsContainer = document.querySelector(".searchDiv");
      prescriptionsContainer.innerHTML = "";

      filteredPrescriptions.forEach(function(prescription) {
        var prescriptionHTML = `
            <div class="file">
                <div class="desDiv">
                    <img src="<?php echo URLROOT; ?>/public/img/patient/description.png" alt="description-icon">
                    <p class="description">Prescription #${prescription.prescription_ID}</p>
                </div>
                <p class="doctor">Issued by: Dr. ${prescription.first_Name} ${prescription.last_Name}</p>
                <p class="date">Issued on: ${prescription.prescription_Date}</p>
                <img src="<?php echo URLROOT; ?>/public/img/patient/Eye.png" alt="eye-icon" data-container-pid=${prescription.prescription_ID}>
            </div>
            `;
        prescriptionsContainer.innerHTML += prescriptionHTML;
      });
      const eyeIcons = document.querySelectorAll('.file img[src*="Eye.png"]');
        eyeIcons.forEach(icon => {
          const prescriptionID = icon.getAttribute('data-container-pid');
          console.log('Prescription ID:', prescriptionID); // Debug: Log prescription ID

          // Check if modal element exists
          const modal = document.getElementById(`myModal${prescriptionID}`);
          if (!modal) {
            console.error('Modal not found for Prescription ID:', prescriptionID);
            return; // Skip attaching event listeners if modal is not found
          }

          const closeButton = modal.querySelector(".close");

          // Show modal when eye icon is clicked
          icon.addEventListener("click", () => {
            modal.style.display = 'block';
          });

          // Close modal when close button is clicked
          closeButton.addEventListener("click", () => {
            modal.style.display = "none";
          });

          // Close modal when clicking outside the modal
          window.addEventListener("click", (event) => {
            if (event.target === modal) {
              modal.style.display = "none";
            }
          });
        });
    }

    $(document).ready(function() {
      // Event listener for checkbox change
      $('input[type="checkbox"]').change(function() {
        var checkbox = $(this);
        var prescriptionID = checkbox.data('container-pid');
        var id = checkbox.val();
        var status = checkbox.is(":checked") ? 'issued' : 'not_issued'; // Adjust status values as needed
        var formData = {
          id: id,
          status: status
        };

        // AJAX request to update medicine status
        $.ajax({
          type: 'POST',
          url: '<?php echo URLROOT ?>/Pharmacist/updateMedicineStatus',
          data: formData,
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              console.log('Medicine status updated successfully');
            } else {
              console.error('Error: ' + response.message);
            }
          },
          error: function() {
            console.log('Error occurred during AJAX request.');
          }
        });
      });

      // Set checkbox status based on initial medicine status
      
      $('input[type="checkbox"]').each(function() {
        var checkbox = $(this);
        if (checkbox.data('status') === 'issued') {
          checkbox.prop('checked', true);
        }
      });
    });
  </script>


</body>

</html>
 