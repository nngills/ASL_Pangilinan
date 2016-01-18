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
				echo "<li><a href='#{$row['tabName']}'><img src='assets/images/tabs/{$row['tabName']}.png'></a></li>";
			}
        ?>
        </ul>
    </nav>
    