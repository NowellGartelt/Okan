<!-- controller/login.php -->
<?php
session_start();

$hat = array(
    'title' => 'Fuen-Works：ログイン',
    'description' => 'Fuen-Works全体のログイン画面',
    'keywords' => 'Fuen-Works',
);

$login = $_SESSION['login'];

include '../closet/view/hat.php';
include '../view/login.php';
include '../closet/view/shoes.php';

?>
