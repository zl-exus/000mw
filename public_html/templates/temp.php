
<?php foreach ($messages as $message) : ?> 
                        <div class="col-12">
                            <div id="message_id-<?= $message['post_id']; ?>" class="message col-12 post" data-id="<?= $message['post_id']; ?>">
                                <div class="post-header">
                                    <div class="author"><a href="#message-<?= $message['post_id']; ?>"><?= $db->getAuthorName($message['author_id']); ?> опубликовал <?= implode(' в ', explode(' ', $message['posted'])); ?></a></div>
                                </div>
                                <div class="message-text">
                                    <?= $message['post_text']; ?>
                                </div>
                                <div class="answ-block">
                                    <?php if ($isAuth == true) : ?>
                                        <a href="#" class="answ-link">Комментировать</a>
                                    <?php endif; ?>
                                </div>
                                <?php
                                if ($message['has_children'] != 0) :
                                    $comments = $db->getCommentsArray($message[parent_post_id]);
                                    foreach ($comments as $comment) :

                                        ?>
                                        <div id="message_id-<?= $comment['post_id']; ?>" class="comment post" data-id="<?= $comment['post_id']; ?>">
                                            <div class="post-header">
                                                <div class="author"><a href="#message-<?= $comment['post_id']; ?>"><?= $db->getAuthorName($comment['author_id']); ?> опубликовал <?= implode(' в ', explode(' ', $comment['posted'])); ?></a></div>
                                            </div>
                                            <div class="message-text">
                                                <?= $comment['post_text']; ?>
                                            </div>
                                            <div class="answ-block">
                                                <?php if ($isAuth == true) : ?>
                                                    <a href="#" class="answ-link">Комментировать</a>
                                                <?php endif; ?>
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
                                                    <?php if ($isAuth == true) : ?>
                                                        <a href="#" class="answ-link">Комментировать</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;

                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>