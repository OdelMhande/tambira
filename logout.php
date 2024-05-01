
<?php
session_start();
//include('session.php');
//$_SESSION['userId']= null;
unset($_SESSION['userId']);
//session_destroy();

//header('Location: login.php'); // Redirect to the index page
// echo "user is now logged off ";
 //exit();   

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles1.css">
    <title>Logout  Page</title>
   
</head>
<body>


    <nav class="navbar">
        <div class="navbar-left">
            <img src="images/logo333.png" alt="Logo" class="logo">
        </div>
        <div class="navbar-right">
            <button class="signin-button" onclick="window.location.href = 'register.php'">Register</button>
        </div>
    </nav>

    <div class="join-container">
        <h1 class="join-heading">Tambira - You have been logged out </h1>
    </div>

    <div class="registration-form-container">
   
 
        <div id="registration_form" class="registration-form">
    

            <button class="create-account-button" onclick="window.location.href = 'login.php'">Sign In </button>
           
</div>
    </div>

	
</body>




</html>


 