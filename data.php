<?php

$refresh = @$_GET[r]; if (!$refresh or $refresh==0) { $refresh = 15; }
$limit   = @$_GET[l]; if (!$limit or $limit==0) { $limit = 11; }
$size    = @$_GET[z]; if (!$size or $size==0) { $size = 32; }
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
<link type="text/css" rel="stylesheet" media="screen" href="ax/fids.css" />
<link type="text/css" rel="stylesheet" media="screen" href="ax/airline.css" />
<style><?php css_typeset($size); ?></style>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<title>FIDS:<?php echo $display;?></title>
</head>
<body class="<?php echo $display;?>"> 

<?php frame_header("dis",$display); ?>

<ol id="template">

<li class='head'><ul>
<li class="airline"><b>Airline</b><i>Penerbangan</i></li>
<?php
	if($display == "d"){
		echo "<li class='city'><b>Destination</b><i>Tujuan</i></li>";
	}else{
		echo "<li class='city'><b>Origin</b><i>Dari</i></li>";
	}
?>
<li class="time"><b>Time</b><i>Waktu</i></li>
<li class="gate"><b>Gate</b><i>Pintu</i></li>
<li class="status"><b>Status</b><i>&nbsp;</i></li>
</ul></li>

<li class='line'><ul id="a_%id%" class="st_%scode%">
<li class="airline unw %aircss%"><span class="al_logo al_%alcode%"></span><b>%flight%</b> <i>%alname%</i></li>
<li class="city unw"><b>%city%</b> <i>%cityvia%</i></li>
<li class="time unw">%schedarrival-time% %scheddeparture-time%</li>
<li class="gate unw"><div class="gate_">%termgate%</div></li>
<li class="status unw">%sname%</li>
</ul></li>

</ol>

<ol class="display" id="fids_<?php echo $display; ?>"></ol>

<script type="text/javascript" src="js/jclock.js"></script>
<script type="text/javascript" src="ax/ax.js"></script>

<script type="text/javascript">

$(document).ready(function(){
	 $.ajaxSetup({ cache: false });
	clock_start();
	data_display("<?php echo $request; ?>", <?php echo $timed; ?>, <?php echo $limit; ?>); 
	setInterval (function() { data_display( "<?php echo $request; ?>", <?php echo $timed; ?>, <?php echo $limit; ?>); }, <?php echo $refresh ?>*1000 ) 

 	setInterval( function() { location.reload(false); }, 1000 * 3600 * 3 );

});

</script>

</body>
</html>
