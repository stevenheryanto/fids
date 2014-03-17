<?php

$refresh = @$_GET[r]; if (!$refresh or $refresh==0) { $refresh = 15; }
$limit   = @$_GET[l]; if (!$limit or $limit==0) { $limit = 11; }
$size    = @$_GET[z]; if (!$size or $size==0) { $size = 30; }
$display = @$_GET[d]; if (!$display) { $display = "d"; }
$timed   = @$_GET[t]; if (!$timed) { $timed=2; } else { $timed=1; }

if ( ($display == "d") || ($display == "a") ) { $request = $display; }

require_once '__function.php';

?><!DOCTYPE html>

<html>
<head>
<link type="text/css" rel="stylesheet" media="screen" href="css/reset.css" />
<link type="text/css" rel="stylesheet" media="screen" href="css/font-awesome.css" />
<link type="text/css" rel="stylesheet" media="screen" href="/font/share/style.css" />
<link type="text/css" rel="stylesheet" media="screen" href="css/animations.css" />
<link type="text/css" rel="stylesheet" media="screen" href="ax/style.css" />
<link type="text/css" rel="stylesheet" media="screen" href="ax/airline.css" />
<link type="text/css" rel="stylesheet" media="screen" href="ax/gate.css" />
<style><?php css_typeset($size); ?></style>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<title>Info</title>
</head>
<body id="gate"> 

<?php frame_header("gate","g"); ?>

<ol id="template">

<li class='head_a'><ul>
<li class="airline"><b>Airline</b><i>Penerbangan</i></li>
<li class="city"><b>Origin</b><i>Dari</i></li>
<li class="time"><b>Time</b><i>Waktu</i></li>
<li class="status"><b>Status</b><i>&nbsp;</i></li>
</ul></li>

<li class='head_d'><ul>
<li class="airline"><b>Airline</b><i>Penerbangan</i></li>
<li class="city"><b>Destination</b><i>Tujuan</i></li>
<li class="time"><b>Time</b><i>Waktu</i></li>
<li class="status"><b>Status</b><i>&nbsp;</i></li>
</ul></li>


<li class='line'><ul id="a_%id%" class="st_%scode%">
<li class="airline unw %aircss%"><span class="al_logo al_%alcode%"></span><b>%flight%</b><i>%alname%</i></li>
<li class="city unw"><b>%city%</b> <i>%cityvia%</i></li>
<li class="time unw">%schedarrival-time% %scheddeparture-time%</li>
<li class="status unw">%sname%</li>
</ul></li>

</ol>

<ol class="display" id="fids_a"></ol>
<ol class="display" id="fids_d"></ol>

<script type="text/javascript" src="js/jclock.js"></script>
<script type="text/javascript" src="ax/ax.js"></script>

<script type="text/javascript">

$(document).ready(function(){
	$.ajaxSetup({ cache: false });
	clock_start();
	gate_display(<?php echo $timed; ?>, <?php echo $limit; ?>); 
	setInterval (function() { gate_display(<?php echo $timed; ?>, <?php echo $limit; ?>); }, <?php echo $refresh ?>*1000 ) 

	setInterval( function() { location.reload(false); }, 1000 * 3600 * 3 );

});

</script>

</body>
</html>
