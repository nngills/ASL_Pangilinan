<section id="itemlist">
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
    
    //get craftable items and tabs
    $stmt = $dbh->prepare('
        select items.itemsName, tabs.tabName from craftable_items
        join items on items.id = craftable_items.itemId
        join tabs on tabs.id = craftable_items.tab
        order by tabs.id;
    ');
    $stmt->execute();
    $craft_items_result = $stmt->fetchall(PDO::FETCH_ASSOC);	

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
    foreach($tabResult as $row){
        echo "
            <article id='{$row['tabName']}'>
                <h2>{$row['tabName']}</h2>
                <ul>";
        foreach($craft_items_result as $items_row){
            //Loops through the items in the database
            //matches the itemName to the appropriate tabName and outputs the image into HTML
            if($items_row['tabName'] == $row['tabName']){
                $itemName = $items_row['itemsName'];
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
