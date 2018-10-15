<?php
									$r = getcwd();
					$files2 = scandir($r, 1);
	global $tt;
	
	
	$p= "./";
	
	if ($r == ""){
		$r = $p;
	}
	else{
		echo "hello:       " . $r . "<br/><br/><br/>";
		echo "hello:       " . $_SERVER['PHP_SELF'] . "<br/><br/><br/>";
	
		$files1 = scandir($r);
		$files2 = scandir($r, 1);
		$files3 = scandir($r, 2);
		
		print_r($files2);
		echo '<br/>';
		echo '<br/>';
		echo '<br/>';
		echo '<br/>';
		foreach($files2 as $print1){
			$pp = $_SERVER['PHP_SELF'];
			if (is_dir($print1)){
				echo "FOLDER: <a href='$pp?=$print1'>".$print1."</a><br/>";
				
				echo '@@@:   '.$files2.'n';
			
			
				
				
			} else {
				echo '<br/>FILE: '.$print1.'<br/>';
			}
		}
		
		?>
			<br/><br/><a href="?run=back">Back</a>
		<?php
		if(isset($_GET['run'])){
			str_replace("../","",$_GET['n']);
		}
		
		
		/*  $navC = str_replace("./","",$navC); */
	}  
	
		// current directory
echo getcwd() . "<br/>";

chdir('css');

// current directory
echo getcwd() . "\n";
?>