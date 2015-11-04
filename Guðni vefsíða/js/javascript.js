$(document).ready(function(){

	$(".notification").click(function(){
        $(".notification").fadeOut("fast");
    });
    if ($(".notification").text().length > 1) {
    	$(".notification").css("padding", "1em");
    	console.log($(".notification").text().length);
    };
});