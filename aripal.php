<?php
$refresh = @$_GET[r]; if (!$refresh or $refresh==0) { $refresh = 15; }
$limit   = @$_GET[l]; if (!$limit or $limit==0) { $limit = 11; }
$size    = @$_GET[z]; if (!$size or $size==0) { $size = 24; }

require_once 'lib/meekrodb.2.1.class.php';
require_once '_function.php';

$results = DB::query("SELECT id, airportvia.cityvia, airport.city, flight, airlines.alname, airlines.alcode, schedarrival, termgate, statuss.sname, statuss.scode
	FROM airport, airlines, arrival, statuss, airportvia
	WHERE airport.apcode = arrival.origin
	AND airportvia.apcode = arrival.via
	AND airlines.alcode = arrival.airline
	AND schedarrival BETWEEN NOW() - INTERVAL 10 MINUTE AND NOW() + INTERVAL 12 HOUR
	AND statuss.scode = arrival.status
	AND status != 9
	ORDER BY schedarrival ASC LIMIT %i", $limit);

echo "<ul id='tab_read2' class='tab arival'>";
echo "<li class='head hline'>";
echo "<ul>".
	"<li class='c1 unw'>Origin<br/><i>Dari</i></li>".
	"<li class='c2 unw'>Via<br/><i>Melalui</i></li>".
//	"<li class='c2 no'>Flight No<br/><i>No</i></li>".
	"<li class='c3 airline'><span class='fix'>Airline<br/><i>Penerbangan</i></span></li>".
	"<li class='c4 hi'>Time<br/><i>Waktu</i></li>".
	"<li class='c5 lo'>Gate<br/><i>Pintu</i></li>".
	"<li class='c6 st'>Status<br/><i>&nbsp;</i></li>".
"</ul>";
echo "</li>\n";

foreach($results as $row) {
	$sd = date('H:i', strtotime($row['schedarrival']));
	echo "<li class='line st".$row['scode']."' >";
	echo "<ul>".
		"<li class='c1 unw'>".$row['city']."&nbsp;</li>".
		"<li class='c2 unw'>".$row['cityvia']."&nbsp;</li>";
		echo li_airline($row['flight'],$row['alname'],$row['alcode']);
		echo "<li class='c4 hi unw'>".$sd."</li>".
		"<li class='c5 lo'>".$row['termgate']."</li>".
		"<li class='c6 st unw'>".$row['sname']."&nbsp;</li>".
	"</ul>";
	echo "</li>\n";
	}

	echo "</ul>";

page_end();

?>
