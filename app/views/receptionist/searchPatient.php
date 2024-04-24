<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Receptionist Search Patient</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/RepSearchPatient.css"/>
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/receptionist/navbar&sidemenu.css"/>
  <script src="<?php echo URLROOT ?>/js/receptionist/script.js"></script>


</head>
<body>

<?php require APPROOT .'/views/includes/navbar&sidemenu2.php'; ?>

        <div class="searchDiv">
            <h1>Search Patient</h1>
            <div class="searchFiles">
                <form>
                    <input type="search" id="searchinput" placeholder="Enter patient Name/ID here">
                    <button type="search"><b>SEARCH</b></button> 
                </form>                 
            </div>

            <div class="details">
                <table>
                    <tbody>
                    <?php foreach($data['patients'] as $post): ?>
                      <tr class="row">                                                                                                     

                            <td >
                                 <img class="person-circle" src= "<?php echo URLROOT ?>/img/receptionist/PersonCircle.png"  alt="profile-pic">
                                <p class= "name">
                                     Mr.
                                     <?php echo $post->last_name;?>
                                </p>
                            </td>

                            <td>
                                <p style="margin-left: 10vh;" >Patient ID #<?php echo $post->patient_id;?></p>
                            </td>

                            <td>
                            <a href="<?php echo URLROOT ?>/receptionist/showProfilePatient/<?php echo $post->emp_id ?>"><button class="profileButton"><b>View Profile</b></button> </a>
                                <form method="post" action="<?php echo URLROOT; ?>/receptionist/deleteProfilePatient/<?php echo $post->patient_id ?>">
                                    <input type="image" class="trash-image" src= "<?php echo URLROOT ?>/img/receptionist/Trash.png" alt="profile-pic">
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

        <div class="addapp">
            <div class="newapp">
                <img src="<?php echo URLROOT ?>/img/receptionist/FilePerson.png">
                <a href="<?php echo URLROOT?>/receptionist/viewregPatient">Register a new Patient</a>
            </div>
        </div>

    </body>
</html>