<?php

session_start();

if (isset($_SESSION["patient_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM patient
            WHERE id = {$_SESSION["patient_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
</head>
<body>
    
    <h1>Home</h1>
    
    <?php if (isset($patient)): ?>
        <?php header("Location: \patient\prescription_dashboard.php"); // Redirect to the dashboard page ?>
    <?php else: ?>
        <h1>Home</h1>
        <p><a href="home.html">HOME PAGE</a></p>
    <?php endif; ?>
    
</body>
</html>