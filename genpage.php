<?php 
switch($linkchoice){
	case (substr($linkchoice, 0, 8)) == "download": 
			ob_end_clean();
			$linkchoice = substr($linkchoice, 9, (strlen($linkchoice)));
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($linkchoice).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($linkchoice));
			readfile($linkchoice);
			exit; 
			
			
			
/* 			$path_parts = pathinfo($linkchoice);
			$folderLocationIn = $path_parts['dirname']; //dir location, what folder is it in
			$ext = $path_parts['extension'];
			
			header("Content-disposition: attachment; filename=$linkchoice");
			header("Content-type: application/$ext");
			readfile($linkchoice); */
			
			//header("Location: $linkchoice; Content-type: application/force-download");
			
			
		break;
	case (substr($linkchoice, 0, 2)) == "up":
			require_once('getUsersName.php');
			
			$currentUserLen = strlen($currentUser);
			
			$trimmedUploads = substr($linkchoice, 10);
			
			//prints users name from db and trims uploads/ from uploads/$currentUser/
			//then trims username off $currentUser/ and leaves the /
			//which leaves the users name and / and what ever follows
			
			echo "<br>dd".$msg = 			"Path = $sql_fname".substr($trimmedUploads, ($currentUserLen))."<br><br>";
			echo "<br>dd".$fileDirLink = 	substr($linkchoice, 2, (strlen($linkchoice))) ;
			$formtitle = 	"Upload File";
			$whichform =	"<form action='upload.php' id='uploadForm' method='post' enctype='multipart/form-data'>
								Select image to upload:
								<input type='file' name='fileToUpload' id='fileToUpload'>
								<input type='submit' value='Upload Image' name='uploadFile'>
							 </form>
							
							";
			genPage($fileDirLink, $formtitle, $whichform, $msg);
			
			
		break;
	case (substr($linkchoice, 0, 6)) == "rename":
	
			
		// $currentUserLen = strlen($currentUser);
		// echo $LClink = substr($linkchoice, 15, (strlen($linkchoice)));						//1
		// $path_parts = pathinfo($linkchoice);
		// echo "<br>".$folderLocationIn = $path_parts['dirname'];									//2
		// echo "<br>".$folderLocationIn1 = $path_parts['basename'];									//2
		// echo "<br>".$getUEmail = substr($folderLocationIn, 15, (strlen($folderLocationIn)));		//3
		//linkchoice rename.uploads/admin@admin.com/screen55.png
		// .substr($trimmedUploads, ($currentUserLen)).
	
		require_once('getUsersName.php');
			
		$currentUserLen = strlen($currentUser);
		
		$trimmedUploads = substr($linkchoice, 15);
		
		//prints users name from db and trims uploads/ from uploads/$currentUser/
		//then trims username off $currentUser/ and leaves the /
		//which leaves the users name and / and what ever follows
		
		$msg = 			"Path = $sql_fname".substr($trimmedUploads, ($currentUserLen))."<br><br>";
		$fileDirLink = 	substr($linkchoice, 7, (strlen($linkchoice))) ;
		$formtitle = 	"Rename Folder";
		$whichform =	"<form id='renameForm' method='post'>
							<label for='newname'>New Name</label>
							<input type='text' name='newname' id='name' required='required'/>
							<input type='submit' name='changeName' value='Register' />
						</form>";
		genPage($fileDirLink, $formtitle, $whichform, $msg);
		break;
		
	case (substr($linkchoice, 0, 6)) == "delete": 
		$fileDirLink = 	substr($linkchoice, 6, (strlen($linkchoice))) ;
		$msg = 			"Delete Folder:";
		$formtitle = 	"Delete Folder";
		$whichform =	"<form action='upload1.php' method='post' enctype='multipart/form-data'>
							Select image to upload:
							<input type='file' name='fileToUpload' id='fileToUpload'>
							<input type='submit' value='Upload Image' name='submit'>
						</form>";
		genPage($fileDirLink, $formtitle, $whichform, $msg);
		break;
	default: true ;break;

}

function genPage($fileDirLink, $formtitle, $whichform, $msg){
	$temp = tmpfile();

	if ($temp != false){
		if(isset($_POST['changeName'])){
			if (file_exists($fileDirLink)){
				
				$servername = "localhost";
				$username = "root";
				$password = "";
				$database = "dropbox";

				// Create connection
				$con = new mysqli($servername, $username, $password, $database);
				$newname =  mysqli_real_escape_string($con, $_POST['newname']);
				
				$path_parts = pathinfo($fileDirLink);
				$folderLocationIn = $path_parts['dirname']; //dir location, what folder is it in
				$fullFileName = $path_parts['basename'];//full name with extension
				
				$filename = $path_parts['filename']; //name without extension
				
				if (is_dir($fileDirLink)){
					rename($fileDirLink, $folderLocationIn."/".$newname);
				} else {
					$ext = $path_parts['extension'];
					rename($fileDirLink, $folderLocationIn."/".$newname.".".$ext);
				}	
			} 
		} else {
			fwrite($temp, 
			"		<span id='sub_title' style='font-size: 35px;'>
						$formtitle
					</span>
					<span id='sub_form' style='border: 1px solid black; height: 100px;'>
						$msg $whichform
					</span>
					<a href='index.php'>go back!</a>");
		}
		fseek($temp, 0);
		echo fread($temp, 10240);
		
		
		
		fclose($temp); // this removes the file
	} else {
		echo"Error: Please try again!";
	}
}
?>