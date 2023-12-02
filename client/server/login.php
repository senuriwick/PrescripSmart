<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM admins
                    WHERE email_address = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);//executes the defined query and stores in result
    
    $user = $result->fetch_assoc();//fetches data from the result object

    


    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["email_address"];
            
            header("Location: ../Administrator/AdminSearchPatient.html");
            exit;
       }
    }
    
    $is_invalid = true;
}