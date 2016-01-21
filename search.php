<ul>
<?
	if(isset($_GET['search_query'])){
		
		//Stores t
		$search_query = $_GET['search_query'];
		
		//SETUP username, password, and establish PDO and DSN connection to database
    	$user='root';
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=DontStarveItems;port=8889', $user, $pass);
		
		//gets items from the database to match the search query
		$stmt = $dbh->prepare('
			select itemsName from craftable_items
			join items
			on items.id = craftable_items.itemId
			where itemsName like "%'.$search_query.'%"
		');
		$stmt->execute();
		$query = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		//Checks if search field is empty
		if(!empty($search_query)){
			//outputs matched items
			foreach($query as $row){
				echo '<li title="'.ucwords(str_replace("_", " ", $row['itemsName'])).'"><a href="index.php?id='.$row['itemsName'].'"><img src="assets/images/items/'.$row['itemsName'].'.png"></a></li>';	
		}
		
			//
		}
	}
?>
</ul>