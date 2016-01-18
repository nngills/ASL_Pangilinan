<main>
<div>
    <article id="recipe">
        <section id="title">
            <h2> <? echo ucwords(str_replace("_"," ",$item_name)); ?> </h2>
            <? echo "<img src='assets/images/items/$item_name.png'>" ?>
        </section>
        <section id="materials">
            <h3>Materials:</h3>
            <!--<span>Number of material</span>-->
            <!--<img src="images/items/$material">-->
        </section>
    </article>