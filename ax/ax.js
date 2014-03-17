// var newstr = str.replace("apples", "oranges", "gi");

function edtime(w) {
	return w.substr(10,6);
}

function db_parsing(data) {
		var text = $('#template li.line').html();
			text = text.replace("%flight%",data['flight'],"gi");
			text = text.replace("%alcode%",data['alcode'].toLowerCase(),"gi");
            text = text.replace("%alname%",data['alname'],"gi");
            text = text.replace("%city%",data['city'],"gi");
            text = text.replace("%id%",data['id'],"gi");
            text = text.replace("%aircss%",data['cssn'],"gi");
		if (data['cityvia']!="") {
			text = text.replace("%cityvia%","<span class='via'>via</span> "+data['cityvia'],"gi");
		} else {
			text = text.replace("%cityvia%",'',"gi");
		}
		if (data['schedarrival'])  { 
			text = text.replace("%schedarrival%",data['schedarrival'],"gi"); 
			text = text.replace("%schedarrival-time%",edtime(data['schedarrival']),"gi"); 
		} else {
			text = text.replace("%schedarrival%","","gi"); 
			text = text.replace("%schedarrival-time%","","gi"); 
		}
		if (data['scheddeparture']){ 
			text = text.replace("%scheddeparture%",data['scheddeparture'],"gi"); 
			text = text.replace("%scheddeparture-time%",edtime(data['scheddeparture']),"gi"); 
		} else { 
			text = text.replace("%scheddeparture%","","gi");
			text = text.replace("%scheddeparture-time%","","gi");
		}
			text = text.replace("%termgate%",data['termgate'],"gi");
			text = text.replace("%scode%",data['scode'],"gi");
			text = text.replace("%sname%",data['sname'],"gi");
		
		return "<li class='line'>"+text+"</li>";
}

function data_display(Q,T,limit) {

	$.getJSON("/json.php?q="+Q+"&t="+T+"l="+limit, function(data) {
        	var i = []; var res = ''
	        $.each(data, function(i,v) { res = res +  db_parsing(data[i]);   });
	        $('ol.display').html( "<li class='head'>" + $('#template li.head').html() +"</li>"+ res);

	});
}


function gate_display(T,limit) {

        $.getJSON("/json.php?q=a&t="+T+"l="+limit, function(data) {
                var i = []; var res = ''
                $.each(data, function(i,v) { res = res +  db_parsing(data[i]);   });
                $('#fids_a').html( "<li><h3>Arrival<small>Kedatangan</small></h3></li><li class='head'>" + $('#template li.head_a').html() +"</li>"+ res);

	});
        
	$.getJSON("/json.php?q=d&t="+T+"l="+limit, function(data) {
                var i = []; var res = ''
                $.each(data, function(i,v) { res = res +  db_parsing(data[i]);   });
                $('#fids_d').html( "<li><h3>Departure<small>Keberangkatan</small></h3></li><li class='head'>" + $('#template li.head_d').html() +"</li>"+ res);


        });
}


function clock_start() {
	var options_eit = {utc: true, utc_offset: 9}
	$('.jclock_eit').jclock(options_eit);
}
