<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Don't Starve Items</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
	<header>
		<h1>Don't Starve Items</h1>
    </header>
    
    <?php
		//SETUP username, password, and establish PDO and DSN connection to database
    	$user='root';
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=DontStarveItems;port=8889', $user, $pass);
		
		//get Craftable TabNames
		$stmt = $dbh->prepare('
			select tabName from tabs
			order by id;
		');
		$stmt->execute();
		$tabResult = $stmt->fetchall(PDO::FETCH_ASSOC);	
		
		//get craftable items and tabs
		$stmt = $dbh->prepare('
			select items.itemsName, tabs.tabName from craftable_items
			join items on items.id = craftable_items.itemId
			join tabs on tabs.id = craftable_items.tab
			order by tabs.id;
		');
		$stmt->execute();
		$craft_items_result = $stmt->fetchall(PDO::FETCH_ASSOC);	
	?>
    <nav>
    	<ul>
		<?php
			/*<li><a href="#$tabName"><img src="images/tabs/$tabName"></a></li>*/
			
			//POPULATE NAV WITH TAB IMAGES AND A HREF TO QUICK SCROLL 
			//follows the above template
        	foreach($tabResult as $row){
				//loops through the tabnames in the database
				//outputs an href referring to the tab in the list
				//also outputs the icon for the tab
				echo "<li><a href='#{$row['tabName']}'><img src='images/tabs/{$row['tabName']}.png'></a></li>";
			}
        ?>
        </ul>
    </nav>
    
    <main>
    <div>
    	<article id="top">
			<section id="title">
				<h2>$ItemName</h2>
                <!--<img src="images/items/$itemName">-->
			</section>
            <section id="materials">
            	<h3>Materials:</h3>
            	<!--<span>Number of material</span>-->
                <!--<img src="images/items/$material">-->
            </section>
        </article>
        
        <section id="itemlist">
        <?php
			/*
			<article id="{$row['tabName']}">
				<h2>{$row['tabName']}</h2>
				<ul>
					<li><img src="images/items/$itemName.png"></li>
				</ul>
			</article>
			*/
			
			//POPULATES THE ITEM LIST WITH THE APPROPRIATE TAB NAMES AND ITEMS
			//Follows the above template
			//Loops through the tabNames in the database and outputs into HTML
			foreach($tabResult as $row){
				echo "
					<article id='{$row['tabName']}'>
						<h2>{$row['tabName']}</h2>
						<ul>";
				foreach($craft_items_result as $items_row){
					//Loops through the items in the database
					//matches the itemName to the appropriate tabName and outputs the image into HTML
					if($items_row['tabName'] == $row['tabName']){
						$itemName = $items_row['itemsName'];
						echo '<li><img src="images/items/'.$itemName.'.png"></li>';
					}
				}
						
				echo	"</ul>
					</article>
					";
			}
		?>
        </section>
        </div>
    </main>
    
    <!--JAVASCRIPT-->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
