<ul>
<?
	if(isset($_GET['search_query'])){
		
		//Stores t
		$search_query = $_GET['search_query'];
		
		//SETUP username, password, and establish PDO and DSN connection to database
    	$user='root';
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=DontStarveItems;port=8889', $user, $pass);
		
		$stmt = $dbh->prepare('
			select itemsName from craftable_items
			join items
			on items.id = craftable_items.itemId
			where itemsName like "%'.$search_query.'%"
		');
		$stmt->execute();
		$query = $stmt->fetchall(PDO::FETCH_ASSOC);
		
		foreach($query as $row){
			echo '<li><a href="index.php?id='.$row['itemsName'].'"><img src="assets/images/items/'.$row['itemsName'].'.png" title="'.$row['itemsName'].'"></a></li>';
			//
		}
	}
?>
</ul>