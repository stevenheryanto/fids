<?php

require_once 'lib/meekrodb.2.1.class.php';

function put_csscode($results) {

        foreach (array_keys($results) as $k) {
                $results[$k]['cssn'] = strtolower($results[$k]['flight']);
                $results[$k]['cssn'] = "code_".preg_replace("/([a-z])|\s/i", "", $results[$k]['cssn']);
				if ($results[$k]['cityvia'] == "null") { $results[$k]['cityvia']=""; }
				if ($results[$k]['cityvia'] == "-") { $results[$k]['cityvia']=""; }

        }

	return $results;
}

function db_departure_timed($limit=10) {
	
	$results = DB::query("SELECT id, airportvia.cityvia, airport.city, flight, airlines.alname, scheddeparture, termgate, statuss.sname, statuss.scode, airlines.alcode
                FROM airportvia, airport, airlines, departure, statuss
                WHERE airport.apcode = departure.destination
                AND airportvia.apcode = departure.via
                AND airlines.alcode = departure.airline
                AND DATE(scheddeparture) = CURDATE()
				AND statuss.scode = departure.status
                AND status != 9
                ORDER BY scheddeparture ASC LIMIT %i", $limit);

        $results = put_csscode($results);
		//AND scheddeparture BETWEEN NOW() - INTERVAL 3 HOUR AND NOW() + INTERVAL 3 HOUR

        if (sizeof($results)>0) { return $results; } else { return array(); }
}


function db_arrival_timed($limit=10) {

	$results = DB::query("SELECT id, airportvia.cityvia, airport.city, flight, airlines.alname, airlines.alcode, schedarrival, termgate, statuss.sname, statuss.scode
        FROM airport, airlines, arrival, statuss, airportvia
        WHERE airport.apcode = arrival.origin
        AND airportvia.apcode = arrival.via
        AND airlines.alcode = arrival.airline
		AND DATE(schedarrival) = CURDATE()
        AND statuss.scode = arrival.status
        AND status != 9
        ORDER BY schedarrival ASC LIMIT %i", $limit);

        $results =put_csscode($results);
		//AND schedarrival BETWEEN NOW() - INTERVAL 3 HOUR AND NOW() + INTERVAL 3 HOUR
		
        if (sizeof($results)>0) { return $results; } else { return array(); }
}


function db_arrival($limit=10) {

	$results = DB::query("
	SELECT id, airportvia.cityvia, airport.city, flight, airlines.alname, airlines.alcode, schedarrival, termgate, statuss.sname, statuss.scode
	FROM airport, airlines, arrival, statuss, airportvia
	WHERE airport.apcode = arrival.origin
	AND airportvia.apcode = arrival.via
	AND airlines.alcode = arrival.airline
	AND DATE(schedarrival) = CURDATE()
	AND statuss.scode = arrival.status
	AND status != 9
	ORDER BY schedarrival ASC LIMIT %i", $limit);

	$results =put_csscode($results);

	if (sizeof($results)>0) { return $results; } else { return array(); }

}

function db_departure($limit=10) {
	$results = DB::query("
	SELECT id, airportvia.cityvia, airport.city, flight, airlines.alname, scheddeparture, termgate, statuss.sname, statuss.scode, airlines.alcode
        FROM airportvia, airport, airlines, departure, statuss
        WHERE airport.apcode = departure.destination
        AND airportvia.apcode = departure.via
        AND airlines.alcode = departure.airline
        AND DATE(scheddeparture) = CURDATE()
        AND statuss.scode = departure.status
        AND status != 9
        ORDER BY scheddeparture ASC LIMIT %i", $limit);

        $results =put_csscode($results);

	if (sizeof($results)>0) { return $results; } else { return array(); }
}

function jsoning($results) {
	$res = array();
	foreach($results as $row) { array_push($res,$row); }
	header('Content-type: application/json');
	$dres = array('fids',$res);
	echo json_encode($res);
}

?>
