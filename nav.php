<?php 
include('globals.php');
?>
<link rel="stylesheet" href="index.css">
<div class="navbar">
        <img src="images/logo333.png" alt="Logo" class="logo">
        <div class="search-bar">
            
            <button class="investor-btn"><?php echo $USERTYPE ?></button>
            <div class="avatar">
              <img src=<?php echo $PROFILEURL ?> alt="Profile Image" onclick="toggleDropdown()" class="avatar-image">

              <div id="dropdownMenu" class="dropdown-content">
                <a href="index.php">Home</a>
                <a href="account.php">Account</a>
                <a href="logout.php">Logout</a>
              </div>
            </div>
        </div>
    </div>

    <script>
      function toggleDropdown() {
  var dropdownMenu = document.getElementById("dropdownMenu");
  dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
}

window.onclick = function(event) {
  if (!event.target.matches('.avatar-image')) {
    var dropdownMenus = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdownMenus.length; i++) {
      var openDropdownMenu = dropdownMenus[i];
      if (openDropdownMenu.style.display === "block") {
        openDropdownMenu.style.display = "none";
      }
    }
  }
};
    </script>