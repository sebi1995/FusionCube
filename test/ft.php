<?php 

/* function(){}
function(){}
function(){} */


if (isset($_GET['run'])){
	$linkchoice=$_GET['run'];
		$hick = "<form action='upload1.php' method='post' enctype='multipart/form-data'>
									Select image to upload:
									<input type='file' name='fileToUpload' id='fileToUpload'>
									<input type='submit' value='Upload Image' name='submit'>
								</form>";;
	function genPage(){
		
		$linkchoice=$_GET['run'];
		$trim = "";
		$temp = tmpfile();
		
		function up(){
			global $hick;
			$temp = tmpfile();
			if ($temp != false){
				fwrite($temp, "	<?php 
								?>
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
													".$hick."
												</span>
											</div>
										</div>
									</body>
								</html>");
		fseek($temp, 0);
		echo fread($temp, 10240);
		fclose($temp); // this removes the file
	} else {
		echo"false";
	}
	
	
		
		}
		function down(){
			 	"	<form action='upload1.php' method='post' enctype='multipart/form-data'>
							Select image to download:
							<input type='file' name='fileToUpload' id='fileToUpload'>
							<input type='submit' value='Upload Image' name='submit'>
						</form>";
		}
		return $linkchoice();
	}
} else {
	$linkchoice='';
}


 
?>
<html>
	<body> 
		<ul>
			<li><a href="?run=up">upload</a></li> 
			<li><a href="?run=down">download</a></li> 
			<li><a href="?run=createDir">create folder</a></li> 
			<li><a href="?run=delDir">delete folder</a></li> 
		</ul>
		<br/>
		<div>
			<?php 
				 switch($linkchoice){ 
	case 'up' : 		
		$trip = genPage();
		echo $trip;break; 
	case 'down' : 		
		$trip = genPage();
		echo $trip;break; 
	case 'createDir' :
		$trip = genPage();
		echo $trip;break; 
	case 'delDir' : 	
		$trip = genPage();
		echo $trip;break; 
	default: ;
} 
			?>
		</div>
	</body>
</html>

<?php
?>