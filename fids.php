<?php

$display = @$_GET[d]; if ($display=="a") { $display = "a"; } else { $display="d"; }
$refresh = @$_GET[r]; if (!$refresh || $refresh==0) { $refresh = 30; } 
$limit   = @$_GET[l]; if (!$limit || $limit==0)     { $limit = 12; } 
$size    = @$_GET[z]; if (!$size || $size==0)       { $size = 24; }

if ($display == "a") { $title= "Arrival"; } else { $title="Departure"; }

require_once '_function.php';

?>

<?php html_header($title,$display,$size,$refresh,$limit); ?>

<?php html_pagehead($display); ?>

<div id="main_dis"></div>

<?php html_footer($display,$size,$refresh,$limit); ?>
