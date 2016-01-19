<main>
<div>
    <article id="recipe">
        <section id="title">
            <h2> <? echo ucwords(str_replace("_"," ",$item_name)); ?> </h2>
            <? echo '<img src="assets/images/items/'.$item_name.'.png">' ?>
        </section>
        <section id="materials">
            <h3>Materials:</h3>
            <?
			
			//get materials for item from database
        	$query = $this->db->query('
			select quantity, items.itemsName as material from materials
			join items
			on material = items.id
			where craftableid = (select id from items where itemsName = "'.$item_name.'")');
			
			//outputs material into html
            //<span>Number of material</span>
            //<img src="images/items/$material">
			foreach($query->result() as $row){
				echo "<span>".$row->quantity."</span>";
				echo '<img src="assets/images/items/'.$row->material.'.png">';
			}
            ?>
        </section>
    </article>