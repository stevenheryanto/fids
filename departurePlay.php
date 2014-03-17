<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
<title>FIDS: Departure</title>
</head>
<body>
<div class="speak">Announcing...</div>
	<?php
		require_once 'lib/meekrodb.2.1.class.php';
	
		$id = $_GET['id'];		
		$row = DB::queryFirstRow("SELECT * FROM departure WHERE id=%i", $id);
		$al = $row['airline'];
		$ci = $row['destination'];
		$fl = preg_replace('/\s+/', '', $row['flight']);
		$k = strlen($fl);
		$st = $row['status'];
		$tg = $row['termgate'];
		$civ = $row['via'];
		$ich = substr($fl,2,1);
		$ni = substr($fl,3,1);
		$san = substr($fl,4,1);
		$jam = substr($row['scheddeparture'],11,2);
		$men = substr($row['scheddeparture'],14,2);
	?>
	<script>
	var status = <?= $st ?>;
	var numb = <?= $k ?>;
	var viaf = '<?= $civ ?>';
	var mp = new Array();
	var fla = new Array();
	var ich = <?= $ich ?>;
	var ni = <?= $ni ?>;
	var san = <?= $san ?>;
	var skip = 0;
		if (((ich == 0) && (ni == 0)) && (san == 0)){
			fla[0] = new Audio('/sounds/null.mp3');
			fla[1] = new Audio('/sounds/null.mp3');
			fla[2] = new Audio('/sounds/null.mp3');
			fla[3] = new Audio('/sounds/null.mp3');
			fla[4] = new Audio('/sounds/null.mp3');
			fla[5] = new Audio('/sounds/null.mp3');
			fla[6] = new Audio('/sounds/null.mp3');
			fla[7] = new Audio('/sounds/null.mp3');
			fla[8] = new Audio('/sounds/null.mp3');
			fla[9] = new Audio('/sounds/null.mp3');
			fla[10] = new Audio('/sounds/null.mp3');
			fla[11] = new Audio('/sounds/null.mp3');
			fla[12] = new Audio('/sounds/null.mp3');
			fla[13] = new Audio('/sounds/null.mp3');
			fla[20] = new Audio('/sounds/null.mp3');
			fla[21] = new Audio('/sounds/null.mp3');
			skip = 1;
		} else {
			fla[0] = new Audio('/sounds/bahasa/<?= substr($fl,0,1) ?>.mp3');	
			fla[1] = new Audio('/sounds/bahasa/<?= substr($fl,1,1) ?>.mp3');	
			fla[2] = new Audio('/sounds/bahasa/<?= substr($fl,2,1) ?>.mp3');	
			fla[3] = new Audio('/sounds/bahasa/<?= substr($fl,3,1) ?>.mp3');	
			fla[4] = new Audio('/sounds/bahasa/<?= substr($fl,4,1) ?>.mp3');
			if(numb >= 6){
				fla[5] = new Audio('/sounds/bahasa/<?= substr($fl,5,1) ?>.mp3');
			} else {
				fla[5] = new Audio('/sounds/null.mp3');
			}		
			if(numb == 7){
				fla[6] = new Audio('/sounds/bahasa/<?= substr($fl,6,1) ?>.mp3');
			} else {
				fla[6] = new Audio('/sounds/null.mp3');
			}
			fla[7] = new Audio('/sounds/english/<?= substr($fl,0,1) ?>.mp3');	
			fla[8] = new Audio('/sounds/english/<?= substr($fl,1,1) ?>.mp3');	
			fla[9] = new Audio('/sounds/english/<?= substr($fl,2,1) ?>.mp3');	
			fla[10] = new Audio('/sounds/english/<?= substr($fl,3,1) ?>.mp3');	
			fla[11] = new Audio('/sounds/english/<?= substr($fl,4,1) ?>.mp3');
			if(numb >= 6){
				fla[12] = new Audio('/sounds/english/<?= substr($fl,5,1) ?>.mp3');
			} else {
				fla[12] = new Audio('/sounds/null.mp3');
			}		
			if(numb == 7){
				fla[13] = new Audio('/sounds/english/<?= substr($fl,6,1) ?>.mp3');
			} else {
				fla[13] = new Audio('/sounds/null.mp3');
			}
			fla[20] = new Audio('/sounds/bahasa/dnp.mp3');
			fla[21] = new Audio('/sounds/english/dnp.mp3');
		}
		
		if(viaf == 0){
			fla[14] = new Audio('/sounds/kota/0.mp3');
			fla[15] = new Audio('/sounds/null.mp3');
			fla[16] = new Audio('/sounds/kota/<?= $ci ?>.mp3');
			fla[17] = new Audio('/sounds/kota/0.mp3');
			fla[18] = new Audio('/sounds/null.mp3');
			fla[19] = new Audio('/sounds/kota/<?= $ci ?>.mp3');
		} else {
			fla[14] = new Audio('/sounds/kota/<?= $civ ?>.mp3');		
			fla[15] = new Audio('/sounds/bahasa/dan.mp3');
			fla[16] = new Audio('/sounds/kota/<?= $ci ?>.mp3');
			fla[17] = new Audio('/sounds/kota/<?= $civ ?>.mp3');
			fla[18] = new Audio('/sounds/english/dan.mp3');
			fla[19] = new Audio('/sounds/kota/<?= $ci ?>.mp3');
		}

	if (status == 1){
		mp[0] = new Audio('/sounds/opening.mp3');
		mp[1] = new Audio('/sounds/bahasa/perhatian.mp3');
		mp[2] = new Audio('/sounds/bahasa/penumpang.mp3');
		mp[3] = new Audio('/sounds/airlines/<?= $al ?>.mp3');
		mp[4] = fla[20];
		mp[5] = fla[0];	
		mp[6] = fla[1];	
		mp[7] = fla[2];	
		mp[8] = fla[3];	
		mp[9] = fla[4];	
		mp[10] = fla[5];
		mp[11] = fla[6];	
		mp[12] = new Audio('/sounds/bahasa/tujuan.mp3');
		mp[13] = fla[14];
		mp[14] = fla[15];
		mp[15] = fla[16];
		mp[16] = new Audio('/sounds/bahasa/boarding.mp3');
		mp[17] = new Audio('/sounds/bahasa/<?= $tg ?>.mp3');
		mp[18] = new Audio('/sounds/bahasa/thanks.mp3');
		mp[19] = new Audio('/sounds/60.mp3');
		mp[20] = new Audio('/sounds/english/perhatian.mp3');
		mp[21] = new Audio('/sounds/english/penumpang.mp3');
		mp[22] = new Audio('/sounds/airlines/<?= $al ?>.mp3');
		mp[23] = fla[21];
		mp[24] = fla[7];	
		mp[25] = fla[8];	
		mp[26] = fla[9];	
		mp[27] = fla[10];	
		mp[28] = fla[11];	
		mp[29] = fla[12];
		mp[30] = fla[13];
		mp[31] = new Audio('/sounds/english/tujuan.mp3');
		mp[32] = fla[17];
		mp[33] = fla[18];
		mp[34] = fla[19];
		mp[35] = new Audio('/sounds/english/boarding.mp3');
		mp[36] = new Audio('/sounds/english/<?= $tg ?>.mp3');
		mp[37] = new Audio('/sounds/english/thanks.mp3');
		mp[38] = new Audio('/sounds/ending.mp3');
	
	} else if (status == 10){
		mp[0] = new Audio('/sounds/opening.mp3');
		mp[1] = new Audio('/sounds/bahasa/perhatian.mp3');
		mp[2] = new Audio('/sounds/bahasa/penumpang.mp3');
		mp[3] = new Audio('/sounds/airlines/<?= $al ?>.mp3');
		mp[4] = fla[20];	
		mp[5] = fla[0];	
		mp[6] = fla[1];	
		mp[7] = fla[2];	
		mp[8] = fla[3];	
		mp[9] = fla[4];	
		mp[10] = fla[5];
		mp[11] = fla[6];	
		mp[12] = new Audio('/sounds/bahasa/tujuan.mp3');
		mp[13] = fla[14];
		mp[14] = fla[15];
		mp[15] = fla[16];
		mp[16] = new Audio('/sounds/bahasa/waiting.mp3');
		mp[17] = new Audio('/sounds/bahasa/thanks.mp3');
		mp[18] = new Audio('/sounds/60.mp3');
		mp[19] = new Audio('/sounds/english/perhatian.mp3');
		mp[20] = new Audio('/sounds/english/penumpang.mp3');
		mp[21] = new Audio('/sounds/airlines/<?= $al ?>.mp3');
		mp[22] = fla[21];
		mp[23] = fla[7];	
		mp[24] = fla[8];	
		mp[25] = fla[9];	
		mp[26] = fla[10];	
		mp[27] = fla[11];	
		mp[28] = fla[12];
		mp[29] = fla[13];
		mp[30] = new Audio('/sounds/english/tujuan.mp3');
		mp[31] = fla[17];
		mp[32] = fla[18];
		mp[33] = fla[19];
		mp[34] = new Audio('/sounds/english/waiting.mp3');
		mp[35] = new Audio('/sounds/english/thanks.mp3');
		mp[36] = new Audio('/sounds/ending.mp3');
			
	} else if (status == 2){
		mp[0] = new Audio('/sounds/opening.mp3');
		mp[1] = new Audio('/sounds/bahasa/perhatian.mp3');
		mp[2] = new Audio('/sounds/bahasa/penumpang.mp3');
		mp[3] = new Audio('/sounds/airlines/<?= $al ?>.mp3');
		mp[4] = fla[20];
		mp[5] = fla[0];	
		mp[6] = fla[1];	
		mp[7] = fla[2];	
		mp[8] = fla[3];	
		mp[9] = fla[4];	
		mp[10] = fla[5];
		mp[11] = fla[6];	
		mp[12] = new Audio('/sounds/bahasa/tujuan.mp3');
		mp[13] = fla[14];
		mp[14] = fla[15];
		mp[15] = fla[16];
		mp[16] = new Audio('/sounds/bahasa/enroute.mp3');
		mp[17] = new Audio('/sounds/bahasa/thanks.mp3');
		mp[18] = new Audio('/sounds/60.mp3');
		mp[19] = new Audio('/sounds/english/perhatian.mp3');
		mp[20] = new Audio('/sounds/english/penumpang.mp3');
		mp[21] = new Audio('/sounds/airlines/<?= $al ?>.mp3');
		mp[22] = fla[21];
		mp[23] = fla[7];	
		mp[24] = fla[8];	
		mp[25] = fla[9];	
		mp[26] = fla[10];	
		mp[27] = fla[11];	
		mp[28] = fla[12];
		mp[29] = fla[13];
		mp[30] = new Audio('/sounds/english/tujuan.mp3');
		mp[31] = fla[17];
		mp[32] = fla[18];
		mp[33] = fla[19];
		mp[34] = new Audio('/sounds/english/enroute.mp3');
		mp[35] = new Audio('/sounds/english/thanks.mp3');
		mp[36] = new Audio('/sounds/ending.mp3');

	} else if (status == 4){
		mp[0] = new Audio('/sounds/opening.mp3');
		mp[1] = new Audio('/sounds/bahasa/perhatian.mp3');
		mp[2] = new Audio('/sounds/bahasa/pesawat.mp3');
		mp[3] = new Audio('/sounds/airlines/<?= $al ?>.mp3');
		mp[4] = fla[20];
		mp[5] = fla[0];	
		mp[6] = fla[1];	
		mp[7] = fla[2];	
		mp[8] = fla[3];	
		mp[9] = fla[4];	
		mp[10] = fla[5];
		mp[11] = fla[6];	
		mp[12] = new Audio('/sounds/bahasa/tujuan.mp3');
		mp[13] = fla[14];
		mp[14] = fla[15];
		mp[15] = fla[16];
		mp[16] = new Audio('/sounds/bahasa/cancelled.mp3');
		mp[17] = new Audio('/sounds/bahasa/thanks.mp3');
		mp[18] = new Audio('/sounds/60.mp3');
		mp[19] = new Audio('/sounds/english/perhatian.mp3');
		mp[20] = new Audio('/sounds/english/pesawat.mp3');
		mp[21] = new Audio('/sounds/airlines/<?= $al ?>.mp3');
		mp[22] = fla[21];
		mp[23] = fla[7];	
		mp[24] = fla[8];	
		mp[25] = fla[9];	
		mp[26] = fla[10];	
		mp[27] = fla[11];	
		mp[28] = fla[12];
		mp[29] = fla[13];
		mp[30] = new Audio('/sounds/english/tujuan.mp3');
		mp[31] = fla[17];
		mp[32] = fla[18];
		mp[33] = fla[19];
		mp[34] = new Audio('/sounds/english/cancelled.mp3');
		mp[35] = new Audio('/sounds/english/thanks.mp3');
		mp[36] = new Audio('/sounds/ending.mp3');
	
	} else if (status == 7){
		mp[0] = new Audio('/sounds/opening.mp3');
		mp[1] = new Audio('/sounds/bahasa/perhatian.mp3');
		mp[2] = new Audio('/sounds/bahasa/pesawat.mp3');
		mp[3] = new Audio('/sounds/airlines/<?= $al ?>.mp3');
		mp[4] = fla[20];
		mp[5] = fla[0];	
		mp[6] = fla[1];	
		mp[7] = fla[2];	
		mp[8] = fla[3];	
		mp[9] = fla[4];	
		mp[10] = fla[5];
		mp[11] = fla[6];	
		mp[12] = new Audio('/sounds/bahasa/tujuan.mp3');
		mp[13] = fla[14];
		mp[14] = fla[15];
		mp[15] = fla[16];
		mp[16] = new Audio('/sounds/bahasa/delaydep1.mp3');
		mp[17] = new Audio('/sounds/bahasa/<?= $jam ?>.mp3');
		mp[18] = new Audio('/sounds/bahasa/<?= $men ?>.mp3');
		mp[19] = new Audio('/sounds/bahasa/delaydep2.mp3');
		mp[20] = new Audio('/sounds/bahasa/thanks.mp3');
		mp[21] = new Audio('/sounds/60.mp3');
		mp[22] = new Audio('/sounds/english/perhatian.mp3');
		mp[23] = new Audio('/sounds/english/pesawat.mp3');
		mp[24] = new Audio('/sounds/airlines/<?= $al ?>.mp3');
		mp[25] = fla[21];
		mp[26] = fla[7];	
		mp[27] = fla[8];	
		mp[28] = fla[9];	
		mp[29] = fla[10];	
		mp[30] = fla[11];	
		mp[31] = fla[12];
		mp[32] = fla[13];
		mp[33] = new Audio('/sounds/english/tujuan.mp3');
		mp[34] = fla[17];
		mp[35] = fla[18];
		mp[36] = fla[19];
		mp[37] = new Audio('/sounds/english/delaydep1.mp3');
		mp[38] = new Audio('/sounds/english/<?= $jam ?>.mp3');
		mp[39] = new Audio('/sounds/english/<?= $men ?>.mp3');
		mp[40] = new Audio('/sounds/english/delaydep2.mp3');
		mp[41] = new Audio('/sounds/english/thanks.mp3');
		mp[42] = new Audio('/sounds/ending.mp3');
	}
			
	function playit(i){
		if (i < mp.length){
			console.log(mp[i]);
			mp[i].play();
		}
		mp[i].addEventListener('ended', function(){
			if ((skip == 1 && status == 1) && (i == 3 || i == 22)){
				i = i + 9;
			} else if ((skip == 1 && status == 7) && (i == 3 || i == 24)){
				i = i + 9;
			}else if ((skip == 1 && (status != 3 || status != 7)) && (i == 3 || i == 21)){
				i = i + 9;
			} else {
				i++;
			}
			playit(i);
			console.loge(i);
			$('div.speak').empty();
		});
	}
	window.onload = playit(0);
	</script>	
</body>
</html>