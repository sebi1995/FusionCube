<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dropbox";

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    die("MySQLi Connection was not established: " . mysqli_connect_error());
} 
//echo "Connected successfully";
?>