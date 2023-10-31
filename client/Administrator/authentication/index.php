<?php

session_start();

if (isset($_SESSION["administrator_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM administrator
            WHERE id = {$_SESSION["administrator_id"]}";
            
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
    
    <?php if (isset($administrator)): ?>
        <script type="text/javascript">
            window.location.href = "Administrator\\AdminSearchPatient.html";
        </script>
    <?php else: ?>
        <h1>Home</h1>
        <p><a href="home.html">HOME PAGE</a></p>
    <?php endif; ?>
</body>
</html>