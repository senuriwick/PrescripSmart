<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM administrator
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email_address"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($patient) {
        
        if (password_verify($_POST["password"], $administrator["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["administrator_id"] = $administrator["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Login Page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700"/>
  <link rel="stylesheet" href="loginPage.css">
</head>
<body>
    <?php if ($is_invalid): ?>
        <em>Invalid Login</em>
    <?php endif; ?>
<div class="loginPage">
  <div class="upperRectangle">
  </div>
  <div class="formContainer">
    <div class="loginForm">
      <p class="login-to-your-account">Login to your account</p>
      <form method="post">
        <div class="emailContainer">
          <input type="text" id="email_address" name="email_address" placeholder="Enter your email/phone number" class="inputfield">
          <p class="inputLabel1">
            <span class="inputLabel1-0">email/phone number </span>
            <span class="inputLabel1-1">*</span>
          </p>
        </div>
        <div class="passwordContainer">
          <input type="password" id="password" name="password" placeholder="Enter your password" class="inputfield">
          <p class="inputLabel2">
            <span class="inputLabel2-0">password </span>
            <span class="inputLabel2-1">*</span>
          </p>
        </div>
        <button type="submit" class="loginButton">Log In</button>
      </form>
      <a href="forgot_password.html" class="forgot-password">Forgot Password?</a>
    </div>    
  </div>
</div>
</body>
</html>








