<?php

$refresh = $_GET[r]; if (!$refresh || $refresh==0) { $refresh = 30; } 
$limit   = $_GET[l]; if (!$limit || $limit==0)     { $limit = 5; } 
$size    = $_GET[z]; if (!$size || $size==0)       { $size = 22; }

$display='g';

require_once '_function.php';

?>

<?php html_header('Info (2in1)',$display,$size,$refresh,$limit); ?>

<?php html_pagehead($display); ?>

<div id="main_dis">
	<div class="dep">
	<h2>Departure <small>Keberangkatan</small></h2>
	<div class="in"></div>
	</div>
	<div class="arr">
	<h2>Arrival <small>Kedatangan</small></h2>
	<div class="in"></div>
	</div>
</div>

<?php html_footer($display,$size,$refresh,$limit); ?>
