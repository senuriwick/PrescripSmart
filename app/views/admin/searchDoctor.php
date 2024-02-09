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
</head>
<body>

  <?php require APPROOT .'/views/includes/navbar&sidemenu.php'; ?>

        <div class="searchDiv">
          <h1>Search Doctor</h1>
          <div class="searchFiles">
<form>
<input type="text" id="searchinput" placeholder="Enter Doctors' Name/ID here">
<button type="search" class="searchButton"><b>SEARCH</b></button>


</form>
            <?php foreach($data['doctors'] as $post): ?>
                              <tr class="row">
                                                                           
                                <div class="column">

                                    <td >
                                    <img class="person-circle" src= "<?php echo URLROOT ?>/img/admin/PersonCircle.png"  alt="profile-pic">
                                    <p class="name">
                                    <?php echo $post->last_name;?>
                                    </p> 
                                    </td>

                                    <td>
                                    <p style="margin-left: 10vh;">Employee ID- <?php echo $post->doctor_id;?></p>
                                    </td>

                                    <td>
                                    <button class="profileButton">
                                       View profile
                                    </button>
                                    <img class="person-circle" src= "<?php echo URLROOT ?>/img/admin/Trash.png"  alt="profile-pic">

                                    </td>
                                               
                                  </div>
                                        
                                </tr>
                                    <?php endforeach; ?>

         </div>
       </div>

        <div class="addapp">
          <div class="newapp">
            <img src="<?php echo URLROOT ?>/img/admin/FilePerson.png">
            <a href="<?php echo URLROOT?>/admin/regDoctor">Register a new doctor</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="<?php echo URLROOT ?>/js/admin/script.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchinput");//element

  searchInput.addEventListener("input", function () {
    const searchTerm = searchInput.value.toLowerCase();//This line retrieves value of the search input field and converts it to lowercase.
    const regex = new RegExp(searchTerm, 'i'); 
    const Rows = document.querySelectorAll(".row");

        Rows.forEach(function (row) {
            const Name = row.querySelector(".name").textContent.toLowerCase();
        //   if (Name.includes(searchTerm)) {
        //     row.style.display = "table-row";
        //   } else {
        //     row.style.display = "none";

            if (regex.test(Name)) {
                    row.style.display = "table-row";
                } else {
                    row.style.display = "none";
                }
      });
    });
  });
</script>


               
</html>