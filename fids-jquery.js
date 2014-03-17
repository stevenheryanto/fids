function split_screen() {	
//	h = Math.round( $('html').height()-$('#ph').height()) /2 ;
//	$('#main_dis div.dep').css('min-height',h+"px");
	$('#main_dis div.dep').css('margin-bottom',"2em");
	w = $('#ph h1').width();
	$('#ph span.id').css('left',(20+w)+"px");
}



$(document).ready(function(){

$('html').dblclick(function() {
	$('html').css('cursor', 'crosshair');
});

});

