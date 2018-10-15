<?php 
SESSION_START();
$_SESSION['email'] = "admin@admin.com";
$user = $_SESSION['email'];

$currentDir = '/website_data_collecting';
$emptyDir = "uploads/";
$FileType = '';
$FileSize;
$currentCWD = scandir(__DIR__ . $currentDir, 1);
$Dir = array();
$File = array();
	
echo __DIR__ ."/".$emptyDir."<br><br>";
			
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
	
echo '<table style="width: 532px;
					background: lightblue;">
		<tr style="border: 1px solid red;">
			<td><b>Type</b></td>
			<td><b>Name</b></td>
			<td><b>File Size</b></td>
		</tr>';
		
foreach($newList as $final){
	$dor = $_SERVER['PHP_SELF'];
	$name = $final;
	
	if(is_dir(__DIR__ .'/'. $final)){
		$FileType = 'Folder';
		$FileSize = folderSize($final);
	} else {
		$FileType = 'File';
		$FileSize = filesize(__DIR__ . '/' . $currentDir . '/' . $final);
	}
	
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
		
		
	$folder_name = "myFolder";
	echo 	'<tr style="width: 100%;">
				<td style="width: 20%;">'.$FileType.'</td>
				<td><a href="$name" style="text-decoration: none; color: black;">'.$name.'</a></td>
				<td>' .$FileSize. '</td>
			</tr>';
}

echo '</table>';
	
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