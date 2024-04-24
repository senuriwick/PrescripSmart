<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Doctor profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/profile.css" />
    <!-- <link rel="stylesheet" href="<?php echo URLROOT;?>/public/css/doctor/sideMenu_navBar.css" /> -->
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
    
        <?php include 'side_navigation_panel.php'; ?>
        <!-- <div class="container"> -->
        
            <div class="main">
            <?php include 'top_navigation_panel.php'; ?>
                <!-- <div class="main-Container"> -->
                    <!-- <div class="userInfo"> -->
                    <?php include 'information_container.php'; ?>
                    <!-- </div> -->

                    <?php include 'in_page_navigation.php'; ?>

                    <div class="doctorprofile">
                        <div class="empid">Employee Id :<?php echo $_SESSION['USER_DATA']->user_ID;?>
                            <div class="accountinfotext">Account Information</div>
                        </div>
                        <hr />
                        <div class="detail">
                            <div>Username
                                <div class="test-box">
                                    <div class="test-box-data">
                                        <?php echo $data['user']->username;?><i class="fa-solid fa-pen"></i>
                                    </div>
                                </div>
                            </div>
                            <div>Associated Email Address/ Phone Number
                                <div class="test-box">
                                    <?php echo $data['user']->email_phone;?>
                                </div>
                            </div>
                            <div>Current password
                                <div class="test-box">
                                    **********
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="detail">
                            <div>
                                <form method="POST" >
                                    <label>New password</label><br>
                                    <input type="password" id="new" placeholder="********">
                                </form>
                            </div>
                            <div>
                                <form>
                                    <label>Confirm password</label><br>
                                    <input type="password" id="confirm" placeholder="**********">
                                </form>
                            </div>
                            <div><button type="submit" onclick="checkInputs()">SAVE CHANGES</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkInputs() {
            var newpw = document.getElementById("new").value;
            var confirmpw = document.getElementById("confirm").value;

            if(newpw&&confirmpw){
                if(newpw!==confirmpw){
                    alert("confirm password doesn't match with new password");
                }
            }else if(!newpw){
                alert("Enter a new password to change");
            }else{
                alert("Confirm your password");
            }
            
        }
    </script>

</body>