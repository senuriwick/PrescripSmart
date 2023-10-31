<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Register lab technician</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="success.css" />
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
                    <Datag>Administrator</Datag>
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
                            <p class="role">system Admin</p>
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
                    <h1><a href="#"><i class="fa-solid fa-arrow-left"></i></a>Lab Technician Registration</h1>
                        <div class="success-content">
                            <div class="msg">Successfull Registration !</div><br>
                            <div class="btn"><button><a href="register_lab_technician.php">Back To Dashboard</a></button></div>
                        
                        </div>
                    </div>
                    
                        
                </div>

            </div>

        </div>
        <!-- <script>
            document.addEventListener("DOMContentLoaded", function () {

                const registerbutton=document.querySelector(".buttondiv button");
                const sucsessfulmodel=document.getElementById("model");

                registerbutton.addEventListener("click",()=>{
                    sucseefulmodel.style.display: "block";
                })


            });
        </script> -->
    </div>
</body>