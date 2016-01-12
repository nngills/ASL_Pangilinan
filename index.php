<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Don't Starve Items</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
	Say pal, you don't look so good. You better find something to eat before night comes!
    <p>If this is red then the CSS works.</p>
    
    <main>
    	<article id="top">
        </article>
        
        <section id="itemlist">
        	
        </section>
    </main>
    
    <?php
		//SETUP username, password, and establish PDO and DSN connection to database
    	$user='root';
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=DontStarveItems;port=8889', $user, $pass);
		
		//get Craftable items and Tabs
		$stmt = $dbh->prepare('
			select items.itemsName, tabs.tabName 
			from craftable_items
			join items
			on craftable_items.itemId = items.id
			join tabs
			on craftable_items.tab = tabs.id
			order by craftable_items.tab;
		');
		$stmt->execute();
		$result = $stmt->fetchall(PDO::FETCH_ASSOC);	
	?>
    
    <pre>
    <? print_r($result) ?>
    </pre>
    
    <!--JAVASCRIPT-->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
