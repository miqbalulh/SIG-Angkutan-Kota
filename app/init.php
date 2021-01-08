<?php 

require_once '../vendor/autoload.php';

require_once 'Core/Route.php';
require_once 'Core/Controller.php';


require_once 'Database.php';

// $GLOBALS['path'] = '/sigangkot/public';
$GLOBALS['path'] = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$GLOBALS['path'] .= "://".$_SERVER['HTTP_HOST'];
$GLOBALS['path'] .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);