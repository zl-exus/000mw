<?php

function getProtocol()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    
    return $protocol;
}

define("PROTOCOL", getProtocol());

define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("MODEL_PATH", ROOT . '/models/');
define("CLASSES", ROOT . '/classes/');
define("TEMPLATE_PATH", ROOT . '/templates/');


define("URL", PROTOCOL . $_SERVER['HTTP_HOST']); 

require_once ("../conf/hid_conf.php");  // Hidden data for connection to DB, VK-APP, etc.
