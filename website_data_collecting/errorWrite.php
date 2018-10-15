<?php
function writeError($errorName, $errorPage){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	$time = date("h:i:sa");
	$date = date("d/m/y");
	
	$myFile = "errorLog.txt";
	$file = fopen($myFile, 'a') or die("can't open file");
	$stringData = "$ip, $time, $date, $errorName, $errorPage \n";
	fwrite($file, $stringData);
	fclose($file);
}
?>