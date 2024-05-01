<?php 
include('session.php');
include('dbcon.php');


// Retrieve data from the tblInvestors table
$stmt = $pdo->query("SELECT * FROM tblInvestors");
$investors = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retrieve data from the tblstartups table
$stmt1 = $pdo->query("SELECT * FROM tblstartups");
$startups = $stmt1->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Startup Connect</title>
    <link rel="stylesheet" href="index.css">
   
</head>
<body>
  <?php
  include('nav.php');
  ?>

    <div class="banner">
        <div class="banner-text">Connect with investors and startups</div>
        <div class="banner-subtext">Join our community and start building relationships</div>
        <div class="search-bar">
           
        </div>
    </div>

    <div class="featured-wrapper">
        <div class="featured-heading">Featured Investors</div>
        <main class="main">
  <section class="stories">
        <?php foreach ($investors as $investor): ?>
    <div class="stories__item stories__item--active"  id="<?php echo $investor['name']; ?>" onclick="redirectToDetails(this.id)">
      <button>
        <div class="stories__item-picture">
          <img src="<?php echo $investor['profileUrl']; ?>" alt="Tambira Investor profile picture">
        </div>
        <span class="stories__item-username"><?php echo $investor['name']; ?></span>
        <span class="stories__item-description"><?php echo $investor['Description']; ?></span>
      </button>
    </div>
    <?php endforeach; ?>


  </section>
</main>
    </div>

    <div class="featured-wrapper">
        <div class="featured-heading">Featured Startups</div>
        <main class="main">
  <section class="stories">
  <?php foreach ($startups as $startup): ?>
    <div class="stories__item stories__item--active" id="<?php echo $startup['name']; ?>" onclick="redirectToDetails(this.id)">
    <button>
      <div class="stories__item-picture">
        <img src="<?php echo $startup['profileUrl']; ?>" alt="Tambira Investor profile picture">
      </div>
      <span class="stories__item-username"><?php echo $startup['name']; ?></span>
      <span class="stories__item-description"><?php echo $startup['description']; ?></span>
    </button>
  </div>
    <?php endforeach; ?>


  </section>
</main>
    </div>
    <script src="individualdetails.js"></script>

    <script>
function redirectToDetails(id) {
  window.location.href = 'detail.php?q=' + id;
}
</script>
  
</body>
</html>
