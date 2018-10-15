<?php
//don't display hidden files function
function is_hidden_file($fn) {
	$dir = "\"".$fn."\"";
	$attr = trim(shell_exec("FOR %A IN (".$dir.") DO @ECHO %~aA"));
	if($attr[3] === 'h'){
		return true;
	} else { return false; }
}
function navDir($currentUser){
	if(!file_exists("uploads/$currentUser")){
		mkdir("uploads/$currentUser", 0777, true);
		echo "Welcome $currentUser, your personal folder has just been created!<br/>
				Please refresh this page to see it!";
		
	} else {
		if(!isset($_GET['file-nav'])){
			$_GET['file-nav'] = "uploads/$currentUser";
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

		$trimmedDir = substr($dir, 2, (strlen($dir)));

		$unsortedList = scandir($dir, 1);

		foreach ($unsortedList as $sort){
			if (is_hidden_file($trimmedDir.$sort) || $sort == '.' || $sort == '..' || $sort[0]=='.' || $sort[0]=='~' ) {
                continue;
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

		echo "<ul>";
		foreach($sortedDir as $eachDirOrFile) {
			$phpSelf = $_SERVER['PHP_SELF'];
			$savedName = $eachDirOrFile;
			$FileSize = filesize(__DIR__ ."/".$currentDir."/".$eachDirOrFile);
			
			switch($FileSize){
				case ($FileSize > 0 && $FileSize < 1000):
					$FileSize = $FileSize.' <b>B</b>'; 
					break;
				case ($FileSize > 999 && $FileSize < 1000000):
					$FileSize = round(($FileSize/1000), 2).' <b>KB</b>'; 
					break;
				case ($FileSize > 999999 && $FileSize < 1000000000):
					$FileSize = round(($FileSize/1000000), 2).' <b>MB</b>'; 
					break;
				case ($FileSize > 999999999 && $FileSize < 1000000000000):
					$FileSize = round(($FileSize/1000000000), 2).' <b>GB</b>'; 
					break;
			}
			
			if ($currentDir != "") $eachDirOrFile = $currentDir."/".$eachDirOrFile;
				
			if (is_dir($eachDirOrFile)) { 
				$strg = "<li><a href='$phpSelf?file-nav=$eachDirOrFile' style='color: black; text-decoration: none;'><b>$savedName</b></a>
							<ul>
								<li><a href='?run=delete.$dir$eachDirOrFile'>Delete</a></li>
								<li><a href='?run=rename$dir$eachDirOrFile'>Rename</a></li>
							</ul>
						</li>";
				echo $strg;
				
			} else {
				$strg = "<a href='$eachDirOrFile' style='color: black; text-decoration: none;'>$savedName</a>======".$FileSize."<br>";	
				echo $strg;
			}
		}
		echo "</ul>";
		
		//back button configs
		$back = dirname($dir);
		$back = str_replace("./","",$back);

		//don't disp back button if in main directory uploads/username/
		if ($back != 'uploads'){
			$phpSelf = $_SERVER['PHP_SELF'];
			echo "<br><a href='$phpSelf?file-nav=$back'>BACK</a><br>";
		}
		
		
	}
}
?>