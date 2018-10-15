<?php
function recordStat($myFile){//creates new function which imports $myFile variables into the function
	$file = fopen($myFile, "r");
	$views = fread($file, 10000);
	fclose($file);
	
	$views = $views + 1;
	
	//echo "<p>Page visits:" . $views . "</p>";
	
	$file = fopen($myFile, "w");
	fwrite($file, $views);
	fclose($file);
}
?>