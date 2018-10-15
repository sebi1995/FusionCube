<link rel="stylesheet" type="text/css" href="test.css" media="screen" charset="utf-8" />  
<?php
$currentUser = "admin@admin.com";
if(!isset($_GET['file-nav'])){
	$_GET['file-nav'] = "uploads/$currentUser";
}
if(!isset($_GET['p'])){
	$_GET['p'] = "";
}

$defDir = "./";
$currentDir = $_GET['file-nav'];
$isDir = array();
$isFile = array();

if ($currentDir == "") {
	$dir = "uploads/$currentUser/";
} else {
	$dir = $defDir.$currentDir."/";
	
}
$unsortedList = scandir($dir, 1);

foreach ($unsortedList as $sort){
	if ($sort == '..' || $sort == '.') {
	} else {
		if (is_dir($dir.$sort)){
			$isDir[] = $sort;
		} else {
			$isFile[] = $sort;
		}
	}
}
$sortedDir = array_merge($isDir, $isFile);


$pdir = substr($dir, 10);

require_once('website_data_collecting/db.php');
	$sql = "SELECT user_name FROM user_login WHERE user_email = '$currentUser'";	

	$result = $con->query($sql);
	$msql_name = $result->fetch_assoc();
	$sql_fname = $msql_name['user_name'];

$currentUserLen = strlen($currentUser);

echo ("Path = $sql_fname".substr($pdir, ($currentUserLen))."<BR><BR>");
echo "<a href='?file-nav=uploads/$currentUser' style='color: black; text-decoration: none;'>Home</a><br><br>";
echo "<nav id='dirfile-nav'>";
foreach($sortedDir as $eachDirOrFile) {
	$phpSelf = $_SERVER['PHP_SELF'];
	$savedName = $eachDirOrFile;
	$FileSize = filesize(__DIR__ ."/".$currentDir."/".$eachDirOrFile);
	
	if ($currentDir != "") $eachDirOrFile = $currentDir."/".$eachDirOrFile;
		
	if (is_dir($eachDirOrFile)) {  	
		echo "	<li>
					<a href='$phpSelf?file-nav=$eachDirOrFile' style='color: black; text-decoration: none;'>
						<b>$savedName</b>
					</a>
					<ul>
						<li><a href='?p=rename-$savedName'>Rename $savedName</a></li>
						<li><a href='?p=delete-$savedName'>Delete $savedName</a></li>
						<li><a href='?p=move-$savedName'>Move $savedName</a></li>
					</ul>
				</li>";
	} else {

		echo "<li><a href='$eachDirOrFile' style='color: black; text-decoration: none;'>$savedName</a></li>";	
	}
}
echo "</nav>";

$back = dirname($dir);
$back = str_replace("./","",$back);


if ($back != 'uploads'){
	$phpSelf = $_SERVER['PHP_SELF'];
	echo "<br><a href='$phpSelf?file-nav=$back'>BACK</a><br>";
}
$move = $_GET['p'];
echo "<br><br>$move"; 












?>