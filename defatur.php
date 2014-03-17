<?php
$refresh = @$_GET[r]; if (!$refresh or $refresh==0) { $refresh = 15; }
$limit   = @$_GET[l]; if (!$limit or $limit==0) { $limit = 11; }
$size    = @$_GET[z]; if (!$size or $size==0) { $size = 24; }

require_once 'lib/meekrodb.2.1.class.php';
require_once '_function.php';

$results = DB::query("SELECT id, airportvia.cityvia, airport.city, flight, airlines.alname, scheddeparture, termgate, statuss.sname, statuss.scode, airlines.alcode
		FROM airportvia, airport, airlines, departure, statuss
		WHERE airport.apcode = departure.destination
		AND airportvia.apcode = departure.via
		AND airlines.alcode = departure.airline
		AND scheddeparture BETWEEN NOW() - INTERVAL 10 MINUTE AND NOW() + INTERVAL 12 HOUR
		AND statuss.scode = departure.status
		AND status != 9
		ORDER BY scheddeparture ASC LIMIT %i", $limit);


echo "<ul id='tab_read1' class='tab departure'>\n";
echo "<li class='head hline'><ul>".
        "<li class='c1'>Destination<br/><i>Tujuan</i></li>".
        "<li class='c2'>Via<br/><i>Melalui</i></li>".
//        "<li class='c3'>Flight No</li>".
        "<li class='c3 airline'><span class='fix'>Airline<br/><i>Penerbangan</i></span></li>".
        "<li class='c4'>Time<br/><i>Waktu</i></li>".
        "<li class='c5'>Gate<br/><i>Pintu</i></li>".
        "<li class='c6'>Status</li>";
        echo "</ul></li>";
        foreach($results as $row) {
                $sd = date('H:i', strtotime($row['scheddeparture']));
                echo "\n<li class='line st".$row['scode']."' ><ul>".
                "<li class='c1 unw'>".$row['city']."</li>".
                "<li class='c2 unw'>".$row['cityvia']."&nbsp;</li>";
		echo li_airline($row['flight'],$row['alname'],$row['alcode']);
                echo "<li class='c4 unw '>".$sd."</li>".
                "<li class='c5 lo'>".$row['termgate']."</li>".
                "<li class='c6 st unw'>".$row['sname']."</li>";
                echo "</ul></li>";
        }
        echo "\n</ul>";

page_end();

?>
