<?php
namespace classes;

$db = new Db;

if (!isset($_SESSION['user_data'])) {
    session_start();
    
    if (isset($_GET['code'])) {
        $vk = new Vk();
        $token = $vk->getToken($_GET['code']);
        $data = $vk->getData($token);
        $_SESSION['user_data'] = $data;
        
        if (!$db->isRegstredVk($data)) {
            $db->addUserVk($data);
        }

        header("Location: /");
    }
}  else {
    print_r($_SESSION['user_data']);
}



if (isset($_POST['message']['text'])) {
    $message_text = $_POST['message']['text'];
    $user_id = intval($_POST['user-id']);


    $db->addMessage($user_id, $message_text);
}

$messages = $db->getMessagesArray();

