<?php 
SESSION_START();
if (!isset($_SESSION['user_email'])) {
$rw_name = '';
$rw_surname = '';
$rw_email= '';
$rw_pass = '';
$rw_cpass = '';    //&#10003;
$warnings = array();

if(isset($_POST['register'])){
	require_once('website_data_collecting/db.php');	
	$title = 	$_POST['title'];			
	$name =  	mysqli_real_escape_string($con, $_POST['name']);			
	$surname =  mysqli_real_escape_string($con, $_POST['surname']);
	$email =  	mysqli_real_escape_string($con, $_POST['email']);
	$pass = 	mysqli_real_escape_string($con, $_POST['password']);
	$cpass = 	mysqli_real_escape_string($con, $_POST['cpassword']);
	
	$check = 1;
	
	if (strlen($name) < 3){
		$warnings[] = 'Name cannot be less than 3 characters.';
		$rw_name = 'X';
		$check = 0;	
	} else $rw_name = '&#10003;';
	
	if (strlen($surname) < 3){
		$warnings[] = 'Surname cannot be less than 3 characters.';
		$rw_surname = 'X';
		$check = 0;
	} else $rw_surname = '&#10003;';
	
	if (!preg_match("/([\a-zA-Z\-]+\@[\a-zA-Z\-]+\.[\a-zA-Z\-]+)/",$email)) {
		$warnings[] = 'Invalid email format.';
		$rw_email = 'X';
		$check = 0;
	} else $rw_email = '&#10003;';
	
	if (strlen($pass) <= 3){
		$warnings[] = 'Password must be more than 3 characters.';
		$rw_pass = 'X';
		$check = 0;
	} else $rw_pass = '&#10003;';
	
	if ($pass != $cpass){
		$warnings[] = 'Passwords do not match.';
		$rw_cpass = 'X';
		$check = 0;
	} else $rw_cpass = '&#10003;';
	
	if ($check == 1){
		require_once('website_data_collecting/db.php');
		
		$sel_user = "SELECT * FROM user_login WHERE user_email='$email'";
		$run_user = mysqli_query($con, $sel_user);
		$check_user = mysqli_num_rows($run_user);
		
		if ($check_user > 0){
			$warnings[] = 'Email already exists!';
			$warnings[] = '<a href="#">Recover Password</a>';
		}
		else{
			$user_login = "INSERT INTO user_login (user_name, user_email, user_password) VALUES ('$name', '$email', '$pass')";
			$user_data = "INSERT INTO user_data (user_title, user_name, user_surname) VALUES ('$title', '$name', '$surname')";
			
			if($con->query($user_login) === TRUE && $con->query($user_data) === TRUE){
				$warnings[] = 'Entered data successfully';
			} else {$warnings[] = die('Could not enter data: ' . mysql_error());}
			
		}
	}			
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My DropBox</title>
		<link rel="stylesheet" type="text/css" href="layout.css" media="screen" charset="utf-8" />  
		<link rel="stylesheet" type="text/css" href="css/register.css" media="screen" charset="utf-8" />  
	</head>
	
	<body>
		<div id="top_bar">
			<a href="login.php"><span>Log In</span></a>
		</div>
		<div id="main_wrapper">
			<div id="sub_wrapper">
				<div id="sub_title">
					<b>Register</b>
				</div>
				<div id="sub_form">
					<form action="register.php" method="post">
						<div>
							<label for="title">Title</label>
							<select name="title" required="required">
								<option value="" selected="selected">Select...</option>
								<option value="Mr">Mr</option>
								<option value="Mrs">Mrs</option>
								<option value="Ms">Ms</option>
								<option value="Miss">Miss</option>
							</select>				
						</div>
						
						<div>
							<label for="name">Name</label>
							<input type="text" name="name" id="name" required="required"/> <!-- required="required" -->
							<div id="right_or_wrong"><?php echo $rw_name;?></div>
						</div>
					
						<div>
							<label for="surname">Surname</label>
							<input type="text" name="surname" id="surname" required="required"/>
							<div id="right_or_wrong"><?php echo $rw_surname;?></div>
						</div>
					
						<div>
							<label for="email">Email</label>
							<input type="text" name="email" id="email" required="required"/>
							<div id="right_or_wrong"><?php echo $rw_email;?></div>
						</div>
					
						<div>
							<label for="password">Password</label>
							<input type="password" name="password" id="password" required="required"/>
							<div id="right_or_wrong"><?php echo $rw_pass;?></div>
						</div>
				
						<div>
							<label for="cpassword">Confirm Password</label>
							<input type="password" name="cpassword" id="cpassword" required="required"/>
							<div id="right_or_wrong"><?php echo $rw_cpass;?></div>
						</div>
			
						
						<div>
							<b>
								<?php 
									foreach($warnings as $a){
										if($a !== "") echo $a.'<br>';
									}
								?>
							</b>
						</div>
						<input id="register_btn" type="submit" name="register" value="Register" />
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
}
?>