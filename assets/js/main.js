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

//apply outline fn
applyOutline = function(elem, value){
	$(elem).before("<span>"+value+"</span>");
	$(elem).prev().css({
		"position": "absolute",
		"-webkit-text-stroke": "4px black"
	});	
}

//adds outline to the material numbers
elem = $(".outline");
for(i=0, j=elem.length; i<j; i++){
	value = $(elem[i]).text();
	applyOutline(elem[i], value);
}

//DISABLE FORM ENTER
$("form").bind("keypress", function(e) {
	if (e.keyCode == 13) {
		return false;
	}
});

//SHOW AND HIDE RECIPE LIST
elem = $("#recipe_list p").click(function(){
	if($('#recipe_list ul').is(":visible")){
		$('#recipe_list ul').hide(300);
		$("#recipe_list p").text("View recipes that use this item");
	}else{
		$('#recipe_list ul').show(300);
		$("#recipe_list p").text("Show less");
	}
});

//allows jquery to retrieve the GET
var $_GET = {};

document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
        return decodeURIComponent(s.split("+").join(" "));
    }

    $_GET[decode(arguments[1])] = decode(arguments[2]);
});

//SEARCH FUNCTION
//everytime a character is inputed
//js sends search query into search.php
//and pushes the results into HTML
$("input").keyup(function(){
	var input_value = this.value;
	
	$.ajax({
		url: 'index.php/Pages/search',
		data: {'search_query': this.value, 'version': $_GET['version']},
		type: "GET",
		success: function(data){
			if(input_value.length > 0){
				$("#search_results").show().html(data)
				$("#itemlist").hide();
			}else{
				$("#search_results").hide().html(data)
				$("#itemlist").show();
			}
		}
	})
	
})

}); //JQUERY WRAPPER END