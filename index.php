<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Don't Starve Items</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
	<h1>Don't Starve Items</h1>
    
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
    
    <main>
    	<article id="top">
        </article>
        
        <section id="itemlist">
        	
        </section>
    </main>
    
    <? 
	
	/*
	<article id="{$row['tabName']}">
		<h2>{$row['tabName']}</h2>
		<ul>
			<li><img></li>
			<li><img></li>
		</ul>
	</article>
	*/
	
	foreach($tabResult as $row){
		echo "
			<article id='{$row['tabName']}'>
				<h2>{$row['tabName']}</h2>
				<ul>";
		foreach($craft_items_result as $items_row){
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
    
    <!--JAVASCRIPT-->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
