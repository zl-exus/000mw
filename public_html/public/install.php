<?php
namespace classes;

require_once ("../conf/config.php");
require_once ("../conf/autoload.php");


$db = new Db;

try {
    $db->connectDb()->query(
        'create table authors 
(
    author_id int unsigned not null auto_increment primary key,
    first_name tinytext not null,
    last_name tinytext not null,
    date_registration datetime not null DEFAULT CURRENT_TIMESTAMP,
    soc_id tinytext
);

create table message_header
(
  parent_post_id int default 0 not null,
  author_id int unsigned not null,
  has_children int default 0 not null,
  posted datetime not null DEFAULT CURRENT_TIMESTAMP,
  post_id int unsigned not null auto_increment primary key
);
create table message_body
(
  post_id int unsigned not null primary key,
  message text
);');
    echo '<div class="info"><h4> Необходимые таблицы созданы, для начала работы можете перейти по следующей ссылке: </h4>'
    . '<a href="' . URL . '">' . URL . '</a></div>';
} catch (PDOException $ex) {
    echo '<p>Что-то пошло не так: </p>' . $ex->getMessage() . ' <br>';
}

