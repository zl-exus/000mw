<?php
namespace classes;

$db = new Db;


$logout_url = URL . '/logout.php';

$isAuth = false;

if (isset($_SESSION['user_data']['is_authorized'])) {
    $isAuth = true;
}
if (isset($_SESSION['info_message'])) {
    unset($_SESSION['info_message']);
}

if (isset($_POST['message']['text'])) {

    $parent_message_id = isset($_POST['message']['parent_id']) ? $_POST['message']['parent_id'] : '';

    if (isset($_POST['message']['parent_id'])) {
        $message_text = $_POST['message']['text'];
    }

    $message_text = $_POST['message']['text'];

    $info_message = &$_SESSION['info_message'];
    $user_id = $_SESSION['user_data']['uid'];
    if ($message_text == '') {
        $info_message[] = 'Ваше сообщение не содержит текста';
    }

    if ($db->addMessage($user_id, $message_text, $parent_message_id) == true) {
        $info_message[] = 'Спасибо, Ваше сообщение опубликовано!';
    } else {
        $info_message[] = 'Приносим, своии звинения? но что-то пошло не так(';
    }

    header("Location: /");
    exit;
}


$messages = $db->getMessagesArray('posted', 'DESC');

$messages_with_childs = $db->addChildsIDsField($messages);
//echo '<pre>';
//var_dump($messages_with_childs);
//echo '</pre>';

//$meassages_html = $db->buildMessagesTree($messages_with_childs, $isAuth);
