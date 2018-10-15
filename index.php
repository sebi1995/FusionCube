<?php 
SESSION_START();
if (isset($_SESSION['user_email'])) {
	if (isset($_GET['run'])){
		$linkchoice=$_GET['run'];
	} else $linkchoice = "";
	/* 	
		require_once('genpage.php');
		
	} else { $_GET['run'] = "";} */
?> 
<!DOCTYPE html>
<html>
	<head>
		<title>My DropBox</title>
		<link rel="stylesheet" type="text/css" href="layout.css" media="screen" charset="utf-8" />  
		<link rel="stylesheet" type="text/css" href="css/index.css" media="screen" charset="utf-8" />  
	</head>
	
	<body>
		<div id="top_bar">
			<a href="?log=out"><span>Log out</span></a>
					<?php 
						if (isset($_GET['log'])){
							$unlink=$_GET['log'];
							if($unlink == "out"){
								session_destroy();
								header("Refresh:0");
							}
						
						}
					?>
		</div>
		<div id="main_wrapper">
			<div id="sub_wrapper_i">
				<div id="sub_filenav">
					<span>
						Navigation
					</span>
					<span>
						<!-- Dist -->
					</span>
					<span>
						nav <br/>
						nav <br/>
						nav <br/>
						nav <br/>
						nav <br/>
						nav <br/>
					</span>
				</div>
				<div id="sub_title_i">
					Welcome
				</div>
				<span>
					<!-- Dist -->
				</span>
				<!-- <div id="sub_form_i"> -->
					<?php 
						require_once('finalnav.php');
						navDir($_SESSION['user_email']);
						// navDir($_SESSION['user_email']);
					?>
				<!-- </div> -->
				<span id="sub_form_options_bar"></span>
				<div id="sub_form_options">
					<ul>
						<li><a href="?run=up">upload</a></li> 
						<li><a href="?run=down">download</a></li> 
						<li><a href="?run=createDir">create folder</a></li> 
						<li><a href="?run=delDir">delete folder</a></li> 
					</ul>
				</div>
			
				<div id="sub_nav">
					<nav>
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="#">Subscribe!</a></li>
							<li><a href="#">About</a></li>
							<li><a href="#">Contact</a></li>
							<li><a href="#">Feedback</a></li>
						</ul>
					</nav>
				</div>
				<div id="sub_footer">
					<footer>
						<span>	Copyright &copy; 				<br/>
								Sebastian Zdroana M00495434		<br/>
								Zdroanasebastian@hotmail.co.uk	</span>
					</footer>
				</div>
			</div>
		</div>
	</body>
</html>
<?php 
} else {
	header('Location: login.php');
}
?>