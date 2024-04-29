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
  <link rel="stylesheet" href="<?php echo URLROOT; ?>\public\css\general\top_navigation_panel.css" />
</head>

<body>
<div class="navBar">
    <img src="<?php echo URLROOT; ?>\public\img\general\user_icon.png" alt="user-icon" id="userIcon">
    <p>
      <?php echo $_SESSION['USER_DATA']->username ?>
    </p>

    <div id="logoutOption">
      <a href="#" id="logoutButton">Logout</a>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const userIcon = document.getElementById('userIcon');
      const logoutOption = document.getElementById('logoutOption');

      userIcon.addEventListener('click', function () {
        logoutOption.style.display = (logoutOption.style.display === 'block') ? 'none' : 'block';
      });

      const logoutButton = document.getElementById('logoutButton');

      logoutButton.addEventListener('click', function (event) {
        event.preventDefault();
        logout();
      });

      function logout() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              // Logout successful, redirect to home page
              window.location.href = '<?php echo URLROOT; ?>/general/home';
            } else {
              console.error('Logout failed');
            }
          }
        };
        xhr.open('GET', '<?php echo URLROOT; ?>/healthSupervisor/logout', true);
        xhr.send();
      }
    });
  </script>

</body>