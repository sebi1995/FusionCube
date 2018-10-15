<?php 
// Collect the passed in variable via GET
$_GET['n'] = "";
$r = $_GET['n'];
$p= "./";

echo "a: ".$_GET['n']."<br/><br/>";

if ($r=="") {
	$dir    = './';
} 
else {
	$dir =$p.$r;
}

$files1 = scandir($dir);
$files2 = scandir($dir, 1);
$files3 = scandir($dir, 2);

/* echo "							D_files1				<br/>";
						print_r($files1);
echo "<br/><br/><br/>			D_files2				<br/>";
						print_r($files2);
echo "<br/><br/><br/>			D_files3				<br/>";
						print_r($files3);
echo "<br/><br/><br/>			Path = $dir				<br/>"; */
echo "			D_server['php_self']	<br/>" ;
						echo $_SERVER['PHP_SELF']   .   "<br/><br/><br/><br/><br/><br/>";

foreach($files2 as $nam) {
	$pp = $_SERVER['PHP_SELF'];
	
	if ($nam=='..' || $nam=='.') {
		// do nothing 
	} 
	else {
		$cur = $nam;
		if ($r != "") {
			$nam = $r."/".$nam;
		}
		if (is_dir($nam)) { 
			$strg = "<a href='$pp?n=$nam'>[$cur]</a><br/>";	
			echo $strg;
		} 
		else {
			$strg = "<a href='$nam'>$cur</a><br/>";	
			echo $strg;
		}	
	}
}
$back = dirname($_GET['n']);	
echo "<br/>".$back;
echo "<br/>".$back;
echo "<br/>".$back;
$back = str_replace("./","",$back);
echo "<br/>dddd".$back;
echo "<br/>".$back;
echo "<br/>".$back;

if ($back=='.') $back = $cur;

echo "<br/><a href='$pp?n=$back'>BACK</a><br/><br/><br/><br/><br/>";
/* echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "	// 	if no link passed in, set to current dir<br/>
			if (D_r==".") {<br/>
			----D_dir    = './';<br/>
			} <br/>
			else {<br/>
			// link was passed in, add basedir and incoming link<br/>
			----D_dir =D_p.D_r;<br/>
			}
"; */

/* echo '<a href="'.$pp.'?n='.$nam.'">'.$nam.'</a><br/>'; */





?>