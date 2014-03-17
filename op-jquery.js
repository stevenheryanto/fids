$(function() {
    $( "#schedpicker" ).datetimepicker({
    format: 'Y-m-d H:i',
    step: 5
   });
});

function allowDrop(ev){
    ev.preventDefault();
}

function drag(ev){
	ev.dataTransfer.effectAllowed='move';
	ev.dataTransfer.setData("Text",ev.target.id);
}

function drop(ev){
	ev.preventDefault();
	var id=ev.dataTransfer.getData("Text");
	var table=$('body').data('table');
	ev.target.appendChild(document.getElementById(id));
	$.ajax({
		type: "POST",
		url: "op-delete.php",
		data: {"id": id, "table": table},
		dataType: "text",
		success:function(data) {

			if(data) {
				alert("Data has been deleted");
/*			} else {
				alert("Delete fail, please try again later");
			}
*/
	}}
	});
}

/* op functions */

function editabox(res) {
	if ($('#edita').data("open")!=1) {
		$('#edita').load(res);
		$('#edita').data("open",1);
	} else {
		var c = editabox_close();
		$('#edita').data("open",c);
	}
}

function editabox_close() {
	$('#edita').empty();
	$('#edita').data("open",0);
	return 0;
}

function leadzero(n) {
	console.log(n)
	if (n <= 9) { n.toString(); m = "0"+n; }
	else { m = n.toString(); }
	return m;
}

function make_jambaru() {

//      format: 'Y-m-d H:i',
	var d = new Date();
	var jama = d.getFullYear()+"-"+
		   leadzero(d.getMonth()+1)+"-"+
 		   leadzero(d.getDate())+" "+
		   leadzero(d.getHours())+":"+
		   leadzero(d.getMinutes());
	return jama
}

$(document).ready(function(){

$('#table a.edit').click( function(e) {
	e.preventDefault();
	var res = $(this).attr('href');
	var tgl = $('form.tglgo .input').val();
	$('#edita').load(res);
});

$('a.newrec').click( function(e) {
	e.preventDefault();
	editabox($(this).attr('href'));
});

$('#edita a.close').click( function(e) {
	e.preventDefault();
	var c = editabox_close();
    	$('#edita').data("open",c);
});

$('#table a.announce').click( function(e) {
	e.preventDefault();
    	var res = $(this).attr('href');
	if (res=="#") { return false; }
	$('#speak').load(res);
});

$("li.Scheduled a.announce").attr("href","#");

$('select.sts').change(function() {
	var value = $("select.sts option:selected").val();
	if (value!=9) {
		var jambaru = make_jambaru(); 
		$("#schedpicker").val(jambaru); 
	}
});

$("select.al").change(function() {
	var value = $("select.al option:selected").val();
	if (value=="0") { value = "" }
	if (value=="TR") { value = "TR 000" } 
	else { value = value+ " " }
	$("input.fl").val(value);

/*
	$("#edita input.button").attr("disabled",false)	
*/

});



});
