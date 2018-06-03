<?php
namespace classes;

$db = new Db;

$logout_url = URL . '/logout.php';

$isAuth = false;

if (isset($_SESSION['user_data']['is_authorized'])) {
    $isAuth = true;
}

if (isset($_POST['message']['text'])) {
    $message_text = $_POST['message']['text'];
    $user_id = intval($_POST['user-id']);


    $db->addMessage($user_id, $message_text);
}

$messages = $db->getMessagesArray();

