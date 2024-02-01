<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "prescripsmart";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$firstName = "";
$lastName = "";
$email = "";
$phone = "";
$userPassword = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location: lab_technicians.php");
        exit;
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM lab_technician WHERE lab_tec_id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    

    if (!$row) {
        header("location: lab_technicians.php");
        exit;
    }
    $firstName = $row["firstname"];
    $lastName = $row["lastname"];
    $email = $row["email"]; 
    $phone = $row["phone"];
    $userPassword = $row["password"];
}
else {
    // POST method: Update the data of the client
    $id = $_GET["id"];
    $firstName = $_POST["fname"];
    $lastName = $_POST["lname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $userPassword = $_POST["userPassword"];

    do {
        if( empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($userPassword)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE lab_technician " . 
        "SET firstname = '$firstName', lastname = '$lastName', email = '$email', phone = '$phone', password = '$userPassword' " . 
        "WHERE lab_tec_id = $id";
 

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Client updated correctly";

        header("location: lab_technicians.php");
        exit;

    } while (false);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Admin/Register lab technician</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="register_lab_technician.css" />
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
                    <Datag>DOCTOR</Datag>
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
                <a href="sideMenuTexts">Lab Technicians</a>
                <a href="#ongoingSessions">Health Supervisors</a>
                <a href="sideMenuTexts">Receptionists</a>
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
                            <p class="role">Sysytem Admin</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p>Patients</p>
                        <p>Doctors</p>
                        <p>Nurses</p>
                        <p>Lab Technicians</p>
                        <p>Health SV</p>
                        <p>Receptionists</p>
                        <p>Pharmacist</p>
                    </div>

                    <div class="patientSearch">
                        <h1>Edit Lab Technician's Details</h1>
                        <div class="formdiv">
                                <form method="post">
                                    <div class="divdetails">
                                        <div class="formdetail">
                                <label for="fname">First name:</label><br>
                                <input type="text" id="fname" name="fname" placeholder="Enter First Name" required value="<?php echo $firstName ?>"></div>

                                <div class="formdetail">
                                <label for="lname">Last name:</label><br>
                                <input type="text" id="lname" name="lname" placeholder="Enter Second Name" required value="<?php echo $lastName ?>"></div></div>
                                
                                
                                <div class="divdetails">
                                <div class="formdetail">
                                <label for="email">Email Address:</label><br>
                                <input type="email" id="email" name="email" placeholder="Enter Email Address" required value="<?php echo $email ?>"><br></div>

                                <div class="formdetail">
                                <label for="phone">Phone Number:</label><br>
                                <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" value="<?php echo $phone ?>" required><br></div></div>

                                
                                <div class="divdetails">
                                <div class="formdetail">
                                <label for="password">Password:</label><br>
                                <input type="password" id="userPassword" name="userPassword" placeholder="Enter Password" required value="<?php echo $userPassword ?>"><br></div>
                            
                                <div class="formdetail"></div>
                                </div>
                                
                                
                                </div>

                                <div class="buttondiv">
                               <button id="register">Update</button>

                    </div>
                </div>
            </div>
        </div>
</body>