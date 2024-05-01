<?php 

include('session.php');

if (isset($_GET['q'])) {
    $id = $_GET['q'];

include('dbcon.php');

$stmt = $pdo->prepare("SELECT * FROM tblInvestors WHERE name = ?");
$stmt->execute([$id]);
$investor = $stmt->fetch(PDO::FETCH_ASSOC);

if ($investor) {

	$name = $investor['name'];
    $profileUrl = $investor['profileUrl'];
	$backgroundUrl = $investor['backgroundUrl'];
	$type = "Investor";
	$Interests = $investor['Interests'];
	$Description = $investor['Description'];
	$Goals = $investor['Goals'];

	

	
}else{
	$stmt = $pdo->prepare("SELECT * FROM tblstartups WHERE name = ?");
	$stmt->execute([$id]);
	$startup = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($startup){

	$name = $startup['name'];
    $profileUrl = $startup['profileUrl'];
	$backgroundUrl = $startup['backgroundUrl'];
	$type = $startup['industry'];
	$type .= ", Startup";
	$Interests = $startup['ongoing_projects'];
	$Description = $startup['description'];
	//$Goals = $startup['Goals'];
	$business_plan_file_url = $startup['business_plan_file_url'] ;
	$business_financial_projection_file_url =  $startup['business_financial_projection_file_url'];
	}

	
	

}


}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Details</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="detail.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  </head>
  <body>
	<div class="nav">

  <?php
  include('nav.php');
  ?>
  </div>

  <div class="body">
  <article>
	<header style="background-image: url('<?php echo $backgroundUrl; ?>');">

		<div class="lower-header">
			<div class="tags-container">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
					<defs>
						<style>
							.d {
								width: 20px;
								fill: #fff;
								opacity: .75;
							}
						</style>
					</defs>
					<path class="d" d="M19.22,9.66L10.77,1.21c-.74-.74-1.86-1.21-2.97-1.21H1.67C.75,0,0,.75,0,1.67V7.8c0,1.11,.46,2.23,1.3,2.97l8.45,8.46c1,1,2.62,1,3.62,0l5.94-5.95c.93-.93,.93-2.6-.09-3.62ZM6.96,6.35c-.59,.59-1.56,.59-2.15,0-.59-.59-.59-1.56,0-2.15,.59-.59,1.56-.59,2.15,0,.59,.59,.59,1.56,0,2.15Z" />
				</svg>
				<span> <?php echo $type; ?></span>
			</div>
			<div class="rect">
					
			<img src="<?php echo $profileUrl; ?>" class="imge-logo" alt="Tambira Investor profile picture">
			<h1 class="title"><?php echo $name; ?></h1>
			</div>
		</div>
	</header>

	<section class="summary">


		<?php 
		if ($investor){?>
			<div class="summary-item">

<h5 class="item-title">Intrests</h5>
<p class="item-text"><span class="item-data"><?php echo $Interests; ?></span></p>
</div>

		
		<div class="summary-item">
		<h5 class="item-title">Goals</h5>
		<p class="item-text"><span class="item-data"><?php echo $Goals; ?></p>
		</div>

		<?php }		?>


		<?php  if (!($investor)){?>
			<div class="summary-item">

<h5 class="item-title">On going projects</h5>
<p class="item-text"><span class="item-data"><?php echo $Interests; ?></span></p>
</div>
		
		<div class="summary-item">
			<h5 class="item-title">Business plan</h5>
			<p class="item-text">
				<a href="<?php echo $business_plan_file_url; ?>" download>
				<button class="button-download">Download</button>
				</a>

			</p>
		</div>
		<div class="summary-item">
			<h5 class="item-title">Financial Projection</h5>
			<p class="item-text">
				
			<a href="<?php echo $business_financial_projection_file_url; ?>" download>
				<button class="button-download">Download</button>
				</a>
		</div>
		<?php }		?>
	</section>
	<section class="main-article">
		<h4>Description</h4>
		<p><?php echo $Description; ?></p>
		

</article>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
</div>
  </body>
</html>