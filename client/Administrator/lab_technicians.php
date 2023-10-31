<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Lab Technicians</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="lab_tech.css" />
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
                <a href="#ongoingSessions">Ongoing Sessions</a>
                <a href="sideMenuTexts">Sessions</a>
                <a href="sideMenuTexts">Profile</a>
            </div>
            <div class="othersDiv">
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
                            <p class="name">Doctor Name</p>
                            <p class="role">Doctor</p>
                        </div>
                    </div>

                    <div class="menu">
                        <p>Patients</p>
                        <p>On-going</p>
                        <p>Sessions</p>
                    </div>

                    <div class="patientSearch">
                        <h1>Search Lab Technicians</h1>
                        <form>
                            <input type="text" class="searchBar" id="searchInput" placeholder="Enter patient name or Id" />
                        </form>
                        <hr />
                        <div class="patient-details">
                            <table>
                                <tbody>
                                    <?php
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $database = "prescripsmart";

                                    // Create connection
                                    $connection = new mysqli($servername, $username, $password, $database);

                                    // Check connection
                                    if ($connection->connect_error) {
                                        die("Connection failed: " . $connection->connect_error);
                                    }

                                    // read all row from database table
                                    $sql = "SELECT * FROM lab_technician";
                                    $result = $connection->query($sql);

                                    if (!$result) {
                                        die("Invalid query: " . $connection->error);
                                    }

                                    // read data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>
                                                    <div class='desDiv'>
                                                        <img src='profile.png' alt='user-icon'>
                                                        <p class='patientName' id='patientName'>" . $row['firstname'] . "</p>
                                                    </div>
                                                </td>
                                                <td>Employee ID - #" . $row['lab_tec_id'] . "</td>
                                                <td><a href='lab_tech_profile.php?id=$row[lab_tec_id]'><button>View Profile</button></a></td>
                                                <td class='delete-icon'>
                                                    <a href='delete_technician.php?id=$row[lab_tec_id]'>
                                                        <i class='fa-solid fa-trash'></i>
                                                    </a>
                                                </td>

                                            </tr>
                                            ";
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
                                  const searchInput = document.getElementById("searchInput");
                              
                                  searchInput.addEventListener("input", function () {
                                    const searchTerm = searchInput.value.toLowerCase();
                                    const patientRows = document.querySelectorAll(".patient-details tr");
                              
                                    patientRows.forEach(function (row) {
                                      const patientName = row.querySelector(".patientName").textContent.toLowerCase();
                                      if (patientName.includes(searchTerm)) {
                                        row.style.display = "table-row";
                                      } else {
                                        row.style.display = "none";
                                      }
                                    });
                                  });
                                });

    </script>
    
</body>