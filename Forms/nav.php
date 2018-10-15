<?php 
// Collect the passed in variable via GET
$_GET['n'] = "";
$r= $_GET['n'];
// basedir
$p= "./";

// if no link passed in, set to current dir
if ($r=="") {
	$dir    = './';
} 
else {
	// link was passed in, add basedir and incoming link
	$dir =$p.$r;
}

// Get a list of files/directories in the directory
//$files1 = scandir($dir);
$files2 = scandir($dir, 1);

// you can dump out the items found
//print_r($files1);
//print_r($files2);

// output the current working path
echo ("Path = $dir");

// output the files and directories
foreach($files2 as $nam) {

	// Get the url of this script so we can come restart it 
	$pp = $_SERVER['PHP_SELF'];
	
	// dont do anything current or back links
	if ($nam=='..' || $nam=='.') {
		// do nothing 
	} 
	else {
		// save the actual name of the file/directory
		$cur = $nam;
		
		//if there is an incoming path deal with it!
		if ($r!="") $nam = $r."/".$nam;
		
		// check if its a directory
		if (is_dir($nam)) { 
			$strg = "<a href='$pp?n=$nam'>[$cur]</a><br/>";	
			echo $strg;
		} 
		else {
			// its a file!
			$strg = "<a href='$nam'>$cur</a><br/>";	
			echo $strg;
		}	
	}
}

// back button
// get the parent path (you can any level back using an option)
$back = dirname($dir);

// get rid of dot slash that is included
$back = str_replace("./","",$back);

// get rid of a single dot thats included when starting point hit
if ($back=='.') $back = "";

// output the back link itself
echo "<br/><a href='$pp?n=$back'>BACK</a><br/>";
?>