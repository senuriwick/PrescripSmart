<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "prescripsmart";

// Check if the labTech_ID is provided in the URL
if (isset($_GET['id'])) {
    $labTech_ID = $_GET['id'];

    $connection = new mysqli($servername, $username, $password, $database);
    
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    
    $sql = "SELECT * FROM lab_technician WHERE lab_tec_id = $labTech_ID";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        $row = false;
    }
} else {
    header("Location: lab_technicians.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Lab techniciant profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="lab_tech_profile.css" />
    <link rel="stylesheet" href="sideMenu&navBar.css" />
    <script src="main.js"></script>
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="Untitled design (5) copy 2.png" />
            </div>

            <div class="userDiv">
                <p class="mainOptions">
                    <Datag>ADMINISTRATOR</Datag>
                </p>

                <div class="profile">
                    <p>username</p>
                </div>
            </div>


            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="#patients" class="active">Patients</a>
                <a href="#ongoingSessions">Doctors</a>
                <a href="sideMenuTexts">Nurses</a>
                <a href="sideMenuTexts">Lab Technician</a>
                <a href="sideMenuTexts">Health Supervisor</a>
                <a href="sideMenuTexts">Receptionist</a>
                <a href="sideMenuTexts">Pharmacist</a>
            </div>
            <div class="othersDiv">
            <p class="sideMenuTexts">Profile</p>
                <p class="sideMenuTexts">Billing</p>
                <p class="sideMenuTexts">Terms of Services</p>
                <p class="sideMenuTexts">Privacy Policy</p>
                <p class="sideMenuTexts">Settings</p>
            </div>

        </div>
        <div class="container">
            <div class="navBar">
                <div class="navBar">
                    <img src="user.png" alt="user-icon">
                    <p>USERNAME</p>
                </div>
            </div>
            <div class="main">
                <div class="main-Container">
                    <div class="userInfo">
                        <img src="profile.png" alt="profile-pic">
                        <div class="userNameDiv">
                            <p class="name">Administrator Name</p>
                            <p class="role">System admin</p>
                        </div>
                    </div>

                    <div class="menu">
                    <p><a href="#">Patients</a></p>
                        <p><a href="#">Doctors</a></p>
                        <p><a href="#">Nurses</a></p>
                        <p><a href="#">Lab Technicians</a></p>
                        <p><a href="#">Health SV</a></p>
                        <p><a href="#">Receptionists</a></p>
                        <p><a href="#">Pharmacist</a></p>
                    </div>

                    <div class="doctorprofile">
                    <?php if ($row) { ?>
                        <div class="empid">
                            Employee Id: #<?php echo $row['lab_tec_id']; ?>
                            <div class="accountinfotext">Account Information</div>
                        </div>
                        <hr />
                        <div class="detail">
                            <div>first name
                                <div class="test-box">
                                    <div class="test-box-data"><?php echo $row['firstname']; ?><i class="fa-solid fa-pen"></i>
                                    </div>
                                </div>
                            </div>
                            <div>Last name
                                <div class="test-box">
                                    <?php echo $row['lastname']; ?>
                                </div>
                            </div>

                            <div>Associated email address
                                <div class="test-box">
                                    <?php echo $row['email']; ?>
                                </div>
                            </div>
                            <div>Associated Phone Number
                                <div class="test-box">
                                    <?php echo $row['phone']; ?>
                                </div>
                            </div>
                            
                        </div>
                    <?php } else { ?>
                        <p>No data found</p>
                    <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>