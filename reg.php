<?php
include('dbcon.php');

// Check if the form is submitted
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $confirmPassword = $_POST['confirmPassword'];
    $userType = $_POST['userType'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM tblLogins WHERE email = ?");
    $stmt->execute([$email]);
    $emailExists = $stmt->fetchColumn();
  
    if ($emailExists) {
      // Email already exists,
      echo "User with Email already exists. Please use a different email.";
    } else {

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM tblLogins WHERE name = ?");
        $stmt->execute([$name]);
        $nameExists = $stmt->fetchColumn();
      
        if ($nameExists) {
          // Email already exists,
          echo "User with name already exists. Please use a different name.";
        } else {


        // Check if any field is empty
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            $errorMsg = "Please fill in all the fields.";
        } else {
            // Check if the password and confirm password match
            if ($password !== $confirmPassword) {
            echo "Password and Confirm Password do not match";
            
            } else {

                // Save the form data to the database
                if($userType == "investor"){
                    $inIntrests = $_POST['inIntrests'];
                    $inDescription = $_POST['inDescription'];
                    $inGoals = $_POST['inGoals'];
                    $inPriority = $_POST['inPriority'];
                    $profileUrl = "./upload/profile/usr.jpg";
                    $stbackgroundUrl = "./upload/background/bg2.jpg";

                    if (empty($inIntrests) || empty($inDescription) || empty($inGoals) || empty($inPriority)) {
                        $errorMsg = "Please fill in all investor details.";
                    } else {

                        // Prepare the SQL statement
                $stmt = $pdo->prepare("INSERT INTO tblinvestors ( name, email, phone_number, password, Interests, Description, Goals, Priority,profileUrl,backgroundUrl) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $email, $phone, $password, $inIntrests, $inDescription, $inGoals, $inPriority,  $profileUrl ,  $profileUrl ]);
                
                $stmt = $pdo->prepare("INSERT INTO tbllogins (name,email,usertype,password,profileUrl,backgroundUrl) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $email, "investor", $password,$profileUrl ,$stbackgroundUrl ]);

                // Display success message
                echo "Investor registered successfully";
        

                    }

                }else if ($userType == "startup"){

                       $stindustry = $_POST['stindustry'];
                       $stdescription = $_POST['stdescription']; 
                       $stongoing_projects = $_POST['stprojects'];
                       $stbusiness_plan_file_url = $_POST['bussinessPlan'];
                       $stbusiness_financial_projection_file_url = $_POST['financialProjection'];
                       $stprofileUrl = "./upload/profile/usr.jpg";
                       $stbackgroundUrl = "./upload/background/bg2.jpg";
                 
                    $stmt = $pdo->prepare("INSERT INTO tblstartups ( name, email, phone_number, password, industry, description, ongoing_projects, business_plan_file_url,business_financial_projection_file_url,profileUrl,backgroundUrl) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?,?)");
                    $stmt->execute([$name, $email, $phone, $password, $stindustry, $stdescription, $stongoing_projects, $stbusiness_plan_file_url,$stbusiness_financial_projection_file_url,$stprofileUrl,$stbackgroundUrl]);
              
                    $stmt = $pdo->prepare("INSERT INTO tbllogins (name,email,usertype,password,profileUrl,backgroundUrl) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$name, $email, "startup", $password,$stprofileUrl ,$stbackgroundUrl ]);
    
                    echo "startup registered successfully";
                }

            }}
        }
}
?>