<?php 

///// functions ///// 

function myFirst($number){ 
    echo 'The '.$number.' ran successfully.'; 
} 

function mySecond($number){ 
    echo 'The '.$number.' ran successfully.'; 
} 

///// START ///// 

?> 
<html>
	<body> 

	<?php 

		if (isset($_GET['run'])){
			$linkchoice=$_GET['run']; 
			$number = $linkchoice;
		} else {
			$number = $linkchoice='';
		}

		switch($number){ 
			case 'first' : myFirst($number); break; 
			case 'second': mySecond($number); break; 
			default: echo $number.' no run'; 

		} 

	?> 
	<hr> 
	<a href="?run=first">Link to First</a> 
	<br> 
	<a href="?run=second">Link to Second</a> 
	<br> 
	<a href="?run=0">Refresh No run</a> 

	</body>
</html>