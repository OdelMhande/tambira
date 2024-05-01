<?php
include('dbcon.php');
session_start();


//include('session.php');

// Check if the form is submitted
    $password = $_POST['password'];
    $email = $_POST['email'];


    $stmt = $pdo->prepare("SELECT * FROM tblLogins WHERE email = ? AND password = ?");
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
         // echo "Login Successfull Credentials"
        $userId = $user['ID'];
        $username = $user['name'];
        $usertype = $user['usertype'];
        $profUrl = $user['profileUrl'];
        $backgroundUrl = $user['backgroundUrl'];

        //log the user
        $stmt = $pdo->prepare("INSERT INTO user_log ( user_mail, description) VALUES (?, ?)");
        $stmt->execute([ $userId,"login"]);
     
       
        $_SESSION['userId']= $userId; 
        $_SESSION['username']=$username;
        $_SESSION['usertype']=$usertype;
        $_SESSION['profUrl']=$profUrl;
        $_SESSION['backgroundUrl']=$backgroundUrl;

       header('Location: index.php'); // Redirect to the index page
       // echo "user is now logged in  $userId";
        exit();   
        
         
      }else{
          echo "Incorrect Credentials";
      }

  ?>