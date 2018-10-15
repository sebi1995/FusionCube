<?php 
	$currentDir = './';
	$emptyDir = "uploads/";
	$FileType = '';
	$FileSize;
	$currentCWD = scandir($currentDir, 1);
	
	$Dir1 = array();
	$File = array();
			
	foreach ($currentCWD as $row){
		if ($row == '.' || $row == '..'){
		} else {
			if(is_dir($row)){
				$Dir[] = $row;
			} else {
				$File[] = $row;
			}
		}
	}
	$newList = array_merge($Dir, $File);
	
	foreach($newList as $final){
		$dor = $_SERVER['PHP_SELF'];
		$name = $final;
		
		if(is_dir($final)){
			$FileType = 'Folder: ';
			$FileSize = folderSize($final)/10;
		} else {
			$FileType = 'File: ';
			$FileSize = filesize($name);
		}/* 
		if($FileSize >= 0 && $FileSize <= 999){
			$FileSize = $FileSize.' B';
		} elseif($FileSize >= 1000 && $FileSize <= 1000000) {
			$FileSize = ($FileSize/1000).' KB';			
		} */
		
		switch($FileSize){
			case ($FileSize > 0 && $FileSize < 1000):
				$FileSize = $FileSize.' B'; 
				break;
			case ($FileSize > 999 && $FileSize < 1000000):
				$FileSize = ($FileSize/1000).' KB'; 
				break;
			case ($FileSize > 999999 && $FileSize < 1000000000):
				$FileSize = ($FileSize/1000000).' MB'; 
				break;
			case ($FileSize > 999999999 && $FileSize < 1000000000000):
				$FileSize = ($FileSize/1000000000).' GB'; 
				break;
		}
		
		
		$folder_name = "myFolder";
		// echo folderSize($folder_name);
		echo $FileType."<a href='$name'><b>".$name."</b></a>Fileseize: ".$FileSize."<br>";
	}
	
	echo '<br>' . __DIR__ .'<br><br>';
	$directories = glob($currentDir . '*' , GLOB_ONLYDIR);
	foreach($directories as $gogo){
		$hh = glob($gogo.'*',GLOB_ONLYDIR);
		echo $gogo.'<br>';
	}
	echo '<br>' . __DIR__ .'<br><br>';
	foreach (glob("*.php") as $filename) {
		echo "$filename size " . filesize($filename) . "<br>";
	}
	// $DirFileName = $row;
	
	function folderSize($dir){
		$count_size = 0;
		$count = 0;
		
		$dir_array = scandir($dir);
	
		foreach($dir_array as $key=>$filename){
		
			if($filename!=".." && $filename!="."){
					
				if(is_dir($dir."/".$filename)){
				
					$new_foldersize = foldersize($dir."/".$filename);
					$count_size = $count_size+ $new_foldersize;
				
				} 
				else if (is_file($dir."/".$filename)){
				
					$count_size = $count_size + filesize($dir."/".$filename);
					$count++;
				
				}
			}
		}
		
		return $count_size;
	}
	
	
	
	
	
	
?>