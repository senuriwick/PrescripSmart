<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Search a Doctor</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT ?>/css/admin/search.css"/>
  <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/nav_tech.css"/>
  <script src="<?php echo URLROOT ?>/js/admin/script.js"></script>

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
            <h1>Search Lab technician</h1>
            <div class="searchFiles">
                <form>
                <input type="text" id="searchinput" class="searchinput" placeholder="Enter Lab Technicians' Name/ID here">
                <button type="search" class="searchButton"><b>SEARCH</b></button>
                </form>
                <hr style="margin-bottom: 3vh;">

               <div class="details">
                   <table>
                      <tbody>
                         <?php foreach($data['labtechs'] as $post): ?>
                              <tr class="row">                                                                                                               
                                 <td>
                                    <img class="person-circle" src= "<?php echo URLROOT ?>/img/admin/PersonCircle.png"  alt="profile-pic">
                                    <p class= "name">
                                        Mr.
                                        <?php echo ucwords($post->last_name);?>
                                    </p>
                                  </td>
                                                                      
                                    <td>
                                        <p style="margin-left: 10vh;">Employee ID #<?php echo $post->emp_id;?></p>
                                    </td>

                                    <td>
                                    <a href="<?php echo URLROOT ?>/admin/showProfileLabtech/<?php echo $post->emp_id ?>"><button class="profileButton"><b>View Profile</b></button> </a>
                                        <form method="post" action="<?php echo URLROOT; ?>/admin/deleteProfile/<?php echo $post->labtech_id ?>">
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

        <div class="pagination">
        <?php echo"<"; ?>
          <?php if($data['currentPage']>1): ?>
            <a href="<?php echo URLROOT; ?>/admin/searchLabtech/<?php echo ($data['currentPage']-1); ?>">Previous</a>
          <?php endif; ?>
          
          <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
            <a href="<?php echo URLROOT; ?>/admin/searchLabtech/<?php echo $i; ?>"> <?php if($i == $data['currentPage']) ?><?php echo $i; ?></a>
          <?php endfor; ?>

          <?php if($data['currentPage'] < $data['totalPages']): ?>
            <a href="<?php echo URLROOT ?>/admin/searchLabtech/<?php echo ($data['currentPage'] + 1) ?>">Next</a>
          <?php  endif; ?>
          <?php echo">"; ?>
       </div>                                                                                               
    </div>   

        <div class="addapp">
              <div class="newapp">
                  <img src="<?php echo URLROOT ?>/img/admin/FilePerson.png">
                  <a href="<?php echo URLROOT?>/admin/viewReglabtech">Register a new Lab Technician</a>
              </div>
        </div>  
        </div>
    </div>
  </div>  
    </body>
</html>