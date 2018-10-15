<?php
$_GET['n'] = '';
$r= $_GET['n'];
$p= "./"; 

if ($r=="") {
	$r = './';
}
 $norr = 1;
$files2 = scandir($r, $norr);

print_r($files2);
echo'<br/>';echo'<br/>';

$folders = array();
$files = array();

foreach($files2 as $key => $nam) {
	$pp = $_SERVER['PHP_SELF'];
	
	
	if ($nam=='..' || $nam=='.') {
	} 
	else {
		$cur = $nam;
		$filetype = '';
		
		if ($r!="") $nam = $r."/".$nam;
		// echo $nam.'<br/>';
		if (is_dir($nam)) {
			$folders[] = $nam;	
			$filetype = "<b>FOLDER</b>";
		} 
		else {
			$files[] = $nam;
		}
		$finalList = array_merge($folders, $files);
		foreach ($finalList as $key => $end){
			$pazz = $end;
			if (is_dir($end)){
				echo '<b>$filetype</b> '.$cur.'<br/>';
			} else {echo '<b>$filetype:</b> '.$pazz.'<br/>';}
		}
	}
}
	
	
	foreach($finalList as $key => $end){
		$cur = $end;
	}
	
	// print_r($finalList);
	/* 
			
				upload1.php as key=[0] => nam=upload1.php
				pp= /final1/gen.php

				$cur = $nam
				
				nam = .//upload1.php
				

	*/
	
	
	
	
	
/* 	$array1 = array("color" => "red", 2, 4);
	$array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
	$result = array_merge($array1, $array2);
	print_r($result); */

	
	$test1 = array();
	$add0 = "aaaaa";
	$add1 = "xxxxx";
	$add2 = "sssss";
	$add3 = "eeeee";
	$add4 = "sssss";
	$test1[] = $add0;
	$test1[] = $add1;
	$test1[] = $add2;
	$test1[] = $add3;
	$test1[] = $add4;
	echo '<br/><br/>';
	print_r($test1);
	
	echo '<br/><br/>';
	
	foreach($test1 as $filename){
		/* for ($i = "a"; (strlen($i)) < 2; $i++){
			$n1 = 0;
			$n2 = ((strlen($filename)) - 1);
			$test2 = substr($filename, $n1, $n2);
			echo $filename.'<br/>';
		} */
		$n1 = 0;
		$n2 = ((strlen($filename)) - 2);
		$test2 = substr($filename, $n1, $n2);
			
		echo 'substr: '.$test2.' - Filename itself: '.$filename."<br/>";
	}
	
	print_r($test1);
	
	
	
?>