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
                    <h1>Стена сообщений</h1>
                </div>
            </div>
        </div>
        <div class="strict">
            <div class="container">
                <div class="row">
                    <div class="fb-block">
                        <a href="https://oauth.vk.com/authorize?client_id=<?= APP_ID; ?>&display=page&redirect_uri=<?= URL; ?>&response_type=code&v=5.52">Войти через VK</a>
                    </div>
                    <div class="form-wrap">
                        <form id="message" method="post">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Введите сообщение</label>
                                <input id="user-id" name="user-id" type="hidden" value="">            <!-- добавить id пользователя-->
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message[text]"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Опубликовать</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="message-block">
            <div class="container">
                <div class="row">
                    <?php foreach ($messages as $message) : ?>
                        <div id="message_id-<?= $message['post_id']; ?>" class="message col-12" data-id="<?= $message['post_id']; ?>">
                            <div class="post-header">
                                <div class="author"><a href="#message-<?= $message['post_id']; ?>">Андрей <?= $message['author_id']; ?> опубликовал <?= $message['posted']; ?></a></div>
                            </div>
                            <div class="message-text">
                                <?= $message['post_text']; ?>
                            </div>
                            <div class="answ-block">
                                <a href="#" class="answ-link">Комментировать</a>
                            </div>
                            <?php if ($message['has_children'] != 0) : // надо подумать как выводить коменты

                                ?>
                                <div class="comment" data-id="4">
                                    <div class="post-header">
                                        <div class="author">Изабелла</div>
                                        <div class="posted">27.05.18 в 18:00</div>
                                    </div>
                                    <div class="message-text">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                    <div class="answ-block">
                                        <a href="#" class="answ-link">Комментировать</a>
                                    </div>
                                    <div class="comment" data-id="4">
                                        <div class="post-header">
                                            <div class="author">Андрей</div>
                                            <div class="posted">27.05.18 в 18:00</div>
                                        </div>
                                        <div class="message-text">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                        <div class="answ-block">
                                            <a href="#" class="answ-link">Комментировать</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <div id="1" class="info"></div>
        
        <script src="js/libs.min.js"></script>
        <script src="js/main.min.js"></script>

        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <!--  <script>
            window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
            ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
          </script>
          <script src="https://www.google-analytics.com/analytics.js" async defer></script>-->
    </body>

</html>
