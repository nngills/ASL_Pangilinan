<section id="recipe_list">
<p>Recipes that use this item: </p>
	<?  
	foreach($ablerecipes as $row){
		echo "<ul>";
		echo '<li title="'.ucwords(str_replace("_", " ", $row['itemsName'])).'"><a href="index.php?id='.$row['itemsName'].'&version='.$version.'"><img src="assets/images/items/'.$row['itemsName'].'.png"></a></li>';
		$count = count($row)-2;
		echo "<ul>";
		for($x = 0; $x<=$count; $x++){
			echo "<li>";
			echo '<a href="index.php?id='.$row[$x]['material'].'&version='.$version.'" class="mats" title="'.ucwords(str_replace("_", " ", $row[$x]['material'])).'"><span class="outline"> '.$row[$x]['quantity'].'</span>';
			echo '<img src="assets/images/items/'.$row[$x]['material'].'.png" ></a>';
			echo "</li>";
		}
		echo "</ul>";
		echo "</ul>";
	}
	?>
</section>