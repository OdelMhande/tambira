<?php

include('dbcon.php');
include('globals.php');

$charset = 'utf8mb4';


// Get the uploaded image files
$image1 = $_FILES['image1'];
$image2 = $_FILES['image2'];

// Generate unique filenames for the uploaded images
$filename1 = uniqid() . '_' . $image1['name'];
$filename2 = uniqid() . '_' . $image2['name'];

// Move the uploaded images to the specified directory
$uploadPath1 = './upload/background' . $filename1;
$uploadPath2 ='./upload/profile' . $filename2;
move_uploaded_file($image1['tmp_name'], $uploadPath1);
move_uploaded_file($image2['tmp_name'], $uploadPath2);

try {

  // Prepare and execute the SQL statements to insert the image URLs into the database
 // Prepare and execute the SQL statement to update the image URLs in the database
 /*UPDATE `` SET `id`='[value-1]',`name`='[value-2]',`phone_number`='[value-3]',`email`='[value-4]',
 `password`='[value-5]',`description`='[value-6]',`industry`='[value-7]',`ongoing_projects`='[value-8]'
 ,`business_plan_file_url`='[value-9]',`business_financial_projection_file_url`='[value-10]',
 `profileUrl`='[value-11]',`backgroundUrl`='[value-12]' WHERE 1
*/
if ($USERTYPE == "investor"){
    $stmt = $pdo->prepare("UPDATE tblinvestors SET backgroundUrl = :url1, profileUrl = :url2 WHERE name = :id");
    $stmt->bindParam(':url1', $uploadPath1);
    $stmt->bindParam(':url2', $uploadPath2);
    $stmt->bindParam(':id', $USERNAME); // Replace 'recordId' with the actual record ID you want to update
    $stmt->execute();

    $stmt = $pdo->prepare("UPDATE tbllogins SET backgroundUrl = :url1, profileUrl = :url2 WHERE name = :id");
    $stmt->bindParam(':url1', $uploadPath1);
    $stmt->bindParam(':url2', $uploadPath2);
    $stmt->bindParam(':id', $USERNAME); // Replace 'recordId' with the actual record ID you want to update
    $stmt->execute();

}

if ($USERTYPE == "startup"){
    $stmt = $pdo->prepare("UPDATE tblstartups SET backgroundUrl = :url1, profileUrl = :url2 WHERE name = :id");
    $stmt->bindParam(':url1', $uploadPath1);
    $stmt->bindParam(':url2', $uploadPath2);
    $stmt->bindParam(':id', $USERNAME); // Replace 'recordId' with the actual record ID you want to update
    $stmt->execute();

    $stmt = $pdo->prepare("UPDATE tbllogins SET backgroundUrl = :url1, profileUrl = :url2 WHERE name = :id");
    $stmt->bindParam(':url1', $uploadPath1);
    $stmt->bindParam(':url2', $uploadPath2);
    $stmt->bindParam(':id', $USERNAME); // Replace 'recordId' with the actual record ID you want to update
    $stmt->execute();
    
}
 http_response_code(200);

} catch (PDOException $e) {
  http_response_code(500);
}
?>