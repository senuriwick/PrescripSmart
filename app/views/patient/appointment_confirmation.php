<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>New Appointment</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="\public\css\patient\new_appointment_confirmation.css" />
</head>

<body>

    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="\public\img\patient\Untitled design (5) copy 2.png" />
            </div>

            <div class="patientDiv">
                <p class="mainOptions">PATIENT</p>

                <div class="profile">
                    <p>username</p>
                </div>
            </div>


            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="prescriptions_dashboard.html" id="prescriptions">Prescriptions</a>
                <a href="reports_dashboard.html" id="reports">Reports</a>
                <a href="appointments_dashboard.html" id="appointments">Appointments</a>
                <a href="inquiries_dashboard.html" id="inquiries">Inquiries</a>
                <a href="prescriptions_dashboard.html" id="profile">Profile</a>
            </div>



            <div class="othersDiv">
                <a href="billing.html" id="billing">Billing</a>
                <a href="terms_of_service.html" id="terms">Terms of Service</a>
                <a href="privacy_policy.html" id="privacy">Privacy Policy</a>
            </div>

        </div>

        <div class="main">
            <div class="navBar">
                <img src="\public\img\patient\user.png" alt="user-icon">
                <p>SAMPLE USERNAME HERE</p>
            </div>

            <div class="adminInfoContainer">
                <div class="adminInfo">
                    <img src="\public\img\patient\profile.png" alt="profile-pic">
                    <div class="patientNameDivDiv">
                        <p class="name">Patient Name</p>
                        <p class="role">Patient</p>
                    </div>
                </div>


                <div class="menu">
                    <a href="new_appointment.html" id="appointments">New Appointment</a>
                </div>

                <div>
                    <p style="font-size: small; color: gray;">Search Results (1)<br>Doctor:Asanka Rathnayake</p>
                </div>

                <div class="searchDiv">
                    <h1 style="font-size: 18px; color:  #0069FF;">Monday, 18th September, 2023 At 19.00 P.M </h1>
                    <p style="line-height: 0.4;">Session #1265</p>
                    <div class="line1"></div>
                    <div class="smallrect">
                    </div>

                    <p class="sessionname">Active Patients: 05<br>
                        Channeling Fee:<br>
                        Rs. 4400<br></p>
                    <p class="policy">*Cancellation Policy</p>

                    <div id="policyPopup" class="policyPopup">
                        <div class="policyContent">
                            <h2>Cancellation Policy</h2>
                            <p>Your cancellation policy message goes here.</p>
                        </div>
                        <button id="closePolicy" class="closeButton">Close</button>
                    </div>

                    <button type="button" id="confirm" class="rectangle-70-mtM">CONFIRM</button>

                    <div id="customConfirmation" class="customConfirmation">
                        <div class="customConfirmationContent">
                            <h2>Confirmation</h2>
                            <p>Are you sure you want to confirm?</p>
                            <button id="yesButton" class="customConfirmationButton yesButton">YES</button>
                            <button id="noButton" class="customConfirmationButton noButton">NO</button>
                        </div>
                    </div>
    
                    <div id="confirmationOptions" class="confirmationOptions">
                        <div class="confirmationOptionsContent">
                            <h2>Appointment Scheduled</h2>
                            <p>Your appointment has been scheduled.</p>
                            <button id="viewAppointmentButton" class="customConfirmationButton viewAppointmentButton">View Appointment</button>
                            <button id="payNowButton" class="customConfirmationButton payNowButton">Pay Now</button>
                        </div>
                    </div>
    
                    <script>
                        document.querySelector(".policy").addEventListener("click", function () {
                            document.getElementById("policyPopup").style.display = "block";
                        });
    
                        document.getElementById("closePolicy").addEventListener("click", function () {
                            document.getElementById("policyPopup").style.display = "none";
                        });
    
                        document.getElementById("confirm").addEventListener("click", function () {
                            document.getElementById("customConfirmation").style.display = "block";
                        });
    
                        document.getElementById("yesButton").addEventListener("click", function () {
                            document.getElementById("customConfirmation").style.display = "none";
                            document.getElementById("confirmationOptions").style.display = "block";
                        });
    
                        document.getElementById("noButton").addEventListener("click", function () {
                            document.getElementById("customConfirmation").style.display = "none";
                        });
    
                        document.getElementById("viewAppointmentButton").addEventListener("click", function () {
                            window.location.href = 'view_appointment.html';
                            document.getElementById("confirmationOptions").style.display = "none";
                        });
    
                        document.getElementById("payNowButton").addEventListener("click", function () {
                            // Add "Pay Now" action here
                            alert("Pay Now");
                            document.getElementById("confirmationOptions").style.display = "none";
                        });
                    

                        document.querySelector(".policy").addEventListener("click", function () {
                            document.getElementById("policyPopup").style.display = "block";
                        });

                        document.getElementById("closePolicy").addEventListener("click", function () {
                            document.getElementById("policyPopup").style.display = "none";
                        });

                    </script>
                </div>
            </div>
        </div>
    </div>


</body>

</html>