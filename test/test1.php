<?php
$action = "upl";
$actionTitle = 0;

genPage($action, $actionTitle);

function genPage($action, $actionTitle){
	$temp = tmpfile();
	
	$hello = "<form action='upload1.php' method='post' enctype='multipart/form-data'>
									Select image to upload:
									<input type='file' name='fileToUpload' id='fileToUpload'>
									<input type='submit' value='Upload Image' name='submit'>
								</form>";
	
	
	
	
	if ($temp != false){
		if ((strlen($action)) > 4){
			return $action;
		} else {$action = "too short";}
		fwrite($temp, 
			"web page $hello");
		fseek($temp, 0);
		echo fread($temp, 10240);
		fclose($temp); // this removes the file
	} else {
		echo"false";
	}
}

?>