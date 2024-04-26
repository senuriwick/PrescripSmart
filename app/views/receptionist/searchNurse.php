<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Receptionist Search Nurse</title>
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
            
            <div class="details">
                <table>
                    <tbody>
                    <?php foreach($data['nurses'] as $post): ?>
                    <tr class="row">
                                                                               
                         <td >
                            <img class="person-circle" src= "<?php echo URLROOT ?>/img/admin/PersonCircle.png"  alt="profile-pic">
                            <p class= "name">
                                Mr.
                                <?php echo $post->last_Name;?>
                            </p> 
                        </td>
                                                                   
                        <td>
                            <p style="margin-left: 10vh;">Employee ID #<?php echo $post->nurse_ID;?></p>
                        </td>

                        <td>
                        <a href="<?php echo URLROOT ?>/admin/showProfileNurse/<?php echo $post->nurse_ID ?>"><button class="profileButton"><b>View Profile</b></button> </a>
                            <form method="post" action="<?php echo URLROOT; ?>/admin/deleteProfileNurse/<?php echo $post->nurse_id ?>">
                                <input type="image" class="trash-image" src= "<?php echo URLROOT ?>/img/admin/Trash.png" alt="profile-pic">
                            </form>
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
</body>