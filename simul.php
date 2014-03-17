<?php

$refresh = $_GET[r]; if (!$refresh || $refresh==0) { $refresh = 30; } 
$limit   = $_GET[l]; if (!$limit || $limit==0)     { $limit = 9; } 
$size    = $_GET[z]; if (!$size || $size==0)       { $size = 22; }

$display='x';

require_once '_function.php';

?>

<?php html_header('Info (1on1)',"x",$size,$refresh,$limit,$simul); ?>

<?php html_pagehead("x"); ?>

<div id="main_dis" class="simultan">
	<div id="aa" class="dep">
	<h2>Wait...</h2>
	<div class="in"></div>
	</div>
</div>

<?php html_footer($display,$size,$refresh,$limit); ?>
