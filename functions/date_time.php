<?php 

function my_date($d = "America/New_york", $format = "Y-m-d H:i:s", $time=NULL){
	$dtz = new DateTimeZone($d);
	$dt = ($time===NULL) ? new DateTime(date($format), $dtz) : new DateTime(date($time), $dtz) ;
    $dt = new DateTime(date($format), $dtz); 
    return $login_date = gmdate($format, $dt->format('U'));
    // date($login_date)
}

// $dtz = new DateTimeZone('America/New_york');
// $dt = new DateTime(date($login_date), $dtz); 
// $ld = gmdate("D, F d Y H:i", $dt->format('U'));
?>