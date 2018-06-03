<?php
error_reporting(E_ALL);  //установливает уровень отслеживаемости ошибок интерпиртатором
ini_set('display_errors', 1);  //выводить все ошибки в браузер

require_once ("../conf/config.php");
require_once ("../conf/autoload.php");

$vk = new classes\Vk();
$db = new classes\Db();

session_start();

if (!empty($_GET['code'])) {

    $token = $vk->getToken($_GET['code']);

    if (!empty($token)) {
        $data = $vk->getData($token);
        $_SESSION['user_data'] = [];
        $user_data = &$_SESSION['user_data'];
        $user_data['uid'] = $data['id'];
        $user_data['first_name'] = $data['first_name'];
        $user_data['last_name'] = $data['last_name'];
        $user_data['is_authorized'] = 1;
        if ($db->isRegstredVk($user_data) == false) {
            $db->addUserVk($user_data);
        }
    }
    header("Location: /");
} else {
    header("Location: /");
}