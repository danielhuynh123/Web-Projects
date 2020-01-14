<?php include 'menuitem.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>WP Eatery - Home</title>
		<?php include 'header.php' ?>
	</head>
	
	<body>
		<div id="content" class="clearfix">
			<aside>
				<h2><?php echo date("l");?>'s Specials</h2> <!-- using PHP to echo a textual representation of the current week-day-->
				<?php
				/*~~~~~~~~~~~~~~New Array of Menu Items~~~~~~~~~~~~~~*/
				$items = array(); //We will store our menu items in an array called items.
						
				$i = 0; //Let's create an index and start it at 0.
				while ($i < 4){ //We want to create 4 items, so we will loop the following code from i=0 until i=3 (4 times).
					if($i%2!=0){ // using modulo (%) to determine if $i is not even.
						$items["$i"] = new menuitem("WP Kebobs".str_repeat("*", $i+1).($i+1),"Tender cuts of beef and chicken, served with your choice of side","$17"); 
						//At index 'i' of the array 'items', add a new object/class of menuitem. Using str_repeat method to repeat amount of asterisks (*).
					}
					if($i%2==0){ // using modulo (%) to determine if $i is even.
						$items["$i"] = new menuitem("The WP Burger".str_repeat("*", $i+1).($i+1),"Freshly made all-beef patty served up with homefries","$14");
						//At index 'i' of the array 'items', add a new object/class of menuitem. Using str_repeat method to repeat amount of asterisks (*).
					}
					$i++; //end of each loop, add 1 to $i.
				}
				/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
				/*~~~~~~~~~~~~~~Echoing the Array of Menu Items~~~~~~~~~~~~~~*/				
				foreach($items as $item){ //for each object in the $items array, we will cast it as the element $item.
					if(strstr($item->getItemName(), 'Burger')){ //using strstr method to determine if name contains "Burger".
						echo "<img src='images/burger_small.jpg' alt='Burger' title=\"Monday's Special - Burger\"/>"; //if true, display burger image.
					}
					if(strstr($item->getItemName(), 'Kebob')){ //using strstr method to determine if name contains "Kebob".
						echo "<img src='images/kebobs.jpg' alt='Kebobs' title='WP Kebobs'/>"; // if true, display kebob image.
					}
					
					echo "<h3>".$item->getItemName()."</h3>"; //display item name, wrapped in <h3> tag. We call on the getItemName() method.
					echo "<p>".$item->getDescription()." - ".$item->getPrice()."</br>"."</p>"; //display description, wrapped in <p> tag. We call on the getDescription() method.
					echo "<hr>"; //display a line
				}
				/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
				?>	
			</aside>
					
			<div class="main">
				<h1>Welcome</h1>
				<img src="images/dining_room.jpg" alt="Dining Room" title="The WP Eatery Dining Room" class="content_pic">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
				<h2>Book your Christmas Party!</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
			</div><!-- End Main -->
		</div><!-- End Content -->
	<footer>
		<?php include 'footer.php' ?>
	</footer>
	</div><!-- End Wrapper -->
	</body>
</html>
