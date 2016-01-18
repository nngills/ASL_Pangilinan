$(function(){ //JQUERY WRAPPER

console.log("Hello! The Javascript & Jquery works!");

//Adds icon next to item list article titles
elem = $("#itemlist article h2");
for(a = 0, b = elem.length; a < b; a++){	
	elemValue = $(elem[a]).text().replace(/\ /g, "_");
	$(elem[a]).css({
		"background-image": "url(assets/images/tabs/"+elemValue+".png)",
		"background-repeat": "no-repeat",
		"background-size": "contain",
		"padding": "10px 10px 10px 55px"
	})
}

//smooth scrolling
$('a[href^="#"]').on('click', function(e) {
	e.preventDefault();
	var target = this.hash;
	var $target = $(target);
	$('html, body').stop().animate({
		'scrollTop': $target.offset().top
	}, 500, 'swing', function () {
		window.location.hash = target;
	});
});

//get itemname from clicked item
$("#itemlist li img").click(function(){
	//recipe = $(this).attr("id");
	//console.log(recipe)
});

}); //JQUERY WRAPPER END
