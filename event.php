<?php require "php/functions.php" ?>
<?php 
	if(isset($_GET['title'])){
		$title = urldecode($_GET['title']);
		$event = getEventByTitle($title);
	}
?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta name="description" content="<?php echo $event[0]['meta_description'] ?>">
	
	<meta name="keywords" content="<?php echo $event[0]['meta_keywords'] ?>">
	
	<link rel="stylesheet" href="styles.css">
	
	<title><?php echo $title ?></title>
	
	<style>
	
		footer{
			position: fixed;
			bottom: 0;
		}
		
	</style>
	
</head>

<body>

	<?php include "nav.php" ?>
	<?php include "header.php" ?>
	
	
	<main>
		
		<div class="left">
			<div class="section-title">Event Categories</div>
			
			<?php $categories = getCategories() ?>
			<?php
				foreach($categories as $category){
			?>
				<a href="category.php?category=<?php echo urlencode($category['category']) ?>">
					<?php echo ucfirst($category['category']) ?>
				</a>
			<?php
				}
			?>
			
		</div>
		
		<div class="right">
			<div class="section-title">Events Details</div>
			<div class="activities">
								
					<div class="activities-left">
						<img src="<?php echo "events/{$event[0]['image']}" ?>" alt=""> 
					</div>

				
					<div class="activities-right">
						<p class="title">
							<?php echo $event[0]['title'] ?> 
						</p>
						<p class="description">
							<?php echo $event[0]['description'] ?> 
						</p>
						<p class="details">
							<?php echo $event[0]['details'] ?> <br>
							<br>
							<button class="registration-button" onclick="window.location.href='registration_form.php'"> Register Now </button>
							<style>
							button.registration-button {
								background-color: #a3e4d7; 
								color: black; 
								padding: 10px 20px; 
								font-size: 16px;
								border: none; 
								border-radius: 5px;
								cursor: pointer; 
								transition: background-color 0.3s, color 0.3s; 
								margin-top: 20px; 
							}
							
							button.registration-button:hover {
								background-color: #5bc0de; 
							}
						</p>
					</div>
							
			</div>
		</div>
	</main>
	
	<?php include "footer.php" ?>

	<script src="javascript/script.js"></script>

</body>
</html>