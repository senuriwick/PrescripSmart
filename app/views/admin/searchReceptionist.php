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
          <h1>Search Receptionist</h1>
          <div class="searchFiles">

          <form>
          <input type="text" id="searchinput" class="searchinput" placeholder="Enter Receptionists' Name/ID here">
          <button type="search" class="searchButton"><b>SEARCH</b></button>
          </form>


          <hr style="margin-bottom: 3vh;">


            <?php foreach($data['receptionists'] as $post): ?>
                              <tr class="row">
                                        
                                        
                                <div class="column">
                                    <td>
                                    <img class="person-circle" src= "<?php echo URLROOT ?>/img/admin/PersonCircle.png"  alt="profile-pic">
                                    <div class= "name">
                                    <?php echo $post->last_name;?>
                                    </div>                                    
                                    </td>

                                    <td>
                                    <p style="margin-left: 10vh;">Employee ID- <?php echo $post->receptionist_id;?></p>
                                    </td>

                                    <td>
                                    <button class="profileButton">
                                       View profile
                                    </button>

                                  <form method="post" action="<?php echo URLROOT; ?>/admin/deleteProfile/<?php echo $post->receptionist_id ?>">
                                  <input type="image" class="trash-image" src= "<?php echo URLROOT ?>/img/admin/Trash.png" alt="profile-pic">
                                  </form>
                                    </td>             
                                  </div>
                                        
                                </tr>
                                    <?php endforeach; ?>

         </div>
       </div>

       <div class="addapp">
          <div class="newapp">
            <img src="<?php echo URLROOT ?>/img/admin/FilePerson.png">
            <a href="<?php echo URLROOT?>/admin/viewRegreceptionist">Register a new Receptionist</a>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</body>
<script src="<?php echo URLROOT ?>/js/admin/script.js"></script>
               
</html>