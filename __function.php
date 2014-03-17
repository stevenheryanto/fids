<?php 

$lang["d"] = array("dep", "Departure", "Keberangkatan", "Destination", "Tujuan");
$lang["a"] = array("arr", "Arrival", "Kedatangan", "Origin", "Dari");

function males($z) { return ($z/46)*180; }

function css_typeset($z) {?>
body { font-size:<?php echo $z; ?>px; line-height:<?php echo 2*$z; ?>px; }
li.head,li.line,.hline { line-height:<?php echo $z; ?>px; height:<?php echo 2*$z; ?>px; }
#frame_header { max-height:<?php echo 3*$z; ?>px; height:<?php echo 3*$z; ?>px; padding-top: <?php echo .5*$z; ?>px; }
#icon { height: <?php echo 2.5*$z; ?>px; width: <?php echo 2.5*$z; ?>px; } 
#title { height: <?php echo 3*$z; ?>px;  line-height: <?php echo 3*$z; ?>px; }
#title h1 { margin-left: <?php echo .5*$z; ?>px; font-size: <?php echo 2.5*$z; ?>px; }
#title small { margin-left: <?php echo .5*$z; ?>px; }
#frame_header span.ap { top: <?php echo 1*$z; ?>px; }
.al_logo { height: <?php echo 2*$z; ?>px; width: <?php echo 3.9*(2*$z); ?>px; }
#gate #frame_header { padding-top: <?php echo .25*$z; ?>px;; }
#gate .al_logo { height: 1.5*<?php echo $z; ?>px; width: <?php echo 4.4*1.5*($z);?>px; }
#gate li.head { font-size: <?php echo .9*$z; ?>px; line-height:<?php echo $z; ?>px; height:<?php echo $z; ?>px;; }
<?php }

function html_clock() {
	$tgl = strftime("%A, %d %h %G",time());
        echo "<div id='jam'>";
        echo "<span class='clock jclock_eit'>--:--:--</span><br/>";
        echo "<span class='date dim'>$tgl</span>";
        echo "</div>\n";
}


function frame_header($mod="dis",$display) {
	global $lang;
	if ($mod == "dis") {

	echo "<div id='frame_header' class='ph ".$lang[$display][0]."'>\n<div id='title'>";
        echo "<span id='icon' class='$display'></span>";
        echo "<h1>".$lang[$display][1]."</h1><small class='dim'>".$lang[$display][2]."</small></div>\n";
	html_clock();
	echo "<span class='ap'></span><div class='clear'></div></div>\n";

	} else { /* gate */

        echo "<div id='frame_header' class='ph gate'>\n<div id='title'>";
        echo "<h1>Bandara Frans Kaisiepo - Biak</h1></div>\n";
        html_clock();
        echo "<span class='ap'></span><div class='clear'></div></div>\n";


	}

}

