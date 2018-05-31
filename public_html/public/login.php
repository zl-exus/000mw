<?php
error_reporting(E_ALL);  //установливает уровень отслеживаемости ошибок интерпиртатором
ini_set('display_errors', 1);  //выводить все ошибки в браузер

require_once ("../conf/config.php");
require_once ("../conf/autoload.php");

$vk = new classes\Vk();
$db = new \classes\Db();

if (empty($_GET['code'])) {
    header("Location: /");
} else {
    $token = $vk->getToken($_GET['code']);

    $user_data = &$_SESSION['user_data'];
    $user_data['token'] = $token['token'];
    $user_data['user_id'] = $token['user_id'];
    $user_data['first_name'] = $token['first_name'];

    if (!$db->isRegstredVk($user_data)) {
        $db->addUserVk($user_data);
    }

    print_r($user_data);
    die();

    header("Location: /");
}

