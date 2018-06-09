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

require_once ("../conf/hid_conf.php");  // Hidden data for connection to DB, VK-APP, etc. !!! Comment this string and uncomment the lines below

//define("DB_NAME", 'your_db_name');
//define("DB_USER", 'your_db_user_name');
//define("DB_PASS", 'your db_pass');
//define("DB_HOST", 'your_host');
//     
//
//define("APP_ID", 'your_app_id');
//define("APP_SECRET", 'your_app_secret');