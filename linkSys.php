
<?php 
	if (isset($_GET['run'])){
		$linkchoice=$_GET['run'];
		
		
		function genPage($whichform, $msg, $goback){
			$temp = tmpfile();
			
			if ($temp != false){
				fwrite($temp, 
				"	<?php?>
					<!DOCTYPE html>
					<html>
						<head>
							<title>My DropBox</title>
							<link rel='stylesheet' type='text/css' href='layout.css' media='screen' charset='utf-8' />  
							<link rel='stylesheet' type='text/css' href='css/index.css' media='screen' charset='utf-8' />  
						</head>
						<body>
							<div id='top_bar'>
								<a href='register.php'><span>Register</span></a>
							</div>
							<div id='main_wrapper'>
								<div id='sub_wrapper'>
									<span id='sub_title'>
										aweaw
									</span>
									<span id='sub_form' style='border: 1px solid black;'>
										$msg $whichform $goback
									</span>	
								</div>		
							</div>	
						</body>
					</html>");
				fseek($temp, 0);
				echo fread($temp, 10240);
				fclose($temp); // this removes the file
			} else {
				echo"Error: Please try again!";
			}
		}
		switch($linkchoice){
			case 'up': 
				$msg = "Upload: ";
				$whichform =   "<form action='upload1.php' method='post' enctype='multipart/form-data'>
									Select image to upload:
									<input type='file' name='fileToUpload' id='fileToUpload'>
									<input type='submit' value='Upload Image' name='submit'>
								</form>";
				$goback = '<a href="linkSys.php">go back!</a>';
				genPage($whichform, $msg, $goback);
				break;
			case 'down': 
				$msg = "Download: ";
				$whichform =   "<form action='upload1.php' method='post' enctype='multipart/form-data'>
									Select image to upload:
									<input type='file' name='fileToUpload' id='fileToUpload'>
									<input type='submit' value='Upload Image' name='submit'>
								</form>";
				$goback = '<a href="linkSys.php">go back!</a>';
				genPage($whichform, $msg, $goback);
				break;
			case 'createDir': 
				$msg = "Create Folder: ";
				$whichform =   "<form action='upload1.php' method='post' enctype='multipart/form-data'>
									Select image to upload:
									<input type='file' name='fileToUpload' id='fileToUpload'>
									<input type='submit' value='Upload Image' name='submit'>
								</form>";
				$goback = '<a href="linkSys.php">go back!</a>';
				genPage($whichform, $msg, $goback);
				break;
			case 'delDir': 
				$msg = "Delete Folder: ";
				$whichform =   "<form action='upload1.php' method='post' enctype='multipart/form-data'>
									Select image to upload:
									<input type='file' name='fileToUpload' id='fileToUpload'>
									<input type='submit' value='Upload Image' name='submit'>
								</form>";
				$goback = '<a href="linkSys.php">go back!</a>';
				genPage($whichform, $msg, $goback);
				break;
			default: true ;break;
			
		}
		
	} else {
?> 
<ul>
	<li><a href="?run=up">upload</a></li> 
	<li><a href="?run=down">download</a></li> 
	<li><a href="?run=createDir">create folder</a></li> 
	<li><a href="?run=delDir">delete folder</a></li> 
</ul>
<?php 
	}
?>