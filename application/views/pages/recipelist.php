<section id="recipe_list">
	<?  
	foreach($ablerecipes as $row){
		echo $row['itemsName'];
		$count = count($row)-2;
		for($x = 0; $x<=$count; $x++){
			echo $row[$x]['material'];
			echo $row[$x]['quantity'];
		}
		echo "<br/><br/>";
	}
	?>
</section>