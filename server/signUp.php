<?php

if (empty($_POST["first-name"])) {
    die("First name is required");
}
if (empty($_POST["last-name"])) {
    die("Last name is required");
}

if ( ! filter_var($_POST["email-address"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO patient (first-name,last-name, email-address, password_hash)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $_POST["first-name"],
                  $_POST["last-name"],
                  $_POST["email-address"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: client\signUp-success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already exists");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}