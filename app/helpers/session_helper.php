<?php
session_start();

$timeout = 1800;

function isLoggedIn()
{
  return isset($_SESSION['email_address']);
}

function logoutIfInactive($timeout)
{
  if (isLoggedIn() && isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
    exit;
  }

  $_SESSION['LAST_ACTIVITY'] = time();
}

logoutIfInactive($timeout);
