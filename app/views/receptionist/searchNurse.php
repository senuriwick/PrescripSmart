<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title> Search a Nurse</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/RepSearchNurse.css" />
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

        <div class="searchDiv">
            <h1>Search Nurse</h1>
            <div class="searchFiles">
                <form>
                    <input type="search" id="searchinput" placeholder="Enter Doctor Name/ID here">
                    <button type="search"><b>SEARCH</b></button> 
                </form>
            </div>
            
            <div class="details">
                <table>
                    <tbody>
                    <?php foreach($data['nurses'] as $post): ?>
                    <tr class="row">
                                                                               
                         <td >
                            <img class="person-circle" src= "<?php echo URLROOT ?>/img/receptionist/PersonCircle.png"  alt="profile-pic">
                            <p class= "name">
                                Mr.
                                <?php echo ucwords($post->first_Name . ' ' . $post->last_Name); ?>
                            </p> 
                        </td>
                                                                   
                        <td>
                            <label class= "id" style="margin-left: 10vh;">Employee ID #<?php echo $post->nurse_ID;?></label>
                        </td>

                        <td>
                        <a href="<?php echo URLROOT ?>/receptionist/nurseViewSessions/<?php echo $post->nurse_ID ?>"><button class="profileButton"><b>View Assigned Sessions</b></button> </a>
                        <a href="<?php echo URLROOT ?>/receptionist/nurseAssignSessions/<?php echo $post->nurse_ID ?>"><button class="sessionButton"><b>Assign to a Session</b></button> </a>                       
                       
                       </td>
                                               
                                                                  
                      </tr>
            <?php endforeach; ?>

                    </tbody>
                </table>

                

                <script>
                      document.addEventListener("DOMContentLoaded", function () {
                      const searchInput = document.getElementById("searchinput");//element

                      searchInput.addEventListener("input", function ()
                      {
                      const searchTerm = searchInput.value.toLowerCase();//This line retrieves value of the search input field and converts it to lowercase.
                      const regex = new RegExp(searchTerm, 'i'); 
                      const Rows = document.querySelectorAll(".row");

                          Rows.forEach(function (row) 
                          {
                                const Name = row.querySelector(".name").textContent.toLowerCase();
                                if (regex.test(Name)) {
                                        row.style.display = "";
                                        
                                    } else {
                                        row.style.display = "none";
                                    
                                    }
                          });
                        });
                    });
                  </script>
            </div>
        </div>
        <div class="addapp">
                    <div class="newapp">
                        <img src="<?php echo URLROOT ?>/img/receptionist/FilePerson.png">
                        <a href="<?php echo URLROOT ?>/admin/viewregNurse">Register a new Nurse</a>
                    </div>
                </div>


            </div>

            
        </div>
    </div>
    </div>
</body>