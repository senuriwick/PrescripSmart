<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Navigation</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A300%2C400%2C500%2C600" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\patient\add_new_container.css" />
</head>

<body>
    <p class="addnewHeading">Add new</p>
    <div class="addnew">

        <div class="appointment">
            <div>
                <img src="<?php echo URLROOT; ?>\public\img\patient\appointment.png" alt="appointment-icon">
                <p>
                    <a href="<?php echo URLROOT; ?>/patient/new_appointment" id="appointments">Schedule an
                        Appointment</a>
                    <span class="details">The modern way to schedule and meet with convenience</span>
                </p>
            </div>
        </div>

        <div class="inquiry">
            <div>
                <img src="<?php echo URLROOT; ?>\public\img\patient\message.png" alt="chat-icon">
                <p>
                    <a href="<?php echo URLROOT ?>/patient/inquiries_dashboard" id="inquiries">Make an Inquiry</a>
                    <span class="details">Initiate an online inquiry with a health supervisor</span>
                </p>
            </div>
        </div>

    </div>
</body>