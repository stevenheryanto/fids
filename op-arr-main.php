<?php 
require_once "_function.php";
header_opmain("arrival");
$tan = $_POST['tanggal']; 
if (!$tan) { $tan = @$_GET['tgl']; }
?><div id="topbar">
	<div class='header'>
		<h1>Arrival</h1>
		<div><a class='newrec' title="New Record" href="op-arr-form.php">New Record</a></div>
		<div class="gogo">
		<a title="Departure" href="op-dep-main.php">Departure</a>
		<a title="Arrival" href="op-arr-main.php">Arrival</a>
		</div>
	</div>
	<form action="op-arr-main.php" method="post" class="tglgo">
	<input class='input' type="date" name="tanggal" value='<?= $tan ?>'>
	<input class="button" name="submit" type="submit" value="Go">
	</form>
</div>

<div id="edita"></div>
<?php
	require_once 'lib/meekrodb.2.1.class.php';
	$dat = date('Y-m-d');
	//echo $dat;
	$where = new WhereClause('and');
	if ($tan != 0){
		$where->add('DAY(schedarrival)=%s', substr($tan,8,2));
		$where->add('MONTH(schedarrival)=%s', substr($tan,5,2));
		$where->add('YEAR(schedarrival)=%s', substr($tan,0,4));
	} else {
		$where->add('DAY(schedarrival)=%s', substr($dat,8,2));
		$where->add('MONTH(schedarrival)=%s', substr($dat,5,2));
		$where->add('YEAR(schedarrival)=%s', substr($dat,0,4));
		$tan = $dat;
	}

	$results = DB::query("SELECT arrival.id, airport.city, flight, airlines.alname, schedarrival, termgate, statuss.sname, cityvia
				FROM airport, airlines, arrival, statuss, airportvia
				WHERE %l AND airport.apcode = arrival.origin
				AND airlines.alcode = arrival.airline
				AND statuss.scode = arrival.status
				AND airportvia.apcode = arrival.via
				ORDER BY schedarrival ASC LIMIT 20", $where);

        echo "<ul class='fl_table' id='table_head'>\n";
        echo "<li class='head'>"."<ul>".
        "<li class='c1'>Time</li>".
        "<li class='c2'>Origin</li>".
        "<li class='c3'>Flight No</li>".
        "<li class='c4'>Airline</li>".
        "<li class='c5'>&nbsp;</li>".
        "<li class='c6 lo'>Gate</li>".
        "<li class='c7'>Status</li>".
        "<li class='c8'>Action</li>";

        echo "</ul></li></ul>\n";
        echo "<ul id='table' class='fl_table'>\n";
        foreach($results as $row) {
                echo "<li class='drag line ".$row['sname']."' draggable='true' id=".$row['id']." ondragstart=drag(event)>".
		"<ul>".
                "<li class='c1 hi unw'>".
		"<span class='l_date'>".substr($row['schedarrival'],0,10)."<span>&nbsp;".
                "<span class='l_time'>".substr($row['schedarrival'],11,5)."<span>".
		"</li>".
                "<li class='c2'>".$row['city']."</li>".
                "<li class='c3 hi'>".$row['flight']."</li>".
                "<li class='c4'>".$row['alname']."</li>".
                "<li class='c5'><a class='button edit' title='Edit' href='op-arr-form.php?tgl=".$tan."&id=". $row['id'] ."'>Edit</a></li>".
                "<li class='c6 lo'>".$row['termgate']."</li>".
                "<li class='c7 status'>".$row['sname']."</li>".
                "<li class='c8 act'>".
			"<a title='Announce' class='announce' href='arrivalPlay.php?id=". $row['id']."'>".
			"Announce <i class='icn icon-microphone'></i>".
			"</a>".
		"</li>";
                echo "</ul></li>\n";
        }
	echo "<li class='clr'></li>";
        echo "</ul>\n";

?>
<div id="bottom">
<div id="speak">
</div>
<div class="tools">
<!--
	<a class="newrec" title="Create" href="op-arr-form.php"><i class="icon-plane icon-4x"></i></a>
-->
	<i title="Drag here to delete" class="icon-trash icon-4x" ondrop="drop(event)" ondragover="allowDrop(event)"></i>
</div>
</div>

</body>
</html>
