<?php 
SESSION_START();
if(!isset($_SESSION['user_email'])){
$errorList = array();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My DropBox</title>
		<link rel="stylesheet" type="text/css" href="layout.css" media="screen" charset="utf-8" />  
		<link rel="stylesheet" type="text/css" href="css/login.css" media="screen" charset="utf-8" />  
	</head>
	
	<body>
		<div id="top_bar">
			<a href="register.php"><span>Register</span></a>
		</div>
		<div id="main_wrapper">
			<div id="sub_wrapper">
				<div id="sub_title">
					<b>Welcome</b>
				</div>
				<div id="sub_form">
				<?php 
if(isset($_POST['login'])){
	require_once('website_data_collecting/db.php');
	
	$email = mysqli_real_escape_string($con,$_POST['email']);
	$pass = mysqli_real_escape_string($con,$_POST['pass']);			

	$sel_user_and_pass = "SELECT * FROM user_login WHERE user_email='$email' AND user_password='$pass'";

	$run_user = mysqli_query($con, $sel_user_and_pass);	
	$check_user = mysqli_num_rows($run_user);
	// $errorList[] = 'qwe';
	
	if ($check_user > 0){
		$_SESSION['user_email'] = $email;
		header("Refresh:0");
	} else {
		echo "<script>alert('Email or password is not correct, try again!')</script>";
		// $_SESSION['count']++;
	
		/* require_once('errorWrite.php');
			$errorName = "username and password does not match any of the ones on the database";
		writeError($errorName, $errorPage); */
	}
}
?>
					<form action="login.php" method="post" >
						<div class="form_intitle">
							Username
						</div>
						<div class="form_input">	
							<input type="text" name="email" class="inputs" required="required"/>
							<!--id="email"-->
						</div>
						<div class="form_intitle">	
							Password
						</div>
						<div class="form_input">
							<input type="password" name="pass" class="inputs" required="required">
							<!--id="password"-->
						</div>
						<div id="login_btn">
							<input type="submit" name="login" value="Login" id="login_btn"/>
							</br>
							<article style="font-size: 10px;">Forgot password?</article>
						</div>
						<div id="login_msg">
							<b>	<?php 
									foreach($errorList as $a){
										if($a !== "") echo $a.'<br>';
									}
								?>
							</b>
						</div>
					</form>
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
	header('Location: index.php');
}?>