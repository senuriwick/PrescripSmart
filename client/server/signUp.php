<?php


if (empty($_POST["first_name"])) {
    die("First name is required");
}
if (empty($_POST["last_name"])) {
    die("Last name is required");
}

if ( ! filter_var($_POST["email_address"], FILTER_VALIDATE_EMAIL)) {
    //FILTER_VALIDATE_EMAIL: This is a filter ID that checks if the provided variable is a valid email address according to the syntax rules.

    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
/**"/[a-z]/i": This is a regular expression pattern enclosed in forward slashes (/). 
** The pattern [a-z] means any lowercase letter from 'a' to 'z'. The i at the end makes the pattern case-insensitive,
 *  so it will match both lowercase and uppercase letters. */
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO users (first_name,last_name, email_address, password_hash)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();
/**This method is called on the MySQLi object to initialize a new mysqli_stmt object. 
 * This statement object is specifically designed for preparing and executing SQL statements with placeholders for parameters. */

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["first_name"],
                  $_POST["last_name"],
                  $_POST["email_address"],
                  $password_hash);
/**values that will be substituted into the placeholders in the prepared SQL statement.
* They are taken from user input  */

if ($stmt->execute()) {

    header("Location: ..\general\signUp-success.html ");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already exists");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}