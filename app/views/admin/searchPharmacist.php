<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Search a Pharmacist</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/search.css"/>
  <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/nav_pharmacist.css"/>
  <script src="<?php echo URLROOT ?>/js/admin/script.js"></script>

</head>
<body>

<?php $currentPage = $data['currentPage'];
  $totalPages = $data['totalPages'];
  $allPatients = $data['allPharmacists'] ?>

<div class="content">
    <?php include 'side_navigation_panel.php'; ?>

    <div class="main">
      <?php include 'top_navigation_panel.php'; ?>

      <div class="patientInfoContainer">
        <?php include 'information_container.php'; ?>
        <?php include 'in_page_navigation.php'; ?>

        <div class="searchDiv">
                <h1>Search Pharmacist</h1>
                <div class="searchFiles">
                    <form>
                        <input type="text" id="searchinput" class="searchinput" placeholder="Enter Pharmacists' Name/ID here">
                        <button type="search" class="searchButton"><b>SEARCH</b></button>
                    </form>
                    <hr style="margin-bottom: 3vh;">

                    <div class="details">
                        <table>
                            <tbody>
                            <?php foreach($data['allPharmacists'] as $post): ?>
                                <tr class="row">                                                                                                      
                                    <td >
                                        <img class="person-circle" src= "<?php echo URLROOT ?>/img/admin/PersonCircle.png"  alt="profile-pic">
                                        <p class= "name">
                                            Mr.
                                            <?php echo ucwords($post->first_Name . ' ' . $post->last_Name); ?>
                                        </p> 
                                    </td>
                                    <td>
                                            <p style="margin-left: 10vh;">Employee ID #<?php echo $post->pharmacist_ID;?></p>
                                    </td>

                                    <td>
                                    <a href="<?php echo URLROOT ?>/admin/showProfilePharmacist/<?php echo $post->pharmacist_ID ?>"><button class="profileButton"><b>View Profile</b></button> </a>
                                        <form method="post" action="<?php echo URLROOT; ?>/admin/deleteProfilePharmacist/<?php echo $post->pharmacist_ID ?>">
                                            <input type="image" class="trash-image" src= "<?php echo URLROOT ?>/img/admin/Trash.png" alt="profile-pic">
                                        </form>
                                    </td>
                                </tr>                                                                                            
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
            </div>

        <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="<?php echo URLROOT ?>/admin/searchPatient/<?php echo $i ?>" <?php if ($currentPage == $i)
                                echo 'class="active"'; ?>><?php echo $i ?></a>
                      <?php endfor; ?>

       </div>
    </div>

        <div class="addapp">
            <div class="newapp">
                <img src="<?php echo URLROOT ?>/img/admin/FilePerson.png">
                <a href="<?php echo URLROOT?>/admin/viewRegpharmacist">Register a new Pharmacist</a>
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
            xhr.open("GET", "<?php echo URLROOT ?>/admin/filterPatients?search=" + searchQuery, true);
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
                                    <td >
                                        <img class="person-circle" src= "<?php echo URLROOT ?>/img/admin/PersonCircle.png"  alt="profile-pic">
                                        <p class= "name">
                                            Mr.
                                            <?php echo ucwords($post->first_Name . ' ' . $post->last_Name); ?>
                                        </p> 
                                    </td>
                                    <td>
                                            <p style="margin-left: 10vh;">Employee ID #<?php echo $post->pharmacist_ID;?></p>
                                    </td>

                                    <td>
                                    <a href="<?php echo URLROOT ?>/admin/showProfilePharmacist/<?php echo $post->pharmacist_ID ?>"><button class="profileButton"><b>View Profile</b></button> </a>
                                        <form method="post" action="<?php echo URLROOT; ?>/admin/deleteProfilePharmacist/<?php echo $post->pharmacist_ID ?>">
                                            <input type="image" class="trash-image" src= "<?php echo URLROOT ?>/img/admin/Trash.png" alt="profile-pic">
                                        </form>
                                    </td>
                                </tr>    
                    </tbody> 
                <table>`;
          patientsContainer.innerHTML += patientHTML;
        });
      }
</script>
</html>