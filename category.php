<?php require "php/functions.php" ?>
<?php 
	if(isset($_GET['category'])){
		$cat = urldecode($_GET['category']);
	}
?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<meta name="description" content="UTM Unity Volunteer & Serve provides volunteer and service opportunities at University Technology Malaysia (UTM)">
	
	<meta name="keywords" content="volunteer and service">
	
	<link rel="stylesheet" href="styles.css">
	
	<title>Volunteering Events</title>
	
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
			<div class="section-title">Events in the <?php echo ucfirst($cat) ?> category</div>
			
			<?php $events = getEventsByCategory($cat) ?>
			<div class="activities">
				<?php
					foreach($events as $event){    
				?>					
					<div class="activities-left">
						<img src="<?php echo "events/{$event['image']}" ?>" alt=""> 
					</div>

					
					<div class="activities-right">
						<p class="title">
							<a href="event.php?title=<?php echo $event['title'] ?>">
								<?php echo $event['title'] ?>
							</a> 
						</p>
						
						<p class="description">
							<?php echo $event['description'] ?>
						</p>
						
						
						<!--<p class="details">
							
						</p> -->
						
					</div>
				<?php         
					}			
				?>				
			</div>
		</div>
	</main>
	
	<?php include "footer.php" ?>

	<script src="javascript/script.js"></script>

</body>
</html>
