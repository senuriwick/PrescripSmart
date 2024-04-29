<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Search a Receptionist</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/search.css" />
    <!-- <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/nav_receptionist.css"/> -->
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/receptionist.css" />
    <script src="<?php echo URLROOT ?>/js/admin/script.js"></script>

</head>

<body>

    <?php $currentPage = $data['currentPage'];
    $totalPages = $data['totalPages'];
    $allPatients = $data['allReceptionists'] ?>

    <div class="content">
        <?php include 'side_navigation_panel.php'; ?>

        <div class="main">
            <?php include 'top_navigation_panel.php'; ?>

            <div class="patientInfoContainer">
                <?php include 'information_container.php'; ?>
                <?php include 'in_page_navigation.php'; ?>

                <div class="addapp">
                    <div class="newapp">
                        <img src="<?php echo URLROOT ?>/img/admin/Vector (1).png">
                        <a href="<?php echo URLROOT ?>/admin/viewRegreceptionist">NEW RECEPTIONIST</a>
                    </div>
                </div>

                <div class="searchDiv">
                    <h1>Search Receptionist</h1>
                    <div class="searchFiles">
                        <form>
                            <input type="text" id="searchinput" class="searchinput"
                                placeholder="Enter receptionist's name here">
                            <!-- <button type="search" class="searchButton"><b>SEARCH</b></button> -->
                        </form>
                        <hr style="margin-bottom: 3vh;">

                        <div class="details">
                            <table>
                                <tbody>
                                    <?php foreach ($data['allReceptionists'] as $post): ?>
                                        <tr class="row">
                                            <td><img class="person-circle"
                                                    src="<?php echo URLROOT ?>/public/uploads/profile_images/<?php echo $post->profile_photo ?>"
                                                    alt="profile-pic"></td>
                                            <td>
                                                <?php if ($post->gender == "male"): ?>
                                                    <strong>
                                                        <p class="name">Mr.
                                                            <?php echo ucwords($post->first_Name . ' ' . $post->last_Name); ?>
                                                        </p>
                                                        </p>
                                                    </strong>
                                                <?php else: ?>
                                                    <strong>
                                                        <p class="name">Ms.
                                                            <?php echo ucwords($post->first_Name . ' ' . $post->last_Name); ?>
                                                        </p>
                                                        </p>
                                                    </strong>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <p>Employee ID #<?php echo $post->receptionist_ID; ?></p>
                                            </td>

                                            <td>
                                                <a
                                                    href="<?php echo URLROOT ?>/admin/showProfileReceptionist/<?php echo $post->receptionist_ID ?>"><button
                                                        class="profileButton"><b>View Profile</b></button> </a>
                                                <form id="deleteForm_<?php echo $post->receptionist_ID ?>" method="post"
                                                    action="<?php echo URLROOT; ?>/admin/deleteProfileReceptionist/<?php echo $post->receptionist_ID ?>">
                                                    <input type="image" id="trash" class="trash-image"
                                                        src="<?php echo URLROOT ?>/img/admin/Trash.png">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const searchInput = document.getElementById("searchinput");//element

                                    searchInput.addEventListener("input", function () {
                                        const searchTerm = searchInput.value.toLowerCase();//This line retrieves value of the search input field and converts it to lowercase.
                                        const regex = new RegExp(searchTerm, 'i');
                                        const Rows = document.querySelectorAll(".row");

                                        Rows.forEach(function (row) {
                                            const Name = row.querySelector(".name").textContent.toLowerCase();
                                            if (regex.test(Name)) {
                                                row.style.display = "";
                                            }
                                            else {
                                                row.style.display = "none";
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>

                     <div class="pagination">
                     <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="<?php echo URLROOT ?>/admin/searchReceptionist/<?php echo $i ?>" <?php if ($currentPage == $i)
                                echo 'class="active"'; ?>><?php echo $i ?></a>
                      <?php endfor; ?>

                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {

  document.getElementById("searchinput").addEventListener("input", function () {
          var searchQuery = this.value.trim();
          if (searchQuery !== "") {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "<?php echo URLROOT ?>/admin/filterReceptionists?search=" + searchQuery, true);
            xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && xhr.status == 200) {
                var filteredPatients = JSON.parse(xhr.responseText);
                updatePatientList(filteredPatients);
                
              }
            };
            xhr.send();
          } else {
            location.reload();
          }
        });
    });

    function updatePatientList(filteredPatients) {
        var patientsContainer = document.querySelector(".file-details .details");
        patientsContainer.innerHTML = "";

        filteredPatients.forEach(function (patient) {
            var patientHTML = `
          <table>
                   <tbody>
                      
                         <tr class="row"> 
                          <td><img class="person-circle" src= "<?php echo URLROOT ?>/public/uploads/profile_images/${patient.profile_photo}"  alt="profile-pic"></td>                                                                                   
                            <td >
                            <strong>
                        <p class="name">${patient.gender === 'male' ? 'Mr.' : 'Ms.'} ${patient.first_Name} ${patient.last_Name}</p>
                    </strong>
                            </td>

                            <td>
                                <p>Employee ID #${patient.patient_ID}</p>
                            </td>

                            <td>
                            <a href="<?php echo URLROOT ?>/admin/showProfilePatient/${patient.patient_ID}"><button class="profileButton"><b>View Profile</b></button> </a>
                            <form id="deleteForm_${patient.patient_ID}" method="post"
                                action="<?php echo URLROOT; ?>/admin/deleteProfileReceptionist/${patient.patient_ID}">
                            <input type="image" id="trash" class="trash-image" src="<?php echo URLROOT ?>/img/admin/Trash.png">
                            </form>                                   
                            </td> 
                        </tr>  
              
                  </tbody>
                </table>`
            patientsContainer.innerHTML += patientHTML;
        });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var trashIcons = document.querySelectorAll('.trash-image');

        trashIcons.forEach(function (trashIcon) {
            trashIcon.addEventListener('click', function () {
                var formId = this.parentNode.getAttribute('id');
                if (formId) {
                    document.getElementById(formId).submit();
                } else {
                    console.error('Form ID not found');
                }
            });
        });
    });
</script>

</html>