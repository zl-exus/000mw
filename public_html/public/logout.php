<?php
session_start();
if (isset($_SESSION)) {
    unset($_SESSION);
    unset($_COOKIE[session_name()]);
    session_destroy();
}

header("Location: /");
