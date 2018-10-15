<?php

$target_dir = "uploads/";  //uploads/
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);  //uploads/filename.jpg
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);  //jpg

$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
		echo "hello";
		}
		else{
		echo "nah";
		}
?>