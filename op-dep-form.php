<?php
require_once 'lib/meekrodb.2.1.class.php';

$id = @$_GET['id']; $row = array();

if ($id) {
	$row = DB::queryFirstRow("SELECT * FROM departure WHERE id=%s", $id);
	$q_apa = u;
} else{
	$row = array();
	$q_apa = c; /* create */
}

$listcity = DB::query("SELECT * FROM airport ORDER BY city ASC");
$listair = DB::query("SELECT * FROM airlines ORDER BY alname ASC");


?><!DOCTYPE html>
<html>
<head>
<script src="js/jquery.datetimepicker.js"></script>
<script src="op-jquery.js?"></script>
<link type="text/css" rel="stylesheet" media="screen" href="js/jquery.datetimepicker.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>FIDS: Departure form</title>
</head>
<body>
<div class="padin">
<form action="op-dep-save.php" method="post" class="fform">
<div class='em-btn-post'><a href="#" class='close em-btn'>close</a></div>
<input type="hidden" name="apa" value="<?= $q_apa ?>" />
<?php if ($id) { ?><input type="hidden" name="id" value="<?= $id ?>"/><?php } ?>
<p><label>Destination: </label>
   <span><select name="destination" required><option value=''></option><?php
		include("list-fav-city-nv.txt");
		foreach ($listcity as $lcity) {
			echo "\n\t<option value='".$lcity['apcode']."'";
                        if($row['destination'] == $lcity['apcode']){ echo " selected"; }
			echo ">".$lcity['city']."(".$lcity['apcode'].")</option>";
		}
	?></select></span></p>

<p><label>via: </label>
   <span><select name="via"><option value='0'>(tidak ada)</option><?php
		include("list-fav-city.txt");
                foreach ($listcity as $lcity) {
                        echo "\n\t<option value='".$lcity['apcode']."'";
                        if($row['via'] == $lcity['apcode']){ echo " selected"; }
                        echo ">".$lcity['city']."(".$lcity['apcode'].")</option>";
                }
	?></select></span></p>

<p><label>Airline: </label>
   <span><select name="airline" class="al" required><option value=''></option><?php
		include("list-fav-airline.txt");
		foreach ($listair as $lair) {
			echo "\n\t<option value='".$lair['alcode']."'";
			if( $row['airline'] == $lair['alcode'] ){ echo " selected"; }
			echo ">".$lair['alname']."(".$lair['alcode'].")</option>";
		}
	?></select></span></p>
<p><label>Flight No: </label>
   <span><input type="text" class="fl" name="flight" pattern="[A-Z]{2,3}[ ][0-9]{3,4}" required value='<?php if ($id) { echo $row['flight']; } ?>'></span></p>

<p><label>Status: </label>
   <span><select name="status" class="sts">
                <option value="0" <?php if ($row['status'] == '0') echo 'selected' ?>>Scheduled</option>
                <option value="10" <?php if ($row['status'] == '10') echo 'selected' ?>>Waiting Room</option>
				<option value="1" <?php if ($row['status'] == '1') echo 'selected' ?>>Boarding</option>
                <option value="2" <?php if ($row['status'] == '2') echo 'selected' ?>>En Route</option>
                <!--option value="3" ?php if ($row['status'] == '3') echo 'selected' ?>>Landed</option-->
                <option value="4" <?php if ($row['status'] == '4') echo 'selected' ?>>Cancelled</option>
                <!--option value="5" ?php if ($row['status'] == '5') echo 'selected' ?>>Redirected</option>
                <option value="6" ?php if ($row['status'] == '6') echo 'selected' ?>>Diverted</option-->
                <option value="7" <?php if ($row['status'] == '7') echo 'selected' ?>>Delayed</option>
                <option value="11" <?php if ($row['status'] == '11') echo 'selected' ?>>RTA</option>
                <option value="8" <?php if ($row['status'] == '8') echo 'selected' ?>>RTB</option>
                <option value="9" <?php if ($row['status'] == '9') echo 'selected' ?>>Hide</option>
                </select></span></p>

<p><label>Gate: </label><?php if  (!$row['termgate']) {  $row['termgate']=1; } ?>
   <span><input type="text" name="termgate" value="<?= $row['termgate']?>"  pattern="[1-9]{1}"></span></p>

<p><label>Sched. Departure: </label>
   <span><input type="text" autocomplete="off" name="scheddeparture" id="schedpicker" class="timepicker" value="<?= substr($row['scheddeparture'],0,16)?>" required></span></p>

<p class="submit"><label>&nbsp; </label>
   <span><input class="button" name="submit" type="submit" value="Submit"></span></p>

</form>
</div>

</body>
</html>
