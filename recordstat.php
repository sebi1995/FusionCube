<?php
function recordStat($myFile, $value){
	$file = fopen($myFile, 'w') or die("File cannot be found"); // Sets fopen function as a variable		
	fwrite($file, $value); // Opens the file and makes changes
	fclose($file); // Closes files		
}
?>