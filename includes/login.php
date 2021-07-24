<?php
session_start();
include __DIR__ . '/Users.php';

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header('Location: http://localhost:8888/biblioteca/login.php');
    exit;
}


$loggedInUser=\Biblos\Users::loginUser($_POST);


$_SESSION['userId'] = $loggedInUser['id'];
$_SESSION['email'] = $loggedInUser['email'];
$_SESSION['name'] = $loggedInUser['name'];
$_SESSION['surname'] = $loggedInUser['surname'];
$_SESSION['is_admin'] = $loggedInUser['is_admin'];
header('Location: http://localhost:8888/biblioteca');
exit;

?>