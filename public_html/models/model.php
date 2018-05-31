<?php
namespace classes;

$db = new Db;



if (isset($_POST['message']['text'])) {
    $message_text = $_POST['message']['text'];
    $user_id = intval($_POST['user-id']);


    $db->addMessage($user_id, $message_text);
}

$messages = $db->getMessagesArray();

