<?php
$dir = "/xampp/htdocs/host/uploads/";

echo "dir: " . $dir . "<br/>";

if (is_dir($dir)){
	$tf = "yes";
} else {
	$tf = "no";
}
echo "is it a dir?" . $tf . "<br/>";

echo "open dir: " . opendir($dir) . "<br/>";

$dh = opendir($dir);
echo "dh: " . $dh . "<br/>";
echo readdir($dh) . "<br/>";
echo readdir($dh) . "<br/>";
echo readdir($dh) . "<br/>";
echo readdir($dh) . "<br/>";
echo readdir($dh) . "<br/>";
echo readdir($dh) . "<br/>";
echo readdir($dh) . "<br/>";
echo filetype($dir . (readdir($dh))) . "<br/>";

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            echo 	"	filename: <a href='$dir.$file'>$file</a> : 
						filetype: " . filetype($dir . $file) . 
					" 	File Size: " . filesize($dir.$file) . " mb" . "<br/>";
        }
        closedir($dh);
    }
}
?>