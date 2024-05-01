<?php
if (session_status() === PHP_SESSION_NONE) {
  // Only start the session if it is not already active
  session_start();
}
  $USERID = $_SESSION['userId']; 
  $USERNAME = $_SESSION['username'];
  $USERTYPE = $_SESSION['usertype'];
  $PROFILEURL =$_SESSION['profUrl'];
  $BACKGROUNDURL = $_SESSION['backgroundUrl'];
  $vu = "/upload/profile/im1.png";

?>