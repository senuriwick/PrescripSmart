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
          <h1>Search Lab technician</h1>
          <div class="searchFiles">

            <input type="search" placeholder="Enter Lab technician' Name/ID here">
            <button type="search" class="searchButton"><b>SEARCH</b></button>

            <?php foreach($data['labtechs'] as $post): ?>
                              <tr class="row">
                                        
                                        
                                <div class="column">

                                    <td >
                                    <img class="person-circle" src= "<?php echo URLROOT ?>/img/admin/PersonCircle.png"  alt="profile-pic">
                                    <div class= "name">
                                    <?php echo $post->last_name;?>
                                    </div>
                                    </td>
                                                                      
                                    <td>
                                    <p style="margin-left: 10vh;">Employee ID- <?php echo $post->labtech_id;?></p>
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

        <!-- <div class="addapp">
          <div class="newapp">
            <img src="<?php //echo URLROOT ?>/img/FilePerson.png">
            <a href="AdminDocRegister.html">Register a new doctor</a>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</body>
<script src="<?php echo URLROOT ?>/js/admin/script.js"></script>
               
</html>