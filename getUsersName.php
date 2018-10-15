<?php
require_once('website_data_collecting/db.php');
			$sql = "SELECT user_name FROM user_login WHERE user_email = '$currentUser'";	

			$result = $con->query($sql);
			$msql_name = $result->fetch_assoc();
			$sql_fname = $msql_name['user_name'];
?>