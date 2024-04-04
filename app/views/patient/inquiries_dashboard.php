<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Inquiries</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/patient/inquiries_dashboard.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/doctor/sideMenu&navBar.css" />
</head>

<body>
    <div class="content">
        <div class="sideMenu">
            <div class="logoDiv">
                <img class="logoImg" src="<?php echo URLROOT; ?>/public/img/patient/Untitled design (5) copy 2.png" />
            </div>

            <!-- <div class="patientDiv">
                <p class="mainOptions">PATIENT</p>

                <div class="profile">
                    <p>username</p>
                </div>
            </div> -->

            <div class="manageDiv">
                <p class="mainOptions">MANAGE</p>

                <a href="prescriptions_dashboard.html" id="prescriptions">Prescriptions</a>
                <a href="reports_dashboard.html" id="reports">Reports</a>
                <a href="appointments_dashboard.html" id="appointments">Appointments</a>
                <a href="inquiries_dashboard.html" id="inquiries">Inquiries</a>
                <a href="profile_dashboard.html" id="profile">Profile</a>
            </div>

            <div class="othersDiv">
                <a href="billing.html" id="billing">Billing</a>
                <a href="terms_of_service.html" id="terms">Terms of Service</a>
                <a href="privacy_policy.html" id="privacy">Privacy Policy</a>
            </div>
        </div>

        <div class="main">
            <div class="navBar">
                <img src="<?php echo URLROOT; ?>\public\img\patient\user.png" alt="user-icon">
                <p>SAMPLE USERNAME HERE</p>
            </div>

            <div class="patientInfoContainer">
                <div class="patientInfo">
                    <img src="<?php echo URLROOT; ?>\public\img\patient\profile.png" alt="profile-pic">
                    <div class="patientNameDiv">
                        <p class="name">Patient Name</p>
                        <p class="role">Patient</p>
                    </div>
                </div>

                <div class="menu">
                    <a href="inquiries_dashboard.html" id="inquiries">Health Inquiries</a>
                </div>

                <div class="inquiriesDiv">
                    <h1>Make an Inquiry</h1>
                    <p>Please feel free to submit your inquiries here, and rest assured that one of our dedicated health
                        supervisors will promptly respond to your request via email. Kindly provide us with your email
                        address below for a swift and efficient response.</p>
                    <br>
                    <form method="post" action="<?php echo URLROOT; ?>/patient/inquiries" id="contact-form">
                        <?php echo((!empty($errorMessage)) ? $errorMessage : '') ?>
                        <div class="input-group">
                            <label for="email" class="required-label">Email Address <span
                                    class="asterisk">*</span></label>
                            <input type="email" id="email" name="email" placeholder="Enter your email address here"
                                class="Input" required>
                        </div>

                        <div class="input-group">
                            <label for="name" class="required-label">Name <span class="asterisk">*</span></label>
                            <input type="text" id="name" name="name" placeholder="Enter your name here" class="Input"
                                required>
                        </div>

                        <div class="input-group">
                            <label for="message" class="required-label">Message <span class="asterisk">*</span></label>
                            <textarea id="message" name="message" placeholder="Enter your message here"
                                class="messageInput" required></textarea>
                        </div>

                        <button type="submit" id="submit">Submit</button>
                    </form>

                    <div id="successMessage" style="display: none; color: #0069ff;">Your message has been sent successfully. Thank You!</div>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>

    <script>
    const form = document.getElementById('contact-form');
    const inquiriesDiv = document.querySelector('.inquiriesDiv');
    const successMessage = document.getElementById('successMessage');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const constraints = {
            name: {
                presence: {allowEmpty: false}
            },
            email: {
                presence: {allowEmpty: false}
            },
            message: {
                presence: {allowEmpty: false}
            }
        };

        const formValues = {
            name: form.elements.name.value,
            email: form.elements.email.value,
            message: form.elements.message.value,
        };

        const errors = validate(formValues, constraints);
        if(errors) {
            const errorMessage = Object
                .values(errors)
                .map(function (fieldValues) {
                    return fieldValues.join(', ')
                })
                .join("\n");

            alert(errorMessage);
        } else {
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            })
            .then(response => {
                if (response.ok) {
                    form.style.display = 'none';
                    successMessage.style.display = 'block';
                } else {
                    throw new Error('Failed to send the form data.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while submitting the form.');
            });
        }
    });
</script>
</body>
</html>