<?php

require_once __DIR__ . '/../models/User.php';

session_start();

if (isset($_SESSION['user'])) {
    return;
}

if (isset($_COOKIE['userId'])) {
    $userId = $_COOKIE['userId'];
    $user = User::getById($userId);
    $_SESSION['user'] = $user;
    return;
}

header('Location: /ph16/memo/public/user/login.php');
