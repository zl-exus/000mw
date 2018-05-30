<?php
include '../conf/config.php';

if (!$_GET['code']) {
exit('Error code');
}
$token = json_decode(file_get_contents('https://oauth.vk.com/access_token?client_id=' . APP_ID . '&redirect_uri=' . URL . '&client_secret='. APP_SECRET. '&code=' . $_GET['code'].'&v=5.52'), true);
if (!$token) {
exit('Error token');
}
echo 'token<br />';
print_r($token);
echo '<br />';
$data = json_decode(file_get_contents('https://api.vk.com/method/users.get?user_id=' . $token['user_id']. '&access_token=' . $token['access_token'] . '&fields=uid,first_name,last_name,&v=5.52'), true);

if (!$data) {
exit('Error data');
}
$data = $data['response'][0];
echo 'data <br/>';
print_r($data);

