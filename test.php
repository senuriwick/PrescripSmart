<?php
// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
require __DIR__ . '\twilio-php-main\src\Twilio\autoload.php';

// Your Account SID and Auth Token from console.twilio.com
$sid = "ACb18f4915d6508e8c112c8f304f009608";
$token = "b3aa1aebe6000a185c26365bf692a85b";
$client = new Twilio\Rest\Client($sid, $token);

// Use the Client to make requests to the Twilio REST API
$client->messages->create(
    // The number you'd like to send the message to
    '+94774936420',
    [
        // A Twilio phone number you purchased at https://console.twilio.com
        'from' => '+94774936420',
        // The body of the text message you'd like to send
        'body' => "Hey Jenny! Good luck on the bar exam!"
    ]
);