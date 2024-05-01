<?php

if (session_status() === PHP_SESSION_NONE) {
  // Only start the session if it is not already active
  session_start();
}

//session_start();

if (!(isset($_SESSION['userId']) && !empty(trim($_SESSION['userId'])))) {
  header('Location: login.php'); // Redirect to the index page
  exit();   
}

?>