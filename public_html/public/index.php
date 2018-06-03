<?php
error_reporting(E_ALL);  //установливает уровень отслеживаемости ошибок интерпиртатором
ini_set('display_errors', 1);  //выводить все ошибки в браузер

require_once ("../conf/config.php");
require_once ("../conf/autoload.php");

session_start();

require_once MODEL_PATH . 'model.php';
require_once TEMPLATE_PATH . 'main.tpl.php';

