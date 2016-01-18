<section id="itemlist">
<?php
	//Gets tab names
	$query = $this->db->query('select tabName from tabs order by id');
	
	//gets craftable item list
    $items_query = $this->db->query('
        select items.itemsName, tabs.tabName from craftable_items
        join items on items.id = craftable_items.itemId
        join tabs on tabs.id = craftable_items.tab
        order by tabs.id;
    ');
    /*
    <article id="{$row['tabName']}">
        <h2>{$row['tabName']}</h2>
        <ul>
            <li><img src="images/items/$itemName.png"></li>
        </ul>
    </article>
    */
    
    //POPULATES THE ITEM LIST WITH THE APPROPRIATE TAB NAMES AND ITEMS
    //Follows the above template
    //Loops through the tabNames in the database and outputs into HTML
    foreach($query->result() as $row){
        echo "
            <article id='{$row->tabName}'>
                <h2>{$row->tabName}</h2>
                <ul>";
        foreach($items_query->result() as $items_row){
            //Loops through the items in the database
            //matches the itemName to the appropriate tabName and outputs the image into HTML
            if($items_row->tabName == $row->tabName){
                $itemName = $items_row->itemsName;
                echo '<li><a href="index.php?id='.$itemName.'"><img src="assets/images/items/'.$itemName.'.png"></a></li>';
            }
        }
                
        echo	"</ul>
            </article>
            ";
    }
?>
</section>
</div>
</main>
