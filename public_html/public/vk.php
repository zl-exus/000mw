<?php
include '../conf/config.php';
if (!$_GET['code']) {
    exit('Error');
    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token?client_id=' . APP_ID . '&redirect_uri=' . URL . '&client_secret='. APP_SECRET. '&code=' . $_GET['code']), true);
if (!$token) {
    exit('Error');
}  

var_dump($token);
    
}
