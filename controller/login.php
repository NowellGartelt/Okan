<!-- controller/login.php -->
<?php
session_start();

$hat = array(
    'title' => 'Okan：ログイン',
    'description' => 'Fuen-Works全体のログイン画面',
    'keywords' => 'Fuen-Works',
);

if (!$_POST['fromPage']) {
    $login = $_SESSION['login'];
} else {
    $login = null;        
}

include '../closet/view/hat.php';
include '../view/login.php';
include '../closet/view/shoes.php';

?>
