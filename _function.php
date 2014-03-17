<?php

setlocale (LC_ALL, "id_ID.utf8");

function page_end() {?>
<script type="text/javascript" src="fids-mod-jquery.js"></script>
<?php }

function header_opmain($t) {?>
<!DOCTYPE html>
<html>
<head>
<link type="text/css" rel="stylesheet" media="screen" href="css/reset.css" />
<link type="text/css" rel="stylesheet" media="screen" href="css/font-awesome.css" />
<link type="text/css" rel="stylesheet" media="screen" href="style-op.css" />
<link type="text/css" rel="stylesheet" media="screen" href="js/jquery.datetimepicker.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>FIDS-Operator: <?php echo $t; ?></title>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="op-jquery.js?"></script>
</head>
<body data-table="<?php echo $t; ?>">
<? }


function li_airline($flight,$alname,$alcode) {

	$cont = "";

	$css_flight = strtolower($flight);
	$css_flight = "code_".preg_replace("/([a-z])|\s/i", "", $css_flight);

	if (file_exists("pic/al/$alcode.png")) { $cont =  "<span class='alcode i_".$row['alcode']."'></span>"; }
	else {  $cont = $alname;  }

	$str = "<li class='c3 unw airline'><span class='acode $css_flight'>$flight</span>$cont</li>";
	return $str;
}

function html_header($title="fids",$display="x",$size=24,$refresh=30,$limit=10) { ?>
<!DOCTYPE html>
<html>
<head>
<link type="text/css" rel="stylesheet" media="screen" href="css/reset.css" />
<?php html_css($size); ?>
<link type="text/css" rel="stylesheet" media="screen" href="style-fids.css" />
<link type="text/css" rel="stylesheet" media="screen" href="al-logo.css" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="UTF-8">
<?php 
if (($display == "a") || ($display == "d")) { $url = "fids.php?l=$limit&r=$refresh&z=$size&d=$display"; }
if ($display  == "g")  { $url = "gate.php?l=$limit&r=$refresh&z=$size&d=g"; } 
if ($display  == "x")  { $url = "simul.php?l=$limit&r=$refresh&z=$size&d=x"; }
?><meta http-equiv="refresh" content="10800;url=<?php echo $url; ?>" />
<title><?php echo $title; ?></title>
</head>
<body id="<?php echo $display;?>" >
<?php }

function html_css($size) { ?><style type="text/css"><!--
body { font-size: <?php echo $size; ?>px; line-height: <?php echo 2*$size; ?>px; }
#g #aa .hline,.hline { height: <?php echo $size*2; ?>px; line-height: <?php echo $size; ?>px; }
#g .hline { line-height: <?php echo $size; ?>px; height: <?php echo $size; ?>px;  }
li.line, li.line li {  height: <?php echo $size*2; ?>px; line-height: <?php echo $size*2; ?>px;line-height: <?php echo $size*2; ?>px; }
#g li.line, #g li.line li {  height: <?php echo $size*1.6; ?>px; line-height: <?php echo $size*1.6; ?>px;  }
ul > li > ul > li { float: left; display: inline-block;  }
ul > li > ul { clear: both; }
--></style><?php }

function html_pagehead($d) {
//$tgl = date('D, d M Y');
$tgl = strftime("%A, %d %h %G",time());
if ($d == "a") { ?>
<div id="ph" class="ph arrival">
	<span class="id"></span>
	<h1>Arrival</h1>
	<div class="wkt hline">
	<span id='jam' class="clock jclock_eit">--:--:--</span><br/>
	<span class='tgl'><?php echo $tgl; ?></span>
	</div>
</div>
<?php } else if ($d == "d") { ?>
<div id="ph" class="ph departure">
        <span class="id"></span>
        <h1>Departure</h1>
        <div class="wkt hline">
        <span id='jam' class="clock jclock_eit">--:--:--</span><br/>
        <span class='tgl'><?php echo $tgl; ?></span>
        </div>
</div>
<?php } else { ?>
<div id="ph" class="ph gate is_<?php echo $d; ?>">
        <span class="id"></span>
        <h1 class="unw">Bandara Frans Kaisiepo Biak</h1>
        <div class="wkt hline">
        <span id='jam' class="clock jclock_eit">--:--:--</span><br/>
        <span class='tgl'><?php echo $tgl; ?></span>
        </div>
</div>
<?php }

}

function html_footer($display="a",$size=24,$refresh=30,$limit=10) { 
    $a_url = "aripal.php?l=$limit&z=$size&r=$refresh";
    $d_url = "defatur.php?l=$limit&z=$size&r=$refresh";
    if ($display == "a")      { $url = $a_url; $single=1; }
    else if ($display == "d") { $url = $d_url; $single=1; }
    else if ($display == "x") { $single=2; }
    else { $url = ''; $single =0; }

?>
<script type="text/javascript" src="fids-jquery.js"></script>
<script type="text/javascript"><?php
    if ($single ==1) { ?>
	var sec = <?php echo $refresh; ?>;
	var url = '<?php echo $url; ?>';
	$('#main_dis').load(url);
	setInterval( function() { $('#main_dis').load(url) }, sec * 1000  );
<?php } else if ($single==2) {?>
	split_screen();
        var sec = <?php echo $refresh/2; ?>;
        var a_url = '<?php echo $a_url; ?>';
        var d_url = '<?php echo $d_url; ?>';

	// Simultan - Init
        $('#main_dis .in').load(d_url);
	$('#main_dis h2').html('Departure <small>Keberangkatan</small>');
	$('#main_dis').data('display',"d");

	var dnw="d";

        setInterval( function() {

	// var dnw = $('#main_dis').data('display');
        // console.log('now:'+dnw);

	if (dnw=="d") { 
		$('#main_dis #aa').removeClass('dep');
		$('#main_dis #aa').addClass('arr');
		$('#main_dis .in').load(a_url);
                $('#main_dis h2').html('Arrival <small>Kedatangan</small>');
		dnw = "a";
	} else {  
		$('#main_dis #aa').removeClass('arr');
		$('#main_dis #aa').addClass('dep');
                $('#main_dis .in').load(d_url);
		$('#main_dis h2').html('Departure <small>Keberangkatan</small>');
                dnw = "d";
	}

	}, sec * 1000 );

<?php } else { ?>
	split_screen();
	var sec = <?php echo $refresh; ?>;
	var a_url = '<?php echo $a_url; ?>';
	var d_url = '<?php echo $d_url; ?>';
	$('#main_dis .dep .in').load(d_url);
	$('#main_dis .arr .in').load(a_url);
	setInterval( function() { $('#main_dis .dep .in').load(d_url) }, sec * 1000  );
	setInterval( function() { $('#main_dis .arr .in').load(a_url) }, sec * 1300  );
	$(window).resize( function() {	split_screen(); } )
<?php } ?>
</script>
<script type="text/javascript" src="js/jclock.js"></script>
<script type="text/javascript">
	var options_eit = {utc: true, utc_offset: 9}
	$('.jclock_eit').jclock(options_eit);
</script>
<?php page_end() ; ?>
</body>
</html>

<?php } ?>
