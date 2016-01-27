<main>
<div>
    <article id="recipe">
        <section id="title">
            <h2> <?
			//outputs Item Title
			echo ucwords(str_replace("_"," ",$item_name)); ?> </h2>
            <? 
			//outputs item icon
			echo '<img src="assets/images/items/'.$item_name.'.png">' ?>
        </section>
        <section id="materials">
            <h3>Materials:</h3>
            <?
			
			//outputs material into html
            //<span>Number of material</span>
            //<img src="images/items/$material">
			foreach($mats as $row){
				echo '<a href="index.php?id='.$row->material.'&version='.$version.'" class="mats" title="'.ucwords(str_replace("_", " ", $row->material)).'"><span class="outline"> '.$row->quantity.'</span>';
				echo '<img src="assets/images/items/'.$row->material.'.png" ></a>';
			}
            ?>
        </section>
    </article>