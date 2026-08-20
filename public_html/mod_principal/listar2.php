<?php
$dir = "../ejersicios";
 
// Abre un directorio conocido, y procede a leer el contenido
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            //echo "nombre archivo: $file : tipo archivo: " . filetype($dir . $file) . "\n";
			//echo "nombre archivo: ".$file."<br>";
			if($file=="1.xls"){
			echo "<a href='../ejersicios/$file' class='enlace' onmouseover='window.status='El Portal del WebMaster';return true' onmouseout='window.status='';return true'>$file</a><br>";
			}
        }
        closedir($dh);
    }
}
?>
