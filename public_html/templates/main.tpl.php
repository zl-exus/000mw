<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="manifest" href="site.webmanifest">
        <link rel="apple-touch-icon" href="icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/styles.min.css">
    </head>

    <body>
        <!--[if lte IE 9]>
          <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>Стена сообщений</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="strict">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wrap">
                            <?php if ($isAuth == false) : ?>
                                <div class="soc">
                                    <h4>Для добавления и комментирования сообщений выполните вход</h4>
                                    <div class="fb-block">
                                        <a href="https://oauth.vk.com/authorize?client_id=<?= APP_ID; ?>&display=page&redirect_uri=<?= URL; ?>/login.php&response_type=code&v=5.52">Войти через</a>
                                        <img src="../img/vk.svg" alt="vk">
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="form-wrap">
                                    <form id="message" method="post">
                                        <div class="form-group">
                                            <label for="messageForm">Введите сообщение</label>
                                            <input id="user-id" name="user-id" type="hidden" value="">
                                            <textarea class="form-control" id="messageForm" rows="3" name="message[text]"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Опубликовать</button>
                                        <a href="<?= $logout_url; ?>" class="btn btn-primary">Выйти</a>
                                    </form>
                                    <div class="info-block">
                                        <div class="info-message">
                                            <h3><?php if (isset($_SESSION['info_message'][0])) echo $_SESSION['info_message'][0]; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="message-block">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    <?php
                    foreach ($messages_with_childs as $message) :
                        if ($message['parent_post_id'] == 0) {
                            echo $db->buildMessagesTree($message, $messages_with_childs, false,$isAuth);
                        }
                    endforeach;
                    ?>
                    </div>
                    <div id="form">
                        <form id="comment" method="post">
                            <div class="form-group">
                                <label for="commentForm">Введите текст комментария</label>
                                <input id="user-id" name="user-id" type="hidden" value="">
                                <input id="parent-mes-id" name="message[parent_id]" type="hidden" value="">
                                <textarea class="form-control" id="commentForm" rows="3" name="message[text]"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Опубликовать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="urid" class="info"></div>
        <script src="js/libs.min.js"></script>
        <script src="js/main.min.js"></script>
    </body>

</html>
