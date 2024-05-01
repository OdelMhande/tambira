
<?php 
include('session.php');
include('dbcon.php');
include('globals.php');
$row = "";




    $stmt = $pdo->prepare("SELECT * FROM tblInvestors WHERE name = ?");
    $stmt->execute([$USERNAME]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $t = "investor";

if (!($row)){
    $stmt = $pdo->prepare("SELECT * FROM tblstartups WHERE name = ?");
    $stmt->execute([$USERNAME]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $t = "startup";
};

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles1.css">
    <title>Profile Page</title>
 
</head>
<body>

<?php
  include('nav.php');
  ?>

    <div class="join-container">
        <h1 class="join-heading">Profile Page</h1>
    </div>

   



    <div class="registration-form-container">
   
   
        <form  id="upload-form" class="registration-form" enctype="multipart/form-data" >
        <div class="container">
    <div class="profile-background" style="background-image: url('<?php echo $row['backgroundUrl'] ; ?>');"></div>
    <img class="profile-image" src="<?php echo $row['profileUrl'] ; ?>" alt="Profile Image">

    <input id="background-input" type="file"  name="image1" style="display: none;">
  <input id="profile-input" type="file" name="image2" style="display: none;">

  </div>

            <input type="text"  class="registration-input" id="name" name="name" placeholder="<?php echo $row['name'] ?>" readonly>
            <input type="email" class="registration-input" id="email" name="email" placeholder="<?php echo $row['email'] ?>" readonly>
            <input type="tel"  class="registration-input" id="phone" name="phone" placeholder="<?php echo $row['phone_number'] ?>" readonly>
         

         
            <?php if ($USERTYPE == "investor"){?>
                <input  type="text" placeholder="Interests" class="registration-input" id="inIntrests" name="inIntrests" placeholder="<?php echo $row['Interests'] ?>" >
                <textarea class="registration-input" id="inDescription" name="inDescription" placeholder="<?php echo $row['Description'] ?>" ></textarea>
                <textarea class="registration-input" id="inGoals" name="inGoals" placeholder="<?php echo $row['Goals'] ?>" ></textarea>
                <select class="registration-input" id="inPriority" name="inPriority" placeholder="<?php echo $row['Priority'] ?>">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
                <?php } ?>
         
           

            
               
                <?php if ($USERTYPE == "startup"){?>
                    <textarea type="text"  class="registration-input"  placeholder="<?php echo $row['description'] ?>"></textarea>
                <label for="priority">Industry:</label>
                <select id="priority" class="registration-input">
                <option value="<?php echo $row['industry'] ?>"><?php echo $row['industry'] ?></option> 
                    <option value="technology">Technology</option>
                    <option value="finance">Finance</option> 
                    <option value="healthcare">Healthcare</option> 
                    <option value="retail">Retail</option> 
                    <option value="hospitality">Hospitality</option>
                    <option value="manufacturing">Manufacturing</option>
                    <option value="other">Other</option>
                </select>

                <textarea  class="registration-input"  placeholder="<?php echo $row['ongoing_projects'] ?>"></textarea>
                <!-- Input element for selecting the file -->
                <input type="file" id="business-plan-input" accept=".pdf" name="bussinessPlan" class="registration-input" placeholder="Choose business plan">
                <div class="rect">
                    <button class="upload-button" onclick="document.getElementById('business-plan-input').click()">
                        <i class="fas fa-upload"></i> Upload Business Plan (PDF)
                    </button>
                    <div id="business-planfile-name" class="file-name"></></div>
                </div>
                
                <input type="file" id="financial-projection-input" name="financialProjection" accept=".pdf" class="registration-input" onchange="handleFileSelect(event)">
                <div class="rect">
                <button class="upload-button" onclick="document.getElementById('financial-projection-input').click()">
                    <i class="fas fa-upload"></i> Upload Financial Projection (PDF)
                </button>
                <div id="financial-projectionfile-name" class="file-name"></div>
                </div>
                <?php } ?>

                

            <div class="rect"> 
            <button  value="submit"  class="create-account-button margin-20" id="submitButton" >Clear</button>

            <button  value="submit" type="submit" class="create-account-button  margin-20" id="submitButton" >Update </button>
            </div>
        </form>

        <div id="message"></div>
    </div>


    <script>
        function handleFileSelect(event) {
            const file = event.target.files[0];
            console.log('Selected file:', file);
            // You can perform further actions with the selected file if needed
        }

        var bussinessPlanfileInput = document.getElementById('business-plan-input');
        var bussinessProjectionfileInput = document.getElementById('financial-projection-input');
        
        var fileNameDisplay = document.getElementById('business-planfile-name');

        var projectionNameDisplay = document.getElementById('financial-projectionfile-name');
      
        bussinessPlanfileInput.addEventListener('change', function(event) {
        var files = event.target.files;
        if (files.length > 0) {
        fileNameDisplay.textContent = files[0].name;
        } else {
        fileNameDisplay.textContent = "";
        }
        });

        bussinessProjectionfileInput.addEventListener('change', function(event) {
        var files = event.target.files;
        if (files.length > 0) {
            projectionNameDisplay.textContent = files[0].name;
        } else {
            projectionNameDisplay.textContent = "";
        }
        });


    </script>
    <script>
    // Event handler for clicking the profile background
    document.querySelector('.profile-background').addEventListener('click', function() {
      document.querySelector('#background-input').click();
    });

    // Event handler for clicking the profile image
    document.querySelector('.profile-image').addEventListener('click', function() {
      document.querySelector('#profile-input').click();
    });

    // Event handler for selecting a new background image
    document.querySelector('#background-input').addEventListener('change', function(e) {
      var file = e.target.files[0];
      var reader = new FileReader();
      reader.onload = function() {
        document.querySelector('.profile-background').style.backgroundImage = "url('" + reader.result + "')";
      };
      reader.readAsDataURL(file);
    });

    // Event handler for selecting a new profile image
    document.querySelector('#profile-input').addEventListener('change', function(e) {
      var file = e.target.files[0];
      var reader = new FileReader();
      reader.onload = function() {
        document.querySelector('.profile-image').src = reader.result;
      };
      reader.readAsDataURL(file);
    });



     // Function to send the file to the server for saving
     document.getElementById('upload-form').addEventListener('submit', function(event) {
  event.preventDefault();

  var fileInput1 = document.getElementById('background-input');
  var file1 = fileInput1.files[0];

  var fileInput2 = document.getElementById('profile-input');
  var file2 = fileInput2.files[0];

  if (file1 && file2) {
    var formData = new FormData();
    formData.append('image1', file1);
    formData.append('image2', file2);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'updateacc.php', true);
    xhr.onload = function() {
      if (xhr.status === 200) {
        document.getElementById('message').textContent = 'Images uploaded successfully!';
      } else {
        document.getElementById('message').textContent = 'Error uploading images.';
      }
    };
    xhr.send(formData);
  }
});


  </script>
			
</body>




</html>

