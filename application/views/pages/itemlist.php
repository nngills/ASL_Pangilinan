<section id="itemlist">
<?php
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
    foreach($tabs as $row){
        echo "
            <article id='{$row->tabName}'>
                <h2>{$row->tabName}</h2>
                <ul>";
        foreach($craft_items as $items_row){
            //Loops through the items in the database
            //matches the itemName to the appropriate tabName and outputs the image into HTML
			//outputs a GET into the URL
            if($items_row->tabName == $row->tabName){
                $itemName = $items_row->itemsName;
                echo '<li title="'.ucwords(str_replace("_", " ", $itemName)).'"><a href="index.php?id='.$itemName.'&version='.$version.'"><img src="assets/images/items/'.$itemName.'.png"></a></li>';
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
