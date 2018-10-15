<?php 
function is_hidden_file($fn) {
	$dir = "\"".$fn."\"";
	$attr = trim(shell_exec("FOR %A IN (".$dir.") DO @ECHO %~aA"));
	if($attr[3] === 'h'){
		return true;
	} else { return false; }
}

function navDir($currentUser){
	//check if the users folder exists, if it doesn't give them a message and
	//ask them to contact the administrator
	//else
	
	if(isset($_GET['run'])){
		echo "<div id='sub_form_i'>";
		$linkchoice = $_GET['run'];
		
		require_once('genpage.php');
		echo "</div>";
	} else {
	echo "<div id='sub_form_i'>";
		$_GET['run'] = "";
	
		// require_once('genpage.php');
		if(!isset($_GET['file-nav'])){
			$_GET['file-nav'] = "uploads/$currentUser";
		}

		//this is the dir where this php file is
		$defaultDir = "./";
		
		$currentDir = $_GET['file-nav'];
		
		//isfile and isdir lists for sorting
		$isDir = array();
		$isFile = array();
		
		//if file-nav is ever empty
		if ($currentDir == ""){
			$dir = "uploads/$currentUser/";
		} else {
			$dir = $currentDir."/";
		}
		
		$unSortedList = scandir($dir, 1);
		foreach($unSortedList as $sortList){
			if (is_hidden_file($dir.$sortList) || $sortList == '.' || $sortList == '..' || $sortList[0]=='.' || $sortList[0]=='~' ) {
				continue;
			} else {
				if (is_dir($dir.$sortList)){
					$isDir[] = $sortList;
				} else {
					$isFile[] = $sortList;
				}
			}
		}
		
		$sortedList = array_merge($isDir, $isFile);
		
		require_once('getUsersName.php');
			
		$currentUserLen = strlen($currentUser);
		
		$trimmedUploads = substr($dir, 8);
		
		//prints users name from db and trims uploads/ from uploads/$currentUser/
		//then trims username off $currentUser/ and leaves the /
		//which leaves the users name and / and what ever follows
		echo ("Path = $sql_fname".substr($trimmedUploads, ($currentUserLen))."<br><br>");
		
		echo "<a href='?file-nav=uploads/$currentUser' style='color: black; text-decoration: none;'>Home</a><br><br>";
		
		echo "<ul id='dir-nav-ul'>";
		foreach($sortedList as $rows){
			$phpSelf = $_SERVER['PHP_SELF'];
			$saveName = $rows;
			//$Filesize = filesize();
			
			/* switch($FileSize){
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
			} */
			
			if(is_dir($currentDir."/".$rows)){
				echo "<li><a href='?file-nav=$currentDir/$rows'><b>$saveName</b></a></li>";
			} else {
				echo "<li><a href='$dir$rows'>$saveName</a>
						<ul>
							<li><a href='?run=download.$dir$rows'>Download</a></li>
							<li><a href='?run=rename.$dir$rows'>Rename</a></li>
							<li><a href='?run=delete.$dir$rows'>Delete</a></li>
						</ul>
					  </li>";
			}
		}
		echo "</div>";
	}
}
?>