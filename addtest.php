<?php
require_once('website_data_collecting/db.php');


$sql = "INSERT INTO tes1t (user_name, user_email, user_password) VALUES ('$name', '$email', '$pass')";

if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $con->error;
}

$con->close();
?>