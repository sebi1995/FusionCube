<?php
	function is_hidden_file($fn) {
        $dir = "\"".$fn."\"";
        $attr = trim(shell_exec("FOR %A IN (".$dir.") DO @ECHO %~aA"));
        if($attr[3] === 'h')
            return true;

        return false;
    }

	if (isset($_GET['run'])){
		$linkchoice=$_GET['run']; 		
 		require_once('genpage.php');
	} else {
		$dir = "uploads/admin@admin.com/";
		$getDir = scandir($dir);
	
		echo "<ul>";
		foreach($getDir as $rows){
			$ftype = "";
			if (is_hidden_file($dir.$rows) || $rows == '.' || $rows == '..' || $rows[0]=='.' || $rows[0]=='~' ) {
                continue;
			} else {
				if(is_dir($dir.$rows)){
					$ftype = "Folder";
					echo 	"<li><b>".$ftype.": ".$rows."</b>
								<ul>
									<li><a href='?run=delete.$dir$rows'>Delete ".$ftype."</a></li>
									<li><a href='?run=rename.$dir$rows'>Rename ".$ftype."</a></li>
									<li><a href='?run=download.$dir$rows'>Download ".$ftype."</a></li>
								</ul>
							</li>";
				}
				else {
					$ftype = "File";
					echo 	"<li><b>".$ftype.": ".$rows."</b>
								<ul>
									<li><a href='?run=delete.$dir$rows'>Delete ".$ftype."</a></li>
									<li><a href='?run=rename.$dir$rows'>Rename ".$ftype."</a></li>
									<li><a href='?run=download.$dir$rows'>Download ".$ftype."</a></li>
								</ul>
							</li>";
				}
			}
		}
		echo "</ul>";
	}
	 
	 
	/* $files = array("New Folder", "random", "w.e");
	
	foreach($files as $rows){
		echo "<a href='?put=delete.$rows'>$rows</a><br>";
		echo "<a href='?put=rename.$rows'>$rows</a><br>";
	}
	
	if(!isset($_GET['put'])){
		
		$_GET['put'] = "";
		
	} else {
		
		echo "<br>".$_GET['put']."---put<br>";
		
		switch($_GET['put']){
			case (substr($_GET['put'], 0, 6)) == "delete": 
				echo "delete"; break;
			case (substr($_GET['put'], 0, 6)) == "rename": 
				echo "rename"; break;
			default: echo "hmmm"; break; 
		}
	} */
	
	/* switch($_GET['run']){
			case (substr($_GET['run'], 0, 6)) == "delete": 
				echo 	"delete<br>
						<a href='test.php'>back</a>"; 
				break;
			case (substr($_GET['run'], 0, 6)) == "rename": 
				echo 	"rename<br>
						<a href='test.php'>back</a>";
				break;
			default: echo "hmmm"; break; 
		} */
	
	
	/* echo rep("admin@admincom");
	function rep($s){
		$l = strlen($s);
		
		if ($s[0] == "." || $s[$l-1] != "."){
			return substr($s, 1);
		}
		else {
			return rep(substr($s, 1));
		}
	} */
?>
