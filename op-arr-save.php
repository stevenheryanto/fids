<?php
$apa = $_POST['apa'];
$tgl = $_POST['tgl'];
require_once 'lib/meekrodb.2.1.class.php';
$err=0;	

if ($apa == "c") {
	/*DB::queryFirstRow("SELECT * FROM arrival WHERE flight=%s", $_POST['flight']);
	$getrow = DB::count();
	if ($getrow > 0){
		echo "Error: Flight number already exists"; $err=1;
	} else {
	*/	DB::insert('arrival', array(
		'origin' => $_POST['origin'],
		'via' => $_POST['via'],
		'flight' => $_POST['flight'],
		'airline' => $_POST['airline'],
		'schedarrival' => $_POST['schedarrival'],
		'termgate' => $_POST['termgate'],
		'status' => $_POST['status']
		));	
	//}

} else {

	DB::update('arrival', array(
		'origin' => $_POST['origin'],
		'via' => $_POST['via'],
		'flight' => $_POST['flight'],
		'airline' => $_POST['airline'],
		'schedarrival' => $_POST['schedarrival'],
		'termgate' => $_POST['termgate'],
		'status' => $_POST['status']
	), 'id=%i', $_POST['id']);
//'actualarrival' => $_POST['actualarrival'],
}

/*
print_r($_POST);
exit;
*/

header("location:op-arr-main.php");

?>
