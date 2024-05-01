
<?php 

session_start();
if (isset($_SESSION['userId']) && !empty(trim($_SESSION['userId']))) {
  header('Location: index.php'); // Redirect to the index page
  // echo "helloooo. ".$_SESSION['userId'];
    exit(); // Stop further execution
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles1.css">
    <title>Registration Page</title>
    <style>
        .upload-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .upload-button:hover {
            background-color: #0056b3;
        }

        .upload-button i {
            margin-right: 5px;
        }
        .error-message {
    color: #ffffff;
    padding: 10px;
    border: 1px solid #ff0000;}


        /* Hide the file input */
        #business-plan-input {
            display: none;
        }
        #financial-projection-input {
            display: none;
        }

        .rect{
            display: flex;
        }
.file-name{
    font-weight: bold;
  color: #333;
  margin:5px
}
       

       
    </style>
</head>
<body>


    <nav class="navbar">
        <div class="navbar-left">
            <img src="images/logo333.png" alt="Logo" class="logo">
        </div>
        <div class="navbar-right">
            <button class="signin-button" onclick="window.location.href = 'login.php'">Login</button>
        </div>
    </nav>

    <div class="join-container">
        <h1 class="join-heading">Join Tambira</h1>
    </div>

    <div class="registration-form-container">
   
 
        <form id="registration_form" class="registration-form" action="reg.php" method="POST" >
            <input type="text" placeholder="Your Name" class="registration-input" id="name" name="name" required>
            <input type="email" placeholder="Email" class="registration-input" id="email" name="email" required>
            <input type="tel" placeholder="(000) 00 000 0000" class="registration-input" id="phone" name="phone" required>
            <input type="password" placeholder="Password" class="registration-input" id="password" name="password" required>
            <input type="password" placeholder="Confirm Password" class="registration-input" id="ConfirmPassword" name="confirmPassword" required>

            <div class="user-type">
    <input type="radio" name="userType" id="investor" value="investor" checked>
    <label for="investor">Investor</label>
    <input type="radio" name="userType" id="startup" value="startup">
    <label for="startup">Startup</label>
</div>

            <div id="investor-details" class="user-details">
                <input type="text" placeholder="Interests" class="registration-input" id="inIntrests" name="inIntrests" >
                <textarea placeholder="Brief Description" class="registration-input" id="inDescription" name="inDescription" ></textarea>
                <textarea placeholder="Financial Goals" class="registration-input" id="inGoals" name="inGoals" ></textarea>
                <select class="registration-input" id="inPriority" name="inPriority">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div id="startup-details" class="user-details">
                <textarea type="text" name="stdescription" placeholder="Startup Description" class="registration-input"></textarea>

                <label for="priority">Industry:</label>
                <select id="priority" class="registration-input"  name="stindustry">
                <option value="0"></option> 
                    <option value="technology">Technology</option>
                    <option value="finance">Finance</option> 
                    <option value="healthcare">Healthcare</option> 
                    <option value="retail">Retail</option> 
                    <option value="hospitality">Hospitality</option>
                    <option value="manufacturing">Manufacturing</option>
                    <option value="other">Other</option>
                </select>

                <textarea placeholder="Ongoing Projects" class="registration-input"  name="stprojects"></textarea>
                <!-- Input element for selecting the file -->
                <input type="file" id="business-plan-input" accept=".pdf" name="bussinessPlan" class="registration-input1" placeholder="Choose business plan">
                <div class="rect">
                    <button class="upload-button" type="button" onclick="document.getElementById('business-plan-input').click()">
                        <i class="fas fa-upload"></i> Upload Business Plan (PDF)
                    </button>
                    <div id="business-planfile-name" class="file-name"></></div>
                </div>
                
                <input type="file" id="financial-projection-input" name="financialProjection" accept=".pdf" class="registration-input1" onchange="handleFileSelect(event)">
                <div class="rect">
                <button class="upload-button" type="button" onclick="document.getElementById('financial-projection-input').click()">
                    <i class="fas fa-upload"></i> Upload Financial Projection (PDF)
                </button>
                <div id="financial-projectionfile-name" class="file-name"></div>
                </div>

                
            </div>

            <div class="agreement">
                <input type="checkbox" id="agreement-checkbox" required>
                <label for="agreement-checkbox">I agree to the terms and conditions</label>
            </div>

            <button  value="submit" type="submit" class="create-account-button" id="submitButton" >Create Account</button>

            <div class='error-message' id='error-cont'  style="display: none;">
            <p id='error-text'></p>
            </div>

        </form>

        <p class="existing-account">Already have an account? <a href="login.php">Sign In</a></p>
    </div>

    <script src="script.js"></script>

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

        //validation
        const submitButton = document.getElementById("submitButton");
        const userTypeRadios = document.getElementsByName("userType");
        var  selectedUserType = "investor";

        // Add event listener to each radio button
        userTypeRadios.forEach((radio) => {
            radio.addEventListener("click", function() {
            if (this.checked) {
                // Retrieve the value of the selected checkbox
                selectedUserType = this.value;
                console.log("Selected User Type:", selectedUserType);
                if(selectedUserType == "investor"){
    document.getElementById("investor-details").querySelectorAll(".registration-input").forEach(function(input) {
    input.setAttribute("required", true);
    });


    }else if ((selectedUserType == "startup")){

    document.getElementById("startup-details").querySelectorAll(".registration-input").forEach(function(input) {
    input.setAttribute("required", true);
    });


    }
            }
            });
        });




        // Function to check if all fields are filled
/**function checkFields() {
    if(selectedUserType == "investor"){
    document.getElementById("investor-details").querySelectorAll(".registration-input").forEach(function(input) {
    input.setAttribute("required", true);
    });

    document.getElementById("startup-details").querySelectorAll(".registration-input").forEach(function(input) {
    input.setAttribute("required", false);
    });


    }else if ((selectedUserType == "startup")){

    document.getElementById("startup-details").querySelectorAll(".registration-input").forEach(function(input) {
    input.setAttribute("required", true);
    });
    document.getElementById("investor-details").querySelectorAll(".registration-input").forEach(function(input) {
    input.setAttribute("required", false);
    });


    }
  if (input1.value.trim() !== "" && input2.value.trim() !== "" && input3.value.trim() !== "") {
    submitButton.disabled = false; // Activate the submit button
  } else {
    submitButton.disabled = true; // Deactivate the submit button
  }
}

// Add event listeners to input elements
input1.addEventListener("input", checkFields);
 */


    </script>
			
</body>




</html>

