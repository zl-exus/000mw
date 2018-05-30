<?php

function mwAutoload($className)
{
    $class_pieces = explode('\\', $className);
    switch ($class_pieces[0]) {
        case 'classes':
            require ROOT . '/' . implode(DIRECTORY_SEPARATOR, $class_pieces) . '.php';
            break;
    }
}
spl_autoload_register('mwAutoload', true, true);
