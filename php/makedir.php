<?php 
$_SESSION["email"] = "nahbrah";
$structure = 'uploads/' . $_SESSION["email"] . '';

// To create the nested structure, the $recursive parameter 
// to mkdir() must be specified.

if (!mkdir($structure, 0777, true)) {
    die('Failed to create folders...');
}

?>