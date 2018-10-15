
<?php
$errUname = "";
$errPass = "";
$errPass1 = "";

if(isset($_POST['register'])){
	$errUname = "Invalid username!";
	$errPass = "Password must be longer than 3 characters!";
	$errPass1 = "Password must be longer than 3 characters!";
}
?>
<form action="test.php" method="post">
		<label for="name">Name</label>
		<input type="text" name="name" id="name" />
		
		<label for="name">Password</label>
		<input type="password" name="password" id="password" />

		<input id="hidden" type="submit" name="register" value="Register" />
		
		<div>
			<?php 
				echo $errUname . "<br/>"; 
				echo $errPass1 . "<br/>";
				echo $errPass . "<br/>";
			?>
		</div>
	</form>