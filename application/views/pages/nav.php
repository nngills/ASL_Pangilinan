<nav>
    <ul>
    <?php
        /*<li><a href="#$tabName"><img src="images/tabs/$tabName"></a></li>*/
        
        $query = $this->db->query('select tabName from tabs order by id');
        
        //POPULATE NAV WITH TAB IMAGES AND A HREF TO QUICK SCROLL 
        //follows the above template
        foreach($query->result() as $row){
            //loops through the tabnames in the database
            //outputs an href referring to the tab in the list
            //also outputs the icon for the tab
            echo "<li><a href='#{$row->tabName}'><img src='assets/images/tabs/{$row->tabName}.png'></a></li>";
        }
    ?>
    </ul>
</nav>