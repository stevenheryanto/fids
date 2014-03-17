<?php
$refresh = @$_GET[r]; if (!$refresh or $refresh==0) { $refresh = 15; }
$limit   = @$_GET[l]; if (!$limit or $limit==0) { $limit = 11; }
$size    = @$_GET[z]; if (!$size or $size==0) { $size = 24; }
$request = @$_GET[q]; if (!$request) { $request = "a"; }
$timed   = @$_GET[t]; if (!$timed) { $timed = 2; }

require_once 'lib/meekrodb.2.1.class.php';
require_once '_function.php';
require_once '_data-con.php';

if ($timed==2) {

if ($request=="a") { jsoning ( db_arrival_timed($limit) ); }
              else { jsoning ( db_departure_timed($limit) ); }

} else {

if ($request=="a") { jsoning ( db_arrival_timed($limit) ); }
              else { jsoning ( db_departure_timed($limit) ); }

}

?>
