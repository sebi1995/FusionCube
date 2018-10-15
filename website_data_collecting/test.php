<?php
SESSION_START();
if (!isset($_SESSION['user_email'])) {
?><!DOCTYPE html>
	<html lang = "en">
		<head>  
			<title>MyBox</title>  
		</head> 
		<body>
			<header>
				<article id="reg_form_title"> Registration Form </article>
				
				<form action="test.php" method="post" >
					<div>
						<label for="email">Email*</label>
						<input type="text" name="email" id="email" required="required"/>
						<div id="right_or_wrong">&#10003;</div>
					</div>
					</br>
					<div id="reg_btn"><input type="submit" name="register" value="Register" /></div>
<?php
	if(isset($_POST['register'])){

		require_once('db.php');
				
		$email = mysqli_real_escape_string($con,$_POST['email']);		
		
		$check = 1;
		
		if (!preg_match("/([\a-zA-Z\-]+\@[\a-zA-Z\-]+\.[\a-zA-Z\-]+)/",$email)) {
			echo '<div style="margin-left:20px;">Invalid email format.</div>';
			
			$check = 0;
		}
		else{
			$check = 1;
		}	
		if ($check == 1){
			
			require_once('db.php');
		
			$sel_user = "SELECT * FROM users WHERE user_email='$email'";
			$run_user = mysqli_query($con, $sel_user);
			$check_user = mysqli_num_rows($run_user);
		
			if ($check_user > 0){
				echo 	'Email already exists!</br>
						 <a href="recover.php">Recover Password</a>';
			}
			else{
				echo "Email doesn't exist!";
			}
		}
	}
//else
?>
				</form>

		</header>
	</body> 
</html> 
<?php
	
}
else{
	header('Location: index.php');
}
?>