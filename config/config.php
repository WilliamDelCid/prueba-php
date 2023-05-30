<?php
if(!isset($_SESSION)){
session_start(); 
}
 
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]. "/sistemacontable/");
define("URL", "https://william2023.me/sistemacontable");
define("DB_USER", 'root');
define("DB_PASSWORD", '');
define("DB_NAME", 'sistemacontable');
define("DB_HOST", 'localhost');
define("BACKUP_DIR", DOCUMENT_ROOT.'backups');
define("TABLES", '*');
define("CHARSET", 'utf8');
define("GZIP_BACKUP_FILE", false); 
define("DISABLE_FOREIGN_KEY_CHECKS", true); 
define("BATCH_SIZE", 1000); 
                           

$reciente = "";
$archivo = "";
foreach(glob(BACKUP_DIR.'/*') as $image) {

	$sql = str_replace(BACKUP_DIR."/","",$image);
    $split = explode(".",$sql);
    $file = $split[0];
    $reciente = $file;
    if ($reciente < $file) {
    	$reciente = $file;
    }

}

define("BACKUP_FILE", trim($reciente.".sql")); 
?>