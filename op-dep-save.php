<?php
$apa = $_POST['apa'];
$tgl = $_POST['tgl'];
require_once 'lib/meekrodb.2.1.class.php';
$err=0;	
if ($apa == "c") {

	/*DB::queryFirstRow("SELECT * FROM departure WHERE flight=%s", $_POST['flight']);
	$getrow = DB::count();
	if ($getrow > 0){
		echo "Error: Flight number already exists"; $err=1;
	} else {
	*/	DB::insert('departure', array(
		'destination' => $_POST['destination'],
		'via' => $_POST['via'],
		'flight' => $_POST['flight'],
		'airline' => $_POST['airline'],
		'scheddeparture' => $_POST['scheddeparture'],
		'termgate' => $_POST['termgate'],
		'status' => $_POST['status']
	));	
	//}

} else {

	DB::update('departure', array(
		'destination' => $_POST['destination'],
		'via' => $_POST['via'],
		'flight' => $_POST['flight'],
		'airline' => $_POST['airline'],
		'scheddeparture' => $_POST['scheddeparture'],
		'termgate' => $_POST['termgate'],
		'status' => $_POST['status']
	), 'id=%i', $_POST['id']);
	//'actualdeparture' => $_POST['actualdeparture'],
}


if ($err==0) { header("location:op-dep-main.php"); }

?>
