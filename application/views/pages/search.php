<ul>
<?

	if(!empty($search_results)){
		//outputs matched items
		foreach($search_results as $row){
			echo '<li title="'.ucwords(str_replace("_", " ", $row->itemsName)).'"><a href="index.php?id='.$row->itemsName.'&version='.$version.'"><img src="assets/images/items/'.$row->itemsName.'.png"></a></li>';	
		}
	}else{
		echo "No results :(";	
	}
?>
</ul>