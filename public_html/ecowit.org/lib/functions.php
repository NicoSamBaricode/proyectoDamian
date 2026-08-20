<?php

require_once __DIR__ . '/../../config/database.php';

function chmod_R($path, $filemode) {
    if (!is_dir($path))
        return chmod($path, $filemode);
    $dh = opendir($path);
    while ($file = readdir($dh)) {
        if($file != '.' && $file != '..') {
            $fullpath = $path.'/'.$file;
            if(!is_dir($fullpath)) {
                if (!chmod($fullpath, $filemode))
                    return FALSE;
            } else {
                if (!chmod_R($fullpath, $filemode))
                    return FALSE;
            }
        }
    }
    closedir($dh);
    if(chmod($path, $filemode))
        return TRUE;
    else
        return FALSE;
}

function paginar($actual, $total, $por_pagina, $enlace) {
    $total_paginas = ceil($total/$por_pagina);
    $anterior = $actual - 1;
    $posterior = $actual + 1;
    if ($actual>1)
        $texto = "<a href=\"$enlace$anterior\">&laquo;</a> ";
    else
        $texto = "<b>&laquo;</b> ";
    for ($i=1; $i<$actual; $i++)
        $texto .= "<a href=\"$enlace$i\">$i</a> ";
    $texto .= "<strong>$actual</strong> ";
    for ($i=$actual+1; $i<=$total_paginas; $i++)
        $texto .= "<a href=\"$enlace$i\">$i</a> ";
    if ($actual<$total_paginas)
        $texto .= "<a href=\"$enlace$posterior\">&raquo;</a>";
    else
        $texto .= "<b>&raquo;</b>";
    return $texto;
}

function send($text){
    header("Content-type: text/html; charset=utf-8");
    echo utf8_encode($text);
}

function getPdoConnection(string $dbname, string $user, string $pass): PDO
{
    $host = getenv('MYSQL_HOST') ?: 'db';
    $charset = 'utf8mb4';
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    return new PDO($dsn, $user, $pass, $options);
}

function conectarse(){
    return getPdoConnection('sitio_mscb', 'root', 'cavaliere');
}

function conectarse_boletin(){
    return getPdoConnection('boletinoficial', 'juanma', 'nahuel');
}

function conectarse_protocolo(){
    return getPdoConnection('protocolo', 'root', 'nahuel');
}

function cambiaf_a_normal($fecha){
    if (preg_match("/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/", $fecha, $mifecha)) {
        $lafecha = $mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
        return $lafecha;
    }
    return $fecha;
}

function cambiaf_a_mysql($fecha){
    if (preg_match("/([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})/", $fecha, $mifecha)) {
        $lafecha = $mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
        return $lafecha;
    }
    return $fecha;
}

function lngBuscaId($txtTabla,$lngId){
    $pdo = conectarse();
    $stmt = $pdo->prepare("SELECT MAX($lngId) FROM $txtTabla");
    $stmt->execute();
    $result = $stmt->fetchColumn();
    if ($result !== false && $result !== null) {
        return (int)$result + 1;
    }
    return 1;
}

function GetIP(){
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown") !== 0) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown") !== 0) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    } elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown") !== 0) {
        $ip = getenv("REMOTE_ADDR");
    } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown") !== 0) {
        $ip = $_SERVER['REMOTE_ADDR'];
    } else {
        $ip = "unknown";
    }
    return($ip);
}

function extension($img){
    $filename=$img;
    if (($pos = strrpos($filename, ".")) === FALSE) {
        echo "Error - file doesn't have a dot... weird.";
    } else {
        $extension = substr($filename, $pos + 1);
    }
    if (($pos = strrpos($filename, "/")) === FALSE) {
    } else {
        $name = substr($filename, $pos + 1);
    }
    return $extension ?? '';
}

function thumb($img,$ancho,$alto,$destino){
    $filename=$img;
    if (($pos = strrpos($filename, ".")) === FALSE) {
        echo "Error - file doesn't have a dot... weird.";
    } else {
        $extension = substr($filename, $pos + 1);
    }
    if (($pos = strrpos($filename, "/")) === FALSE) {
    } else {
        $name = substr($filename, $pos + 1);
    }
    
    if (in_array(strtolower($extension), ['jpeg','jpg','JPG'])){
        $fuente = @imagecreatefromjpeg($img);
        $imgAncho = imagesx($fuente);
        $imgAlto = imagesy($fuente);
        $imagen = imagecreatetruecolor($ancho,$alto);
        imagecopyresampled($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
        imagejpeg($imagen,$destino."tn_".$name);
    }
    elseif ($extension=="gif"){
        $fuente = @imagecreatefromgif($img);
        $imgAncho = imagesx($fuente);
        $imgAlto = imagesy($fuente);
        $imagen = imagecreatetruecolor($ancho,$alto);
        imagecopyresampled($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
        imagegif($imagen,$destino."tn_".$name);
    }
    elseif ($extension=="bmp"){
        $fuente = @imagecreatefromwbmp($img);
        $imgAncho = imagesx($fuente);
        $imgAlto = imagesy($fuente);
        $imagen = imagecreatetruecolor($ancho,$alto);
        imagecopyresized($imagen,$fuente,0,0,0,0,$ancho,$alto,$imgAncho,$imgAlto);
        imagewbmp($imagen,$destino."tn_".$name);
    }
    else echo "extension no reconocida (".$extension.")";
    chmod_R(realpath("tmp"),0777);
    chmod(realpath("tmp"),0777);    
}

function codificador_hexa ($email_address) {
    $codificado = bin2hex("$email_address");
    $codificado = chunk_split($codificado, 2, '%');
    $codificado = '%' . substr($codificado, 0, strlen($codificado) - 1);
    return $codificado;
}

function cut_string($string, $charlimit){
    if(substr($string,$charlimit-1,1) != ' '){
        $string = substr($string,'0',$charlimit);
        $array = explode(' ',$string);
        array_pop($array);
        $new_string = implode(' ',$array);
        return $new_string.' ...';
    }
    else{
        return substr($string,'0',$charlimit-1).' ...';
    }
}

function exten($img){
    $filename=$img;
    if (($pos = strrpos($filename, ".")) === FALSE) {
        echo "Error - file doesn't have a dot... weird.";
    } else {
        $extension = substr($filename, $pos + 1);
    }
    if (($pos = strrpos($filename, "/")) === FALSE) {
    } else {
        $name = substr($filename, $pos + 1);
    }
    
    if (in_array(strtolower($extension), ['jpeg','jpg','JPG','gif','bmp'])){
        return true;
    }
    return false;
}

function resizeimage($image,$wr){
    $size = getimagesize($image);
    $wo=$size[0];
    $ho=$size[1];
    $hr=($wr*$ho)/$wo;
    return $hr;
}

function getSector($id_sector){
    $pdo = conectarse();
    $stmt = $pdo->prepare("
        SELECT a.id_sector,a.descripcion,a.direccion,a.telefono,a.mail,
               b.id_sector,b.descripcion,b.direccion,b.telefono,b.mail,
               c.id_sector,c.descripcion ,c.direccion,c.telefono,c.mail,a.mail2
        FROM sectores a, sectores b, sectores c
        WHERE a.id_subsector=b.id_sector
        AND b.id_subsector=c.id_sector
        AND a.id_sector=?
    ");
    $stmt->execute([$id_sector]);
    $row = $stmt->fetch(PDO::FETCH_NUM);
    if ($row) {
        return $row;
    }
    return null;
}

function getGrupo($id_grupo){
    $pdo = conectarse();
    $stmt = $pdo->prepare("SELECT * FROM contenidos_grupos WHERE id_grupo=?");
    $stmt->execute([$id_grupo]);
    $row = $stmt->fetch();
    if ($row) {
        return $row["grupo"];
    }
    return null;
}

function getId_Sector($id_grupo){
    $pdo = conectarse();
    $stmt = $pdo->prepare("
        SELECT COUNT(*), b.id_sector 
        FROM contenidos a, contenidos b
        WHERE a.id_grupo=?
        AND a.id_contenido=b.id_contenido
        GROUP BY a.id_grupo
    ");
    $stmt->execute([$id_grupo]);
    $row = $stmt->fetch();
    if ($row) {
        return $row["id_sector"];
    }
    return NULL;
}

function fecha_enc(){ 
    $mes = date("n"); 
    $mesArray = array( 
        1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 
        5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 
        9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre" 
    ); 
    $semana = date("D"); 
    $semanaArray = array( 
        "Mon" => "Lunes", "Tue" => "Martes", "Wed" => "Miercoles", 
        "Thu" => "Jueves", "Fri" => "Viernes", "Sat" => "Sábado", "Sun" => "Domingo"
    ); 
    $mesReturn = $mesArray[$mes]; 
    $semanaReturn = $semanaArray[$semana]; 
    $dia = date("d"); 
    $ano = date("Y"); 
    return $dia." de ".$mesReturn." de ".$ano; 
}

function fechanueva($fechavieja){
    list($a,$m,$d)=explode("-",$fechavieja);
    return $d."-".$m."-".$a;
};    

function convierte_fecha_hora($fechahora){
    list($fecha,$hora)=explode(" ",$fechahora);
    list($a,$m,$d)=explode("-",$fecha);
    list($hor,$min,$seg)=explode(":",$hora);
    return $d."-".$m."-".$a." ".$hor.":".$min.":".$seg;
};